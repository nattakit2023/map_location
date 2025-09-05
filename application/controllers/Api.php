<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api_model');
        $this->load->model('restrict_model');
    }

    public function _remap($method, $args = [])
    {  // Magic method for routing
        if (method_exists($this, $method . '_' . strtolower($this->input->method()))) {
            call_user_func_array([$this, $method . '_' . strtolower($this->input->method())], $args);
        } else {
            $this->response(['message' => 'Invalid API endpoint'], REST_Controller::HTTP_NOT_FOUND); // Or show error
        }
    }


    public function index_get()
    {
        //$this->checkresfence('8','22.275334996986643','70.88614147123701');
    }

    public function index_post()   //Get GPS feed in device
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $checklogin = $this->api_model->checkgps_auth($id);


        if ($checklogin) {
            echo $v_id = $checklogin[0]['v_id'];
            $lat = isset($_REQUEST["lat"]) ? $_REQUEST["lat"] : NULL;
            $lon = isset($_REQUEST["lon"]) ? $_REQUEST["lon"] : NULL;
            $timestamp = isset($_REQUEST["timestamp"]) ? $_REQUEST["timestamp"] : NULL;
            $altitude = isset($_REQUEST["altitude"]) ? $_REQUEST["altitude"] : NULL;
            $speed = isset($_REQUEST["speed"]) ? $_REQUEST["speed"] : NULL;
            $bearing = isset($_REQUEST["bearing"]) ? $_REQUEST["bearing"] : NULL;
            $accuracy = isset($_REQUEST["accuracy"]) ? $_REQUEST["accuracy"] : NULL;
            $comment = isset($_REQUEST["comment"]) ? $_REQUEST["comment"] : NULL;
            $postarray = array('v_id' => $v_id, 'latitude' => $lat, 'longitude' => $lon, 'time' => date('Y-m-d h:i:s'), 'altitude' => $altitude, 'speed' => $speed, 'bearing' => $bearing, 'accuracy' => $accuracy, 'comment' => $comment);
            $this->api_model->add_postion($postarray);
            $this->checkresfence($v_id, $lat, $lon);
            $response = array('error' => false, 'message' => ['v_id' => $v_id]);
            $this->set_response($response);
        }
    }
    public function positions_post()     //Postion feed to front end   
    {
        $this->db->select("*");
        $this->db->from('positions');
        $this->db->where('v_id', $this->post('t_vechicle'));
        $this->db->where('date(time) >=', $this->post('fromdate'));
        $this->db->where('date(time) <=', $this->post('todate'));
        $query = $this->db->get();
        $data = $query->result_array();
        $distancefrom = reset($data);
        $distanceto = end($data);
        $totaldist = $this->totaldistance($distancefrom, $distanceto);
        $returndata = array('status' => 1, 'data' => $data, 'totaldist' => $totaldist, 'message' => 'data');
        $this->set_response($returndata);
    }

    public function totaldistance($distancefrom, $distanceto, $earthRadius = 6371000)
    {
        $latFrom = deg2rad($distancefrom['latitude']);
        $lonFrom = deg2rad($distancefrom['longitude']);
        $latTo = deg2rad($distanceto['latitude']);
        $lonTo = deg2rad($distanceto['longitude']);
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
    public function currentpositions_get()
    {
        $data = array();
        $postions = array();
        $this->db->select("p.*,v.v_name,v.v_type,v.v_color");
        $this->db->from('positions p');
        $this->db->join('vehicles v', 'v.v_id = p.v_id');
        $this->db->where('v.v_is_active', 1);

        if (isset($_GET['uname'])) {
            $this->db->where('v.v_api_username', $_GET['uname']);
        }

        if (isset($_GET['gr'])) {
            $this->db->where('v.v_group', $_GET['gr']);
        }

        if (isset($_GET['v_id'])) {
            $this->db->where('v.v_id', $_GET['v_id']);
        }

        $this->db->where('`id` IN (SELECT MAX(id) FROM positions GROUP BY `v_id`)', NULL, FALSE);
        $query = $this->db->get();
        $data = $query->result_array();
        if (count($data) >= 1) {
            $resp = array('status' => 1, 'data' => $data);
        } else {
            $resp = array('status' => 0, 'message' => 'No live GPS feed found');
        }
        $this->set_response($resp);
    }
    public function checkresfence($vid, $lat, $log)
    {
        $vresfence = $this->resfence_model->getvechicle_resfence($vid);
        if (!empty($vresfence)) {
            $points = array("$lat $log");
            foreach ($vresfence as $resfencedata) {
                $lastres = explode(" ,", $resfencedata['res_area']);
                $polygon = $resfencedata['res_area'] . $lastres[0];
                $polygondata = explode(' , ', $polygon);
                foreach ($polygondata as $polygoncln) {
                    $respolygondata[] = str_replace(",", ' ', $polygoncln);
                }
                foreach ($points as $key => $point) {
                    $rescheck = pointInPolygon($point, $respolygondata, false);
                    if ($rescheck == 'outside' || $rescheck == 'boundary' || $rescheck == 'inside') {
                        $wharray = array(
                            'ge_v_id' => $vid,
                            'ge_res_id' => $resfencedata['res_id'],
                            'ge_event' => $rescheck,
                            'DATE(ge_timestamp)' => date('Y-m-d')
                        );
                        $resfence_events = $this->db->select('*')->from('resfence_events')->where($wharray)->get()->result_array();

                        if (count($resfence_events) == 0) {
                            $insertarray = array('ge_v_id' => $vid, 'ge_res_id' => $resfencedata['res_id'], 'ge_event' => $rescheck, 'ge_timestamp' =>
                            date('Y-m-d h:i:s'));
                            $this->db->insert('resfence_events', $insertarray);
                        }
                    }
                }
            }
        }
    }

    public function post_camera_video_post()
    {
        // {
        //     "appKey": "21604470",
        //     "appSecret": "5bQmEpoHtdMgSobEntyP",
        //     "body": {
        //         "pageNo": 1,
        //         "pageSize": 10,
        //         "siteIndexCode": "0"
        //     },
        //     "pageNo": 1,
        //     "pageSize": 10,
        //     "siteIndexCode": "0",
        //     "contentType": "application/json;charset=UTF-8",
        //     "headers": {},
        //     "httpMethod": "POST",
        //     "mock": false,
        //     "parameter": {},
        //     "path": "/api/resource/v1/cameras",
        //     "query": {}
        // }
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post('data');

            $get_url = [];

            $url = 'https://cloudcctv.online/artemis-web/debug';
            $headers = array('Content-Type: application/json');
            foreach ($data as $value) {
                $data_post = [
                    "appKey" => "21604470",
                    "appSecret" => "5bQmEpoHtdMgSobEntyP",
                    "body" => [
                        "cameraIndexCode" => $value['cameraCode'],
                        "protocol" => "websocket",
                        "streamType" => 1,
                        "transmode" => 1
                    ],
                    "contentType" => "application/json;charset=UTF-8",
                    "headers" => [],
                    "httpMethod" => "POST",
                    "mock" => false,
                    "parameter" => [],
                    "path" => "/api/video/v1/cameras/previewURLs",
                    "query" => []
                ];
                $result = $this->api_model->call_api($url, 'POST', $data_post, $headers); // Encode data as JSON
                $http_code = $result['status_code'];
                $response = $result['response'];
                array_push($get_url, $response);
            }


            if ($http_code == 200 || $http_code == 201) { // 201 Created is also a success code
                // Process the successful response
                $this->response($get_url, REST_Controller::HTTP_OK);
            } else {
                // Handle the error
                $this->response("API Fail To Call", REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response("Data is wrong", REST_Controller::HTTP_BAD_GATEWAY);
        }

        // Example usage (POST request with JSON data):
        // $url = 'https://api.example.com/endpoint';
        // $data = array('key1' => 'value1', 'key2' => 'value2');
        // $headers = array('Content-Type: application/json'); // Important for JSON
        // $result = call_api($url, 'POST', json_encode($data), $headers); // Encode data as JSON
        // $http_code = $result['status_code'];
        // $response = $result['response'];

        // if ($http_code == 200 || $http_code == 201) { // 201 Created is also a success code
        //     // Process the successful response
        //     $data = json_decode($response, true); // Decode the JSON response
        //     // ... use the data ...
        //     $this->response($data, REST_Controller::HTTP_OK);
        // } else {
        //     // Handle the error
        //     $this->response("API Fail To Call", REST_Controller::HTTP_BAD_REQUEST);
        // }


        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function get_vessel_location_get()
    {
        $this->db->select('dfs.*');
        $this->db->from('update_data_from_sc udfs');
        $this->db->join('data_from_sc dfs', 'dfs.id = udfs.data_id', 'left');

        $query = $this->db->get();
        $data = $query->result_array();

        foreach ($data as &$item) {
            $this->db->select('dfs.*, v.v_color, v.v_manufactured_by');
            $this->db->from('data_from_sc dfs');
            $this->db->join('vehicles v', 'dfs.esnName = v.v_name', 'left');
            $this->db->where('esnName', $item['esnName']);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(2);
            $query = $this->db->get();
            $item['latlng'] = $query->result_array();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function get_restrict_location_get()
    {
        $resdata = array();
        $restrictlist = $this->restrict_model->getall_restrict();
        if (!empty($restrictlist)) {
            foreach ($restrictlist as $key => $restrictlists) {
                $resdata[$key] = $restrictlists;
                $resdata[$key]['res_vehiclename'] = $this->getvehiclename($restrictlists['res_vehicles']);
            }
        }
        $resdata;
        $this->response($resdata, REST_Controller::HTTP_OK);
    }

    public function getvehiclename($res_vehicles)
    {
        $name = array();
        $res_vehicles = explode(',', $res_vehicles);
        if (!empty($res_vehicles)) {
            foreach ($res_vehicles as $value) {
                $data = $this->db->select('v_name')->from('vehicles')->where('v_id', $value)->get()->result_array();
                if (isset($data[0]['v_name'])) {
                    $name[] = $data[0]['v_name'];
                }
            }
        }
        return implode(', ', $name);
    }
}

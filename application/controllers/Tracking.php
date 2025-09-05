<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->model('trips_model');
		$data['vechiclelist'] = $this->trips_model->getall_vechicle();
		$data['vechiclelist_from_sc'] = $this->db->query("SELECT * FROM data_from_sc group by esnName desc")->result_array();
		$this->template->template_render('tracking', $data);
	}
	public function livestatus()
	{
		// $data['api_google'] = $this->db->select('s_googel_api_key')->from('settings')->get()->result_array();
		$data['camera_name'] = $this->db->select('*')->from('camera')->get()->result_array();
		$data['vessel'] = json_encode($this->db->select('v_id ,v_name')->from('vehicles')->get()->result_array());
		$data['vechiclelist_from_sc'] = $this->db->query("SELECT * FROM data_from_sc group by esnName desc")->result_array();

		// if (isset($data[0]['s_googel_api_key']) && $data[0]['s_googel_api_key'] != '') {
		// 	$this->template->template_render('livelocation',$data);
		// } else {
		// 	$this->session->set_flashdata('warningmessage', 'Please add google map key in settings page');
		// 	$this->template->template_render('livelocation');
		// }

		$this->template->template_render('livelocation', $data);
	}

	public function tblhistory()
	{
		$data = $this->input->post('data');
		$result['data'] = $this->db->query("SELECT * FROM data_from_sc WHERE esnName = '$data[vechicle]' AND messageType = 'Standard' AND ( timestamp >= '$data[fromdate]' AND timestamp <= '$data[todate]')")->result_array();
		foreach ($result['data'] as $key => $history) {
			if ($key != 0) {

				$R = 6371e3; // metres
				$phi1 = deg2rad($result['data'][$key - 1]['latitude']); // φ, λ in radians (convert degrees to radians)
				$phi2 = deg2rad($history['latitude']);
				$deltaPhi = deg2rad($history['latitude'] - $result['data'][$key - 1]['latitude']);
				$deltaLambda = deg2rad($history['longitude'] - $result['data'][$key - 1]['longitude']);

				$a = sin($deltaPhi / 2) * sin($deltaPhi / 2) +
					cos($phi1) * cos($phi2) *
					sin($deltaLambda / 2) * sin($deltaLambda / 2);

				$c = 2 * atan2(sqrt($a), sqrt(1 - $a));

				$d = $R * $c; // in metres
				$nauticalMiles = $d / 1852;
				$result['data'][$key]['distance'] = $nauticalMiles;

				$prevTime = strtotime($result['data'][$key - 1]['timestamp']);
				$currentTime = strtotime($history['timestamp']);

				$timeDifferenceSeconds = $currentTime - $prevTime;
				$timeDifferenceHours = $timeDifferenceSeconds / 3600;
				$speed = $nauticalMiles / $timeDifferenceHours;
				$result['data'][$key]['speed'] = round($speed, 5);
			}
		}

		return $this->load->view("tbltrackinghistory", $result);
	}

	public function get_history()
	{
		$data = $this->input->post('data');
		$result = $this->db->query("SELECT * FROM data_from_sc WHERE esnName = '$data[vechicle]' AND messageType = 'Standard' AND ( timestamp >= '$data[fromdate]' AND timestamp <= '$data[todate]')")->result_array();
		echo json_encode($result);
	}
}

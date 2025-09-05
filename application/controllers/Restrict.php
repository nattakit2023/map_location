<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Restrict extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('restrict_model');
        $this->load->model('vehicle_model');
    }

    public function index()
    {
        $resdata = array();
        $restrictlist = $this->restrict_model->getall_restrict();
        if (!empty($restrictlist)) {
            foreach ($restrictlist as $key => $restrictlists) {
                $resdata[$key] = $restrictlists;
                $resdata[$key]['res_vehiclename'] = $this->getvehiclename($restrictlists['res_vehicles']);
            }
        }
        $data['restrictlist'] = $resdata;
        $this->template->template_render('restrict', $data);
    }

    public function restrict_save()
    {
        $response = $this->restrict_model->add_restrict($this->input->post('data'));
        if ($response) {
            $this->session->set_flashdata('successmessage', 'Restrict added successfully..');
            redirect('restrict');
        } else {
            $this->session->set_flashdata('warningmessage', 'Failed to insert restrict..Try again.');
            redirect('restrict');
        }
    }

    public function getvehiclename($geo_vehicles)
    {
        $name = array();
        $geo_vehicles = explode(',', $geo_vehicles);
        if (!empty($geo_vehicles)) {
            foreach ($geo_vehicles as $value) {
                $data = $this->db->select('v_name')->from('vehicles')->where('v_id', $value)->get()->result_array();
                if (isset($data[0]['v_name'])) {
                    $name[] = $data[0]['v_name'];
                }
            }
        }
        return implode(', ', $name);
    }

    public function addrestrict()
    {
        $data['vehicles'] = $this->vehicle_model->getall_vehicle();
        $this->template->template_render('restrict_add', $data);
    }

    public function restrict_management()
    {
        $resdata = array();
        $restrictlist = $this->restrict_model->getall_restrict();
        if (!empty($restrictlist)) {
            foreach ($restrictlist as $key => $restrictlists) {
                $resdata[$key] = $restrictlists;
                $resdata[$key]['res_vehiclename'] = $this->getvehiclename($restrictlists['res_vehicles']);
            }
        }
        $data['restrictlist'] = $resdata;
        $this->template->template_render('restrict_management', $data);
    }

    public function restrictdelete()
    {
        $g_id = $this->input->post('res_id');
        if (empty($g_id)) {
            $this->session->set_flashdata('warningmessage', 'Invalid restrict ID.');
        }
        $this->db->where('res_res_id', $g_id);
        $events = $this->db->delete('restrict_events');

        $this->db->where('res_id', $g_id);
        $response = $this->db->delete('restrict_area');


        if ($response && $events) {
            $this->session->set_flashdata('successmessage', 'Restrict deleted successfully..');
        } else {
            $this->session->set_flashdata('warningmessage', 'Failed to delete restrict.Try again.');
        }
    }

    public function restrictevents()
    {
        $returndata = array();
        $restrictevents = $this->restrict_model->get_restrictevents();
        if (!empty($restrictevents)) {
            foreach ($restrictevents as $key => $resdata) {
                $data = $this->db->select('res_name')->from('restrict_area')->where('res_id', $resdata['res_res_id'])->get()->result_array();
                $restrict = $this->db->select('latitude, longitude')->from('data_from_sc')->where('id', $resdata['res_events'])->get()->result_array();
                if (isset($data[0]['res_name'])) {
                    $returndata[] = $resdata;
                    $returndata[$key]['res_name'] = $data[0]['res_name'];
                }
                if (isset($restrict[0]['latitude']) && isset($restrict[0]['longitude'])) {
                    $returndata[$key]['latitude'] = $restrict[0]['latitude'];
                    $returndata[$key]['longitude'] = $restrict[0]['longitude'];
                }
            }
        }
        $data['restrictevents'] = $returndata;
        $this->template->template_render('restrict_events', $data);
    }


    public function get_restrictevents()
    {
        $returndata = array();
        $restrictevents = $this->restrict_model->get_restrictevents(5);
        if (!empty($restrictevents)) {
            foreach ($restrictevents as $key => $resdata) {
                $data = $this->db->select('res_name')->from('restrict_area')->where('res_id', $resdata['res_res_id'])->get()->result_array();
                $restrict = $this->db->select('latitude, longitude')->from('data_from_sc')->where('id', $resdata['res_events'])->get()->result_array();
                if (isset($data[0]['res_name'])) {
                    $returndata[] = $resdata;
                    $returndata[$key]['res_name'] = $data[0]['res_name'];
                }
                if (isset($restrict[0]['latitude']) && isset($restrict[0]['longitude'])) {
                    $returndata[$key]['latitude'] = $restrict[0]['latitude'];
                    $returndata[$key]['longitude'] = $restrict[0]['longitude'];
                }
            }
        }
        echo json_encode($returndata);
    }
}

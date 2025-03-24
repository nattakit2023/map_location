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
		$result['data'] = $this->db->query("SELECT * FROM data_from_sc WHERE esn = '$data[vechicle]' AND messageType = 'Standard' AND ( timestamp >= '$data[fromdate]' AND timestamp <= '$data[todate]')")->result_array();
		return $this->load->view("tbltrackinghistory", $result);
	}

	public function get_history()
	{
		$data = $this->input->post('data');
		$result = $this->db->query("SELECT * FROM data_from_sc WHERE esn = '$data[vechicle]' AND messageType = 'Standard' AND ( timestamp >= '$data[fromdate]' AND timestamp <= '$data[todate]')")->result_array();
		echo json_encode($result);
	}
}

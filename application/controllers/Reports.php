<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reports extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('vehicle_model');
		$this->load->model('incomexpense_model');
		$this->load->model('fuel_model');
		$this->load->model('trips_model');
		$this->load->library('session');
	}
	public function booking()
	{
		if (isset($_POST['bookingreport'])) {
			$triplist = $this->trips_model->trip_reports($this->input->post('booking_from'), $this->input->post('booking_to'), $this->input->post('booking_vechicle'));
			if (empty($triplist)) {
				$this->session->set_flashdata('warningmessage', 'No bookings found..');
				$data['triplist'] = '';
			} else {
				unset($_SESSION['warningmessage']);
				$data['triplist'] = $triplist;
			}
		}
		$data['vehiclelist'] = $this->vehicle_model->getall_vehicle();
		$this->template->template_render('report_booking', $data);
	}
	public function incomeexpense()
	{
		if (isset($_POST['incomeexpensereport'])) {
			$incomeexpensereport = $this->incomexpense_model->incomexpense_reports($this->input->post('incomeexpense_from'), $this->input->post('incomeexpense_to'), $this->input->post('incomeexpense_vechicle'));
			if (empty($incomeexpensereport)) {
				$this->session->set_flashdata('warningmessage', 'No data found..');
				$data['incomexpense'] = '';
			} else {
				unset($_SESSION['warningmessage']);
				$data['incomexpense'] = $incomeexpensereport;
			}
		}
		$data['vehiclelist'] = $this->vehicle_model->getall_vehicle();
		$this->template->template_render('report_incomeexpense', $data);
	}
	public function fuels()
	{
		if (isset($_POST['fuelreport'])) {
			$fuelreport = $this->fuel_model->fuel_reports($this->input->post('fuel_from'), $this->input->post('fuel_to'), $this->input->post('fuel_vechicle'));
			if (empty($fuelreport)) {
				$this->session->set_flashdata('warningmessage', 'No data found..');
				$data['fuel'] = '';
			} else {
				unset($_SESSION['warningmessage']);
				$data['fuel'] = $fuelreport;
			}
		}
		$data['vehiclelist'] = $this->vehicle_model->getall_vehicle();
		$this->template->template_render('report_fuel', $data);
	}

	public function fms()
	{
		$data['vehicles'] = $this->vehicle_model->getall_vehicle();
		$data['fms'] = $this->fuel_model->getall_fms();
		$this->template->template_render('fms', $data);
	}

	public function add_fms()
	{
		$vehicle = $this->input->post('vehicle');
		$datetime = $this->input->post('datetime');

		$files = $_FILES['files'];
		$pdf = $_FILES['pdf'];

		foreach ($files['name'] as $index => $name) {
			$filename = $name;
			$fileTmp = $files['tmp_name'][$index];
			$filePath = "assets/uploads/report/fms/" . $vehicle . "/" . $name;
			$pdfname = $pdf['name'][$index];
			$pdfTmp = $pdf['tmp_name'][$index];
			$pdfPath = "assets/uploads/report/fms/" . $vehicle . "/" . $pdfname;

			move_uploaded_file($fileTmp, $filePath);
			chmod("$filePath", 0755);

			move_uploaded_file($pdfTmp, $pdfPath);
			chmod("$pdfPath", 0755);

			$this->fuel_model->add_fms(["file_name" => $filename, "file_tmp" => $fileTmp, "file_path" => $filePath, "pdf_name" => $pdfname, "pdf_tmp" => $pdfTmp, "pdf_path" => $pdfPath, "vessel_id" => $vehicle, "datetime" => $datetime]);
		}

		$this->session->set_flashdata('successmessage', 'New FMS Report added successfully..');
	}

	public function get_fms()
	{
		$vessel_id = $this->input->post('vessel_id');
		$this->db->select('*');
		$this->db->from('fms');
		$this->db->where('vessel_id', $vessel_id);
		$this->db->order_by('datetime DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		echo json_encode($result);
	}

	public function crew_status()
	{
		$data['vehicles'] = $this->vehicle_model->getall_vehicle();
		$data['fms'] = $this->fuel_model->getall_crew();
		$this->template->template_render('crew_status', $data);
	}

	public function add_crew()
	{
		$vehicle = $this->input->post('vehicle');
		$datetime = $this->input->post('datetime');

		$files = $_FILES['files'];

		foreach ($files['name'] as $index => $name) {
			$filename = $name;
			$fileTmp = $files['tmp_name'][$index];
			$filePath = "assets/uploads/report/crew/" . $vehicle . "/" . $name;

			move_uploaded_file($fileTmp, $filePath);
			chmod("$filePath", 0755);

			$this->fuel_model->add_crew(["file_name" => $filename, "file_tmp" => $fileTmp, "file_path" => $filePath, "vessel_id" => $vehicle, "datetime" => $datetime]);
		}

		$this->session->set_flashdata('successmessage', 'New CREW Report added successfully..');
	}

	public function get_crew()
	{
		$vessel_id = $this->input->post('vessel_id');
		$this->db->select('*');
		$this->db->from('crew');
		$this->db->where('vessel_id', $vessel_id);
		$this->db->order_by('datetime DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		echo json_encode($result);
	}

	public function pms()
	{
		$data['vehicles'] = $this->vehicle_model->getall_vehicle();
		$data['fms'] = $this->fuel_model->getall_pms();
		$this->template->template_render('pms', $data);
	}

	public function add_pms()
	{
		$vehicle = $this->input->post('vehicle');
		$datetime = $this->input->post('datetime');

		$files = $_FILES['files'];

		foreach ($files['name'] as $index => $name) {
			$filename = $name;
			$fileTmp = $files['tmp_name'][$index];
			$filePath = "assets/uploads/report/pms/" . $vehicle . "/" . $name;

			move_uploaded_file($fileTmp, $filePath);
			chmod("$filePath", 0755);

			$this->fuel_model->add_pms(["file_name" => $filename, "file_tmp" => $fileTmp, "file_path" => $filePath, "vessel_id" => $vehicle, "datetime" => $datetime]);
		}

		$this->session->set_flashdata('successmessage', 'New PMS Report added successfully..');
	}

	public function get_pms()
	{
		$vessel_id = $this->input->post('vessel_id');
		$this->db->select('*');
		$this->db->from('pms');
		$this->db->where('vessel_id', $vessel_id);
		$this->db->order_by('datetime DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		echo json_encode($result);
	}

	public function add_pms_all()
	{
		$datetime = $this->input->post('datetime');

		$files = $_FILES['files'];

		foreach ($files['name'] as $index => $name) {
			$filename = $name;
			$fileTmp = $files['tmp_name'][$index];
			$filePath = "assets/uploads/report/pms/" . $vehicle . "/" . $name;

			move_uploaded_file($fileTmp, $filePath);
			chmod("$filePath", 0755);

			$this->fuel_model->add_pms_all(["file_name" => $filename, "file_tmp" => $fileTmp, "file_path" => $filePath, "datetime" => $datetime]);
		}

		$this->session->set_flashdata('successmessage', 'New PMS Report added successfully..');
	}

	public function get_pms_all()
	{
		$vessel_id = $this->input->post('vessel_id');
		$this->db->select('*');
		$this->db->from('pms_all');
		$this->db->where('vessel_id', $vessel_id);
		$this->db->order_by('datetime DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		echo json_encode($result);
	}

	public function ship_cer()
	{
		$data['vehicles'] = $this->vehicle_model->getall_vehicle();
		$data['fms'] = $this->fuel_model->getall_ship_cer();
		$this->template->template_render('ship_cer', $data);
	}

	public function add_ship_cer()
	{
		$vehicle = $this->input->post('vehicle');
		$datetime = $this->input->post('datetime');

		$files = $_FILES['files'];

		foreach ($files['name'] as $index => $name) {
			$filename = $name;
			$fileTmp = $files['tmp_name'][$index];
			$filePath = "assets/uploads/report/ship_certificate/" . $vehicle . "/" . $name;

			move_uploaded_file($fileTmp, $filePath);
			chmod("$filePath", 0755);

			$this->fuel_model->add_ship_cer(["file_name" => $filename, "file_tmp" => $fileTmp, "file_path" => $filePath, "vessel_id" => $vehicle, "datetime" => $datetime]);
		}

		$this->session->set_flashdata('successmessage', 'New Ship Certificate Report added successfully..');
	}

	public function get_ship_cer()
	{
		$vessel_id = $this->input->post('vessel_id');
		$this->db->select('*');
		$this->db->from('ship_cer');
		$this->db->where('vessel_id', $vessel_id);
		$this->db->order_by('datetime DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		echo json_encode($result);
	}

	public function safety()
	{
		$data['vehicles'] = $this->vehicle_model->getall_vehicle();
		$data['fms'] = $this->fuel_model->getall_safety();
		$this->template->template_render('safety', $data);
	}

	public function add_safety()
	{
		$vehicle = $this->input->post('vehicle');
		$datetime = $this->input->post('datetime');

		$files = $_FILES['files'];

		foreach ($files['name'] as $index => $name) {
			$filename = $name;
			$fileTmp = $files['tmp_name'][$index];
			$filePath = "assets/uploads/report/safety/" . $vehicle . "/" . $name;

			move_uploaded_file($fileTmp, $filePath);
			chmod("$filePath", 0755);

			$this->fuel_model->add_safety(["file_name" => $filename, "file_tmp" => $fileTmp, "file_path" => $filePath, "vessel_id" => $vehicle, "datetime" => $datetime]);
		}

		$this->session->set_flashdata('successmessage', 'New Safety Report added successfully..');
	}

	public function get_safety()
	{
		$vessel_id = $this->input->post('vessel_id');
		$this->db->select('*');
		$this->db->from('safety');
		$this->db->where('vessel_id', $vessel_id);
		$this->db->order_by('datetime DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		echo json_encode($result);
	}
}

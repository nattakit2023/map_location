<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Fuel_model extends CI_Model
{

	public function add_fuel($data)
	{
		return	$this->db->insert('fuel', $data);
	}
	public function getall_fuel()
	{
		$fuel = $this->db->select('*')->from('fuel')->order_by('v_fuel_id', 'desc')->get()->result_array();
		if (!empty($fuel)) {
			foreach ($fuel as $key => $fuels) {
				$newfuel[$key] = $fuels;
				$newfuel[$key]['vech_name'] =  $this->db->select('v_registration_no,v_name')->from('vehicles')->where('v_id', $fuels['v_id'])->get()->row();
				$newfuel[$key]['filled_by'] =  $this->db->select('d_name')->from('drivers')->where('d_id', $fuels['v_fueladdedby'])->get()->row();
			}
			return $newfuel;
		} else {
			return false;
		}
	}
	public function editfuel($f_id)
	{
		return $this->db->select('*')->from('fuel')->where('v_fuel_id', $f_id)->get()->result_array();
	}
	public function updatefuel()
	{
		$this->db->where('v_fuel_id', $this->input->post('v_fuel_id'));
		return $this->db->update('fuel', $this->input->post());
	}

	public function fuel_reports($from, $to, $v_id)
	{
		$newincomexpense = array();
		if ($v_id == 'all') {
			$where = array('v_fuelfilldate >=' => $from, 'v_fuelfilldate<=' => $to);
		} else {
			$where = array('v_fuelfilldate >=' => $from, 'v_fuelfilldate<=' => $to, 'v_id' => $v_id);
		}
		$fuel = $this->db->select('*')->from('fuel')->where($where)->order_by('v_fuel_id', 'desc')->get()->result_array();
		if (!empty($fuel)) {
			foreach ($fuel as $key => $fuels) {
				$newfuel[$key] = $fuels;
				$newfuel[$key]['vech_name'] =  $this->db->select('v_registration_no,v_name')->from('vehicles')->where('v_id', $fuels['v_id'])->get()->row();
				$newfuel[$key]['filled_by'] =  $this->db->select('d_name')->from('drivers')->where('d_id', $fuels['v_fueladdedby'])->get()->row();
			}
			return $newfuel;
		} else {
			return false;
		}
	}

	public function add_fms($data)
	{
		return	$this->db->insert('fms', $data);
	}

	public function getall_fms()
	{
		$this->db->select('*')->from('fms')->join('vehicles', 'fms.vessel_id = vehicles.v_id', 'left');

		return $this->db->get()->result_array();
	}

	public function add_crew($data)
	{
		return	$this->db->insert('crew', $data);
	}

	public function getall_crew()
	{
		$this->db->select('*')->from('crew')->join('vehicles', 'crew.vessel_id = vehicles.v_id', 'left');

		return $this->db->get()->result_array();
	}

	public function add_pms($data)
	{
		return	$this->db->insert('pms', $data);
	}

	public function getall_pms()
	{
		$this->db->select('*')->from('pms')->join('vehicles', 'pms.vessel_id = vehicles.v_id', 'left');

		return $this->db->get()->result_array();
	}

	public function add_pms_all($data)
	{
		return	$this->db->insert('pms_all', $data);
	}

	public function getall_pms_all()
	{
		$this->db->select('*')->from('pms_all');

		return $this->db->get()->result_array();
	}

	public function add_ship_cer($data)
	{
		return	$this->db->insert('ship_cer', $data);
	}

	public function getall_ship_cer()
	{
		$this->db->select('*')->from('ship_cer')->join('vehicles', 'ship_cer.vessel_id = vehicles.v_id', 'left');

		return $this->db->get()->result_array();
	}

	public function add_safety($data)
	{
		return	$this->db->insert('safety', $data);
	}

	public function getall_safety()
	{
		$this->db->select('*')->from('safety')->join('vehicles', 'safety.vessel_id = vehicles.v_id', 'left');

		return $this->db->get()->result_array();
	}
}

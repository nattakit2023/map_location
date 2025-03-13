<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Restrict_model extends CI_Model
{

    public function add_restrict($data)
    {
        $insertdata = array('res_name' => $data['res_name'], 'res_description' => $data['res_description'], 'res_area' => $data['res_area'], 'res_lat' => $data['res_lat'], 'res_lng' => $data['res_lng'], 'res_radius' => $data['radius'], 'res_vehicles' => implode(',', $data['res_vehicles']));

        return    $this->db->insert('restrict_area', $insertdata);
    }

    public function getall_restrict()
    {
        return $this->db->select('*')->from('restrict_area')->order_by('res_id', 'DESC')->get()->result_array();
    }

    public function get_restrict($gid)
    {
        return $this->db->select('*')->from('restrict_area')->where('res_id', $gid)->get()->result_array();
    }

    public function oldgetvechicle_restrict($v_id)
    {
        $this->db->select("*");
        $this->db->from('vehicle_geofence');
        $this->db->join('restrict_area', 'restrict_area.geo_id=vehicle_geofence.vg_geo_id');
        $this->db->where('vehicle_geofence.vg_v_id', $v_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getvechicle_restrict($v_id)
    {
        $this->db->select("*");
        $this->db->from('restrict');
        $this->db->where("FIND_IN_SET(" . $v_id . ",geo_vehicles) <> 0");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_restrictevents($limit = NULL)
    {
        $this->db->select("restrict_events.*,vehicles.v_name");
        $this->db->from('vehicles');
        $this->db->join('restrict_events', 'restrict_events.res_v_id=vehicles.v_id');
        if ($limit) {
            $this->db->limit($limit);
        }
        $this->db->order_by('res_e_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function countvehiclenrestricy_events($vid)
    {
        return $this->db->select('res_v_id')->from('restrict_events')->where('res_v_id', $vid)->get()->result_array();
    }
}

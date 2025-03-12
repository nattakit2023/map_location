<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model
{

	public function add_postion($postarray)
	{
		return	$this->db->insert('positions', $postarray);
	}
	public function checkgps_auth($v_id)
	{
		$this->db->where('v_api_username', $v_id);
		$query = $this->db->get("vehicles");
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	}

	public function get_all_camera()
	{
		$this->db->select('*');
		$this->db->from('camera');
		$query = $this->db->get();
		return $query->result_array();
	}

	function call_api($url, $method = 'GET', $data = null, $headers = [])
	{
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Don't verify peer certificate
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Don't verify host
		if ($data) {
			if (is_array($data)) {
				// $data = http_build_query($data); // For form data
				$data = json_encode($data); // For JSON data
			}
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}

		if ($headers) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		}

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			$error_message = curl_error($ch);
			curl_close($ch);
			throw new Exception("cURL Error: " . $error_message);
		}

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		$decoded_response = json_decode($response, true); // true for associative array
		if ($decoded_response === null && json_last_error() !== JSON_ERROR_NONE) {
			// Handle JSON decoding error
			throw new Exception("JSON Decoding Error: " . json_last_error_msg());
		}

		return ['status_code' => $http_code, 'response' => $decoded_response];
	}
}

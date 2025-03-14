<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends CI_Controller {
    //To load initial libraries, functions
	function __construct( )
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('directory');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();
	}
	//To load login page
	public function index()    //Login Controller
	{
	  if (isset($this->session->userdata['session_data'])) {
            $url = base_url() . "dashboard";
            header("location: $url");
        } else {
            $this->load->view('page_first');
        }
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class oap extends CI_Controller {

			
			
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('connector');
	}
	

}
?>
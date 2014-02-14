<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sync extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		//$this->load->helper('url');
		//$this->load->library('tank_auth');
		$this->load->model('sync_log');
		$this->load->model('scheduler');
	}

	public function index()
	{
		$this->load->model('sync_log');
		$this->load->model('scheduler');
		$scheduler=new Scheduler();
		echo $scheduler->get_schedule();
	}
	function excute()
	{
		$scheduler=new Scheduler();
		$sched=$scheduler->get_schedule();
		
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

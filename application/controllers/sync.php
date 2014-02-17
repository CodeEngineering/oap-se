<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sync extends CI_Controller {
private $apis=array();
	function __construct()
	{
		parent::__construct();

		//$this->load->helper('url');
		//$this->load->library('tank_auth');
		$this->load->model('sync_log');
		$this->load->model('scheduler');
		$this->load->model('connector');
		$this->load->model('api');
		$this->scheduler->get_todays_schedule();
		$this->scheduler->get_todays_schedule();
		$this->apis=$this->api->getall();;
	}

	public function index()
	{
		$this->load->model('sync_log');
		$this->load->model('scheduler');
		$scheduler=new Scheduler();
		echo "test";
	}
	public function excute()
	{
		$jobs=$this->connector->get_scheduled_job();
		print_r($jobs);
		
		
		
	}
	public function admin()
	{
		$data=null;
		$data['jobs']=$this->connector->get_scheduled_job_today();
		foreach ($data['jobs'] as $key=>$job)
		{
			$data['jobs'][$key]->api_source=$this->apis[$data['jobs'][$key]->api_source];
			$data['jobs'][$key]->api_target=$this->apis[$data['jobs'][$key]->api_target];
		}
		$this->load->view('header');
		$this->load->view('admin',$data);
		$this->load->view('footer');	
	
	}

function runnow()
{
	
	//print_r($_POST);
	$id=$this->input->post('connectionid');
	$connection=$this->connector->read($id);
	$search_filter=json_decode($connection->source_filter);
	//source
	$tmp=$this->apis[$connection->api_source]->obj_name;
	$api_source=new $tmp();
	
	$res=$api_source->search($this->apis[$connection->api_source]->search_point,$search_filter,json_decode($connection->source_fields));
	$total_found=count($res);
	$tmp=$this->apis[$connection->api_target]->obj_name;
	$api_target=new $tmp();
	$sync_count=$api_target->Create($this->apis[$connection->api_target]->write_point,$res,json_decode($connection->target_fields));
	//$res=$this->ci->format->factory($res,'xml')->to_array();
	//print_r($res);
	$data['Total']=$total_found;
	$data['Sync']=$sync_count;
	//header('Content-Type: application/json');
//	echo json_encode($data);
	
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

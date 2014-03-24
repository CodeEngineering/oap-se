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
			$log=$this->sync_log->get_lastlog($job->id);
			//print_r($job);
			if (count($log)>0){
				$data['jobs'][$key]->lastlog=$log[0]->id;
				$data['jobs'][$key]->logdate=$log[0]->excuted;
			}
			else
			{
				$data['jobs'][$key]->logdate='No log found';
			}
			
		}
		$this->load->view('header');
		$this->load->view('admin',$data);
		$this->load->view('footer');	
	
	}

function runnow()
{
	$this->load->helper('file');
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
	//echo 'point::'.$this->apis[$connection->api_target]->write_point;exit;
	
	$sync_log=$api_target->Create($this->apis[$connection->api_target]->write_point,$res,json_decode($connection->target_fields));
	
	$targetpoint=$api_target->api['users'];
	echo 'point:::'.$targetpoint;exit;
	//$sync_log=$api_target->Create($this->apis[$connection->api_target]->write_point,$res,json_decode($connection->target_fields));
//	$sync_log=$api_target->Create($targetpoint,$res,json_decode($connection->target_fields));
	
	$sync_o =new stdClass;;
	$sync_o->scheduleID=-1;
	$sync_o->excuted=time();
	$sync_o->connectionid=$id;
	$this->sync_log->create($sync_o);
	$logid=($this->sync_log->lastId());
	
	$fname="logs/".md5($logid).".txt";
	$sync_log_h ="Connection Name:".$connection->connection_name ."\r\n";
	$sync_log_h .="Date:".date('YMd H:i:s',$sync_o->excuted) ."\r\n";
	
    write_file($fname,$sync_log_h. $sync_log);
	
	$data['date']=date('YMd H:i:s',$sync_o->excuted);
	$data['id']=$logid;
	
	header('Content-Type: application/json');
	echo json_encode($data);
	
}

function download($id)
{
	$this->load->helper('download');
	$this->load->helper('file');

	//$data = file_get_contents("/path/to/photo.jpg"); // Read the file's contents
	$data =read_file('logs/'.md5($id).'.txt');
	$name = 'log.txt';

	force_download($name, $data);
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

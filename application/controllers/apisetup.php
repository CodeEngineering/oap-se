<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class apisetup extends CI_Controller {
var  $connectors=array();
private $apis=array();
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('tank_auth');
		$this->load->model('connector');
		$this->load->model('scheduler');
		$this->connectors=array();
		$this->connectors[0]=new oap_connector();
		$this->connectors[1]= new se_connector();
		$this->load->model('api');
		$this->apis=$this->api->getall();;
		
	}
	
function get_user_connection($userid)
{
		$this->load->model('sync_log');
		$this->load->model('scheduler');
		$this->load->model('connector');
		$this->load->model('api');
		$data['jobs']=$this->connector->get_scheduled_job_today($userid);
		//print_r($data['jobs']);exit;
		foreach ($data['jobs'] as $key=>$job)
		{
			//echo print_r($this->apis,1);
			$data['jobs']["$key"]->api_source=$this->apis[$data['jobs']["$key"]->api_source];//exit;
			$data['jobs'][$key]->api_target=$this->apis[$data['jobs'][$key]->api_target];
			$log=$this->sync_log->get_lastlog($job->id);
			//print_r($log);
			if (count($log)>0){
				$data['jobs'][$key]->lastlog=$log[0]->id;
				$data['jobs'][$key]->logdate=date('YMd H:i:s',$log[0]->excuted);
				
			}
			else
			{
				$data['jobs'][$key]->logdate='No log found';
				$data['jobs'][$key]->lastlog=-1;
			}
			
		};
		return $data['jobs'];
}
	function index($id=null)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role']		= $this->tank_auth->get_role();		
		$data['connection']=new stdClass();
		$data['connection']->id             ='';
		$data['connection']->connection_name='';
		$data['connection']->description    ='';
		$data['connection']->api_source     ='';
		$data['connection']->api_target     ='';
		$data['connection']->schedule       =0;
		if (!is_null($id))
		{
			$list=$this->connector->getAll(1, array('user'=>'desc'), array('id'=>$id)); 
			$data['connection']=$list[0];			
			//print_r($data);
		}
		
		$connectors_list=array();
		foreach ($this->connectors as $key=>$val)
		{	
			$connectors_list[]=$val->name;
		}	
		$data['connectors_list']=$connectors_list;
		$data['jobs']=$this->get_user_connection($data['user_id']);			
			
			header('Content-Type: text/html; charset=utf-8');
			$this->load->view('connection_setup/common/header2',$data);
			$this->load->view('connection_setup/api_cred',$data);
			$this->load->view('connection_setup/common/footer');

	}

		
	}
	?>
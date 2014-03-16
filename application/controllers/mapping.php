<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mapping extends CI_Controller {
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
		
	}

	public function index()
	{
		//$this->connectors[0]->create_section($this->connectors[0]->api['users']); 
		$this->connectors[0]->get_key($this->connectors[0]->api['users']); 
		exit;
		redirect('/mapping/step01/');
		$this->load->view('header');
		$this->load->view('content1');
		$this->load->view('footer');
		//connector list
		

	}
	function Load_all_connector()
	{
		$oap= new oap_connector();
		$se= new se_connector();
		$connectors=array($oap->name,$se->name);
		ob_start();
		echo form_open('mapping/save',array('name'=>'map','method'=>'post'));
		echo form_hidden('map_id', '0');
		echo "<table>";
		echo "<tr>";
		echo "<td>".form_dropdown('connector_from',$connectors)."</td>";
		echo "<td><span class='glyphicon glyphicon-arrow-right'></span></td>";
		echo "<td>".form_dropdown('connector_to',$connectors)."</td>";
		echo "<td>include</td>";
		echo "</tr>";
		
		foreach ($oap->key['users']['Contact Information'] as $key=>$oap_field)
		{
			echo "<tr>";
			echo "<td>".form_dropdown($oap->name.'_'.$key, $oap->key['users']['Contact Information'],$key)."</td>";
			echo "<td><span class='glyphicon glyphicon-arrow-right'></span></td>";
			echo "<td>".form_dropdown($se->name.'_'.$key, $se->key['users']) ."</td>";
			echo "<td>".form_checkbox('include_'.$key, '', TRUE)."</td>";
			echo "</tr>";
			
		}
		echo "</table>";
		echo form_submit('submit', 'Save Map');
		echo form_close();
		$data['map']=ob_get_clean();
		header('Content-Type: text/html; charset=utf-8');
		$this->load->view('header');
		$this->load->view('content1',$data);
		$this->load->view('footer');
		//print_r($se->key);
		//print_r($oap->key);
	}
	function save()
	{
		$this->load->model('connector_map');
		$map=new connector_map();
		print_r($this->input->post());
	}
/**
**
** Form guide : step 1
**
**/
	function step01($id=null)
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

		header('Content-Type: text/html; charset=utf-8');
		$this->load->view('connection_setup/common/header',$data);
		$this->load->view('connection_setup/step01',$data);
		$this->load->view('connection_setup/common/footer');		
	}

	
/**
Form guide : step 2

Description:
	Select target fields
**/
	
	function step02($id=null)
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
		$id=is_null($id)?$this->saveform($id):$id;
		
		if (!is_null($id))
		{
			$list=$this->connector->getAll(1, array('user'=>'desc'), array('id'=>$id)); 
			$data['connection']=$list[0];			
		}
		$connectors_list=array();
		foreach ($this->connectors as $key=>$val)
		{	
			$connectors_list[]=$val->name;
		}	
		$data['connectors_list']=$connectors_list;

		$connector_to  =$this->connectors[$data['connection']->api_target];
		$to_fields     =$connector_to->Fields('user');
		foreach ($to_fields as $key=>$field)
		{
			if($field['show']==true)
			{
				$to_drop[$key]=$field['field'];
			}
		}
		$data['api_target_fields']=$to_drop;
		
		
		header('Content-Type: text/html; charset=utf-8');
/* 		$this->load->view('header',array('cal'=>false));
		$this->load->view('step02',$data);
		$this->load->view('footer'); */
		$this->load->view('connection_setup/common/header',$data);
		$this->load->view('connection_setup/step02',$data);
		$this->load->view('connection_setup/common/footer');		
	}

/**
** Form guide : step 3
**
select source fields
**/
	
	function step03($id=null)
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
		$id=is_null($id)?$this->saveform($id):$id;
		
		if (!is_null($id))
		{
			$list=$this->connector->getAll(1, array('user'=>'desc'), array('id'=>$id)); 
			$data['connection']=$list[0];			
		}
		$connectors_list=array();
		foreach ($this->connectors as $key=>$val)
		{	
			$connectors_list[]=$val->name;
		}	
		$data['connectors_list']=$connectors_list;

		$connector_to  =$this->connectors[$data['connection']->api_target];
		$to_fields     =$connector_to->Fields('user');
		foreach (json_decode($data['connection']->target_fields) as $target_field)
		{
			$to_drop[$target_field]=$to_fields[$target_field]['field'];
			
		}
		$data['api_target_fields']=$to_drop;
		
		$connector_from=$this->connectors[$data['connection']->api_source];
		$from_fields   =$connector_from->Fields('user');
		foreach ($from_fields as $key0=>$section)
		{
			$tmp=array();
			foreach ($section as $key=>$field)
			{
				if($field['show']==true)
				{
					//$from_drop[$key0.'_'.$key]=$field['field'];
					$tmp[$key0.'__'.$key]=$field['field'];
				}
			}
		$from_drop[$key0]=$tmp;			
				
		}
		$data['api_source_fields']=$from_drop;
		
		
		
		header('Content-Type: text/html; charset=utf-8');
/* 		$this->load->view('header',array('cal'=>false));
		$this->load->view('step03',$data);
		$this->load->view('footer'); */	
		$this->load->view('connection_setup/common/header',$data);
		$this->load->view('connection_setup/step03',$data);
		$this->load->view('connection_setup/common/footer');			
	}

/**
** Form guide : step 4
**
define source filter
**/
	
	function step04($id=null)
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
		$id=is_null($id)?$this->saveform($id):$id;
		
		if (!is_null($id))
		{
			$list=$this->connector->getAll(1, array('user'=>'desc'), array('id'=>$id)); 
			$data['connection']=$list[0];			
		}
		$connectors_list=array();
		foreach ($this->connectors as $key=>$val)
		{	
			$connectors_list[]=$val->name;
		}	
		$data['connectors_list']=$connectors_list;

		$connector_to  =$this->connectors[$data['connection']->api_target];
		$to_fields     =$connector_to->Fields('user');
		foreach (json_decode($data['connection']->target_fields) as $target_field)
		{
			$to_drop[$target_field]=$to_fields[$target_field]['field'];
			
		}
		$data['api_target_fields']=$to_drop;
		
		$connector_from=$this->connectors[$data['connection']->api_source];
		$from_fields   =$connector_from->Fields('user');
		
/* 		foreach ($from_fields as $key=>$field)
		{
			if($field['show']==true)
			{
				$from_drop[$key]=$field['field'];
				$field_type[$key]=$field['type'];
			}
		}	 */
		
	foreach ($from_fields as $key0=>$section)
		{
			$tmp=array();
			foreach ($section as $key=>$field)
			{
				if($field['show']==true)
				{
					//$from_drop[$key0.'_'.$key]=$field['field'];
					$tmp[$key0.'__'.$key]=$field['field'];
					$field_type[$key0.'__'.$key]=$field['type'];
				}
			}
		$from_drop[$key0]=$tmp;			
				
		}
		//$from_drop=$from_fields;
		$data['api_source_fields']=$from_drop;
		$data['api_source_filter']=$connector_from->filters;
		$data['api_source_type']=$field_type;
		
		
		header('Content-Type: text/html; charset=utf-8');
/* 		$this->load->view('header',array('cal'=>false));
		$this->load->view('step04',$data);
		$this->load->view('footer');	 */

		$this->load->view('connection_setup/common/header',$data);
		$this->load->view('connection_setup/step04',$data);
		$this->load->view('connection_setup/common/footer');			
	}
	
/**
** Form guide : step 5
**
create schedule to sync data
**/
	
	function step05($id=null)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		
		$data['user_id']	                = $this->tank_auth->get_user_id();
		$data['username']	                = $this->tank_auth->get_username();
		$data['connection']                 =new stdClass();
		$data['scheduler']                  =new stdClass();
		$data['scheduler']->id              =0;
		$data['scheduler']->weekdays_type   ='10pm';
		$data['scheduler']->days            =0;
		$data['scheduler']->{'sync-interval'}   ='0.5';
		
		$data['scheduler']->{'mon-enabled'}      =1;
		$data['scheduler']->{'tue-enabled'}      =1;
		$data['scheduler']->{'wed-enabled'}      =1;
		$data['scheduler']->{'thu-enabled'}      =1;
		$data['scheduler']->{'fri-enabled'}      =1;
		$data['scheduler']->{'sat-enabled'}      =1;
		$data['scheduler']->{'sun-enabled'}      =1;
		$defualt=strtotime("00:00");
		$data['scheduler']->{"mon-start"}    =$defualt;
		$data['scheduler']->{"tue-start"}    =$defualt;
		$data['scheduler']->{"wed-start"}    =$defualt;
		$data['scheduler']->{"thu-start"}    =$defualt;
		$data['scheduler']->{"fri-start"}    =$defualt;
		$data['scheduler']->{"sat-start"}    =$defualt;
		$data['scheduler']->{"sun-start"}    =$defualt;
				
		$data['scheduler']->{"mon-end"}      =$defualt;
		$data['scheduler']->{"tue-end"}      =$defualt;
		$data['scheduler']->{"wed-end"}      =$defualt;
		$data['scheduler']->{"thu-end"}      =$defualt;
		$data['scheduler']->{"fri-end"}      =$defualt;
		$data['scheduler']->{"sat-end"}      =$defualt;
		$data['scheduler']->{"sun-end"}      =$defualt;
		
		
		$data['connection']->id             ='';
		$data['connection']->connection_name='';
		$data['connection']->description    ='';
		$data['connection']->api_source     ='';
		$data['connection']->api_target     ='';
		$data['connection']->schedule       =0;
		$id=is_null($id)?$this->saveform($id):$id;
		if (!is_null($id))
		{
			$list=$this->connector->getAll(1, array('user'=>'desc'), array('id'=>$id)); 
			$data['connection']=$list[0];			
		}else
		{
		 redirect('/step01/', 'refresh');
		}
		if($data['connection']->schedule>0)
		{
			$schedule=$this->scheduler->getAll(1,null,array('id'=>$data['connection']->schedule));
			$data['scheduler']=$schedule[0];
		}
		
		
		
		header('Content-Type: text/html; charset=utf-8');
	/* 	$this->load->view('header',array('cal'=>true));
		$this->load->view('step05',$data);
		$this->load->view('footer'); */	

		$this->load->view('connection_setup/common/header',$data);
		$this->load->view('connection_setup/step05',$data);
		$this->load->view('connection_setup/common/footer');			
	}	

/**
** Form guide : step 6
**
create summary
**/
	
	function step06($id=null)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		//echo '<pre>';
		//print_r($_POST);exit;
		$data['user_id']	                = $this->tank_auth->get_user_id();
		$data['username']	                = $this->tank_auth->get_username();
		$data['connection']                 =new stdClass();
		$data['scheduler']                  =new stdClass();
		
		$id=is_null($id)?$this->saveform($id):$id;
		if (!is_null($id))
		{
			$list=$this->connector->getAll(1, array('user'=>'desc'), array('id'=>$id)); 
			$data['connection']=$list[0];			
			if($data['connection']->schedule>0)
			{
				$schedule=$this->scheduler->getAll(1,null,array('id'=>$data['connection']->schedule));
				$data['scheduler']=$schedule[0];
			}
			
		}else
		{
		 redirect('/step01/', 'refresh');
		}
		//print_r($data);
		
		$data['connection']->api_source=$this->connectors[$data['connection']->api_source]->name;
		$data['connection']->api_target=$this->connectors[$data['connection']->api_target]->name;
		
		header('Content-Type: text/html; charset=utf-8');
/* 		$this->load->view('header',array('cal'=>true));
		$this->load->view('step06',$data);
		$this->load->view('footer'); */	
		$this->load->view('connection_setup/common/header',$data);
		$this->load->view('connection_setup/step06',$data);
		$this->load->view('connection_setup/common/footer');			
	}	

	function step07($id=null)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		
		$this->load->model('sync_log');
		$this->load->model('scheduler');
		$this->load->model('connector');
		$this->load->model('api');
		$this->scheduler->get_todays_schedule();
		$this->scheduler->get_todays_schedule();
		$this->apis=$this->api->getall();;
		
		$data['user_id']	                = $this->tank_auth->get_user_id();
		$data['username']	                = $this->tank_auth->get_username();
		$data['connection']                 =new stdClass();
		$data['scheduler']                  =new stdClass();
		
	/* 	//$id=is_null($id)?$this->saveform($id):$id;
		if (!is_null($id))
		{
			$list=$this->connector->getAll(1, array('user'=>'desc'), array('id'=>$id)); 
			$data['connection']=$list[0];			
			if($data['connection']->schedule>0)
			{
				$schedule=$this->scheduler->getAll(1,null,array('id'=>$data['connection']->schedule));
				$data['scheduler']=$schedule[0];
			}
			
		}else
		{
		 redirect('/step01/', 'refresh');
		}	 */	
		
		//$data=null;
		$data['jobs']=$this->connector->get_scheduled_job_today($data['user_id']);
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
		//$this->load->view('header');
		//$this->load->view('admin',$data);
		//$this->load->view('footer');	
/* 		$this->load->view('header',array('cal'=>true));
		$this->load->view('step07',$data);
		$this->load->view('footer') */;	
		$this->load->view('connection_setup/common/header',$data);
		$this->load->view('connection_setup/step07',$data);
		$this->load->view('connection_setup/common/footer');		
	}
	function saveform($id=null)
	{
		if (!isset($_POST['form'])){return false;}
		$o= new stdClass(); ;
		switch ($_POST['form'])
		{
			case 'step01': //init api connection
			{
				$o->id             =(int)$this->input->post('id');
				$o->connection_name=$this->input->post('connection_name');
				$o->description    =$this->input->post('description');
				$o->api_source     =$this->input->post('api_source');
				$o->api_target     =$this->input->post('api_target');
				break;
			}
			case 'step02': // target api fields
			{
				$o->id                      =(int)$this->input->post('id');
				$targets                    =$this->input->post('api_targets');
				
				$o->target_fields		    =json_encode($targets);
				//$o->source_fields		    =json_encode( array_fill(0, count($targets), 0));
				break;
			}
			case 'step03': // source api fields
			{
				$o->id                      =(int)$this->input->post('id');
				$source                     =$this->input->post('api_source_fields');
				$o->source_fields		    =json_encode( $source);
				break;
			}
			case 'step04': // source filters
			{
				$o->id =(int)$this->input->post('id');
				$filters['field']=array();
				$filters['operation']=array();
				$filters['value']=array();
				if (isset($_POST['source_filter_field']))
				{
					$filters['field']=$_POST['source_filter_field'];
				}				
				if (isset($_POST['source_filter_operation']))
				{
					$filters['operation']=$_POST['source_filter_operation'];
				}
				if (isset($_POST['source_filter_value']))
				{
					$filters['value']=$_POST['source_filter_value'];
				}
				$filters=json_encode($filters);
				$o->source_filter=$filters;
				
				break;
			}
			case 'step05'://schedule
			{
				
				$o->id =(int)$this->input->post('id');
				$schedule=new stdclass;
				
				$schedule->id=(int)$this->input->post('schedule');//same as $connection->schedule
				$schedule->userID=$this->tank_auth->get_user_id();
				$schedule->connectionID=(int)$this->input->post('connectionid');
				$schedule->weekdays_type=$this->input->post('weekdays');
				
				$start__=$this->input->post('start');
				$end__=$this->input->post('end');
				$enabled=$this->input->post('enabled');
				$weekdays=$this->input->post('weekdays');
				$days=$this->input->post($weekdays);
				//print_r($start__);
				//print_r($end__);
				$schedule->{'mon-enabled'}=isset($enabled[1])?1:0;
				$schedule->{'tue-enabled'}=isset($enabled[2])?1:0;
				$schedule->{'wed-enabled'}=isset($enabled[3])?1:0;
				$schedule->{'thu-enabled'}=isset($enabled[4])?1:0;
				$schedule->{'fri-enabled'}=isset($enabled[5])?1:0;
				$schedule->{'sat-enabled'}=isset($enabled[6])?1:0;
				$schedule->{'sun-enabled'}=isset($enabled[0])?1:0;
				$start=array(0,0,0,0,0,0,0);
				$end=array(0,0,0,0,0,0,0);
				foreach($enabled as $key=>$en)
				{
					$start[$key]=$start__[$key];
					$end[$key]=$end__[$key];
				}
				
				$schedule->{'mon-start'}=strtotime($start[1]);
				$schedule->{'tue-start'}=strtotime($start[2]);
				$schedule->{'wed-start'}=strtotime($start[3]);
				$schedule->{'thu-start'}=strtotime($start[4]);
				$schedule->{'fri-start'}=strtotime($start[5]);
				$schedule->{'sat-start'}=strtotime($start[6]);
				$schedule->{'sun-start'}=strtotime($start[0]);
				$schedule->{'mon-end'}=strtotime($end[1]);
				$schedule->{'tue-end'}=strtotime($end[2]);
				$schedule->{'wed-end'}=strtotime($end[3]);
				$schedule->{'thu-end'}=strtotime($end[4]);
				$schedule->{'fri-end'}=strtotime($end[5]);
				$schedule->{'sat-end'}=strtotime($end[6]);
				$schedule->{'sun-end'}=strtotime($end[0]);
				$schedule->{'sync_interval'}=$this->input->post('sync_interval');;
				if($schedule->id>0)
				{
					$o->schedule=$schedule->id;
					$this->scheduler->update($schedule);
				}else
				{
					unset($schedule->id);
					$this->scheduler->create($schedule);
					$o->schedule=$this->scheduler->lastid();
				}
				$o->last_run=strtotime('yesterday');
				$o->nextrun=strtotime('yesterday');
				$o->id =(int)$this->input->post('id');
				$o->connectionID =(int)$this->input->post('id');
				break;
			}
			
		}
		if ($o->id>0)//update
		{
			$this->connector->update($o);
			return $o->id;
		}
		else //create new one
		{
			unset($o->id);
			$this->connector->create($o);
			return $this->connector->lastId();
		}
		
		

	}

	
	function step1()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role']		= $this->tank_auth->get_role();		
		
		$connectors_list=array();
		foreach ($this->connectors as $key=>$val)
		{	
			$connectors_list[]=$val->name;
		}
		$list=$this->connector->getAll(1, array('user'=>'desc'), array('user'=>$data['user_id'])); 
		$list=$list[0];
		
		ob_start();
		echo form_open('mapping/step2',array('name'=>'map','method'=>'post'));
		echo form_hidden('map_id', '0');
		
		echo "<table>";
		echo "<tr>";
			echo "<td>".form_dropdown('connector_from',$connectors_list,$list->api_from)."</td>";
			echo "<td><span class='glyphicon glyphicon-arrow-right'></span></td>";
			echo "<td>".form_dropdown('connector_to',$connectors_list,$list->api_to)."</td>";
		echo "</tr>";
		echo "</table>";
		echo form_submit('submit', 'Step 2');
		echo form_close();
		$data['map']=ob_get_clean();
		$data['step']="Select API conncetion pair";
		header('Content-Type: text/html; charset=utf-8');
		$this->load->view('header');
		$this->load->view('step1',$data);
		$this->load->view('footer');		
	}

	function step2()
	{		
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role']		= $this->tank_auth->get_role();
		
		$connector_from=$this->connectors[$this->input->post('connector_from')];//0
		$connector_to  =$this->connectors[$this->input->post('connector_to')];//1
		$to_fields     =$connector_to->Fields('user');
		$from_fields   =$connector_from->Fields('user');
		
		foreach ($from_fields as $key=>$field)
		{
			if($field['show']==true)
			{
				$from_drop[$key]=$field['field'];
			}
		}
		foreach ($to_fields as $key=>$field)
		{
			if($field['show']==true)
			{
				$to_drop[$key]=$field['field'];
			}
		}
		$list=$this->connector->getAll(1, array('user'=>'desc'), array('user'=>$data['user_id'])); 
		$list=$list[0];
		$include=json_decode($list->selection);
		$map=json_decode($list->map);
		//echo '<pre>';
		//print_r($map);
		ob_start();
		echo form_open('mapping/step3',array('name'=>'map','method'=>'post'));
		echo form_hidden('map_id', '0');
		echo form_hidden('connector_from', $this->input->post('connector_from'));
		echo form_hidden('connector_to', $this->input->post('connector_to'));
		echo "<table>";
		echo "<tr>";
			echo "<th>Include </th>";
			echo "<th>".$connector_to->name."</th>";
			echo "<th><span class='glyphicon glyphicon-transfer'></span></th>";
			echo "<th>".$connector_from->name."</th>";
		echo "</tr>";
		
		foreach ($to_drop as $key=>$to)
		{
			//echo "<pre>";
			//print_r($from_fields);exit;
				echo "<tr>";
				echo "<td>".form_checkbox('include[]', $key, in_array($key,$include))."</td>";
				echo "<td>".form_input(array('name'=>$connector_to->abr."[$key]",'value'=>$to,'readonly'=>true))."</td>";
				echo "<td><span class='glyphicon glyphicon-transfer'></span></td>";
				if(isset($map->{$key}->{$connector_from->abr}[0]))
				{
					$map__=$map->{$key}->{$connector_from->abr}[0];
				}else
				{
					$map__='';
				}
				echo "<td>".form_dropdown($connector_from->abr."[$key]", $from_drop,$map__) ."</td>";
				//echo form_hidden('connector_to__[]', $to_fields[$key]);
				echo "</tr>";	
		}
		echo "</table>";
		echo form_submit('submit', 'Step 3');
		echo form_close();
		
		$data['map']=ob_get_clean();
		$data['step']="Choose field maps";
		header('Content-Type: text/html; charset=utf-8');
		$this->load->view('header');
		$this->load->view('content1',$data);
		$this->load->view('footer');		
	}	
	function step3()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role']		= $this->tank_auth->get_role();		
		
		$connector_from=$this->connectors[$this->input->post('connector_from')];
		$connector_to  =$this->connectors[$this->input->post('connector_to')];
		$from_fields   =$connector_from->Fields('user');
		
		$from_drop =$this->input->post($connector_from->abr);
		$to_drop   =$this->input->post($connector_to->abr);
		
		ob_start();
		
		$set=array();
		foreach ($this->input->post('include') as $key)
		{	
			$pair=array(
					$connector_from->abr=>array($from_drop[$key],$from_fields[$from_drop[$key]]['field']),
					$connector_to->abr=>array($key,$to_drop[$key])
				);
			$set[$key]=$pair;
		}
		//$o=new class();
		$o->user     =$this->tank_auth->get_user_id();
		$o->api_from =$this->input->post('connector_from');
		$o->api_to   =$this->input->post('connector_to');
		$o->fields1  =json_encode($this->input->post($connector_from->abr));
		$o->fields2  =json_encode($this->input->post($connector_to->abr));
		$o->map      =json_encode($set);
		$o->selection=json_encode($this->input->post('include'));
		
		$this->connector->create($o);
		
		$data['map']=ob_get_clean();
		$data['step']="Saving configuration";
		header('Content-Type: text/html; charset=utf-8');
		
		$this->load->view('header');
		$this->load->view('content1',$data);
		$this->load->view('footer');		
	}
function test()
{
//$this->scheduler->get_todays_schedule();
$now=time();
$interval=1.5*60;
$hr=(int) ($interval / 60);
$min=$interval % 60;
$start=strtotime('01:00');
$end=strtotime('22:00');
$interval=1.5;
echo date('m-d-Y H:i:s',$this->scheduler->next_run2day($start,$end,$interval));
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

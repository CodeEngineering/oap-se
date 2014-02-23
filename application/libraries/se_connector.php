<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class se_connector{
	var $key=array();
	var $name="Social Engine";
	var $abr="SE";
	var $debug=false;
	var $users_fields=array();
	
	function __construct()
	{
		$this->ci =& get_instance();	
		include('se.fields.php');
		$this->users_fields=$user_fieldlist;
	}
var  $api=array (
				'users'	=>"http://se4api.bpsstaging.com/restapi/users/" 
				);

 var $form_fields=array(
				"K"      =>'',
			);				
				
/*************************************************************************************/
/*
	common variables
	-- $name
	-- $abv
	common functions for all api call
	-- function Fields($point,$data=null)
	-- function Create($point,$data=null)
	-- function Read($point,$data=null)
	-- function Search($point,$data=null)
	-- function Update($point,$data=null)
	-- function Delete($point,$data=null)
	
*/
/*************************************************************************************/

function Fields($data='user')
{
	switch ($data)
	{
		case 'user':
		{
			$fields=$this->users_fields;	
			break;
		}
	}
	
	return $fields;
}
function Create($point,$data=null,$fields)
{
$counter=1;
$log='';
	foreach($data as $key=>$dat)
	{
		$log .="$counter ) ";
		$this->form_fields=array();
		$this->form_fields['K']='';
		
		foreach($fields as $key2=>$field)
		{
			$this->form_fields[$this->users_fields[$field]['field']]=$dat[$key2];
		}
		if (array_key_exists ('displayname',$this->form_fields))
		{
			$this->form_fields['displayname']=preg_replace("~[\W\s]~", '',$this->form_fields['displayname']);
		} 		//preg_replace('~[\W\s]~', '_', $filename);
		if (array_key_exists ('username',$this->form_fields))
		{
			$this->form_fields['username']=preg_replace("~[\W\s]~", '',$this->form_fields['username']);
		} 
		
		$this->form_fields['password']='socialengine';
		//print_r($this->form_fields);
		$res= $this->execute($point,$this->form_fields,'post');
		//print_r($res);
		if (isset($res['error']))
		{
			
			foreach ($res['error'] as $key=>$err)
			{
				if (count($err)>0)
				{

				$log .=$this->form_fields[$key] .':'.$err[0]."\r\n";
				}
			}
		}else
		{
			$log .=$this->form_fields['username'] .':ok'."\r\n";
		}
		if(isset($res['user_id']))
		{
			$counter ++;
		}
		
	}
	return $log;


}
function Read($point,$data=null)
{
	$this->form_fields->data=$data;
	$this->form_fields->reqType='fetch';
	$res= $this->execute($point,$this->form_fields);
	return $res;	
}
function Search($point,$data=null)
{
	$this->form_fields->data=$data;
	$this->form_fields->reqType='fetch';
	$res= $this->execute($point,$this->form_fields);
	return $res;	
}
function Update($point,$data=null)
{
	$this->form_fields->data=$data;
	$this->form_fields->reqType='update';
	$res= $this->execute($point,$this->form_fields);
	return $res;	
	}
function Delete($point,$data=null)
{
	$this->form_fields->data=$data;
	$this->form_fields->reqType='search';
	$res= $this->execute($point,$this->form_fields);
	return $res;	
}

/**
Create: POST /restapi/users
params: email, password, username 
*/


	function connect_toSE()
	{
		$param['key']='4ab8bcc0a5db94ab3a42c9db20c13cad52cbced062fe6';// this is IP dependent.
		$param['creation_date_from']='2014-01-01';
		$param['creation_date_to']='2014-01-05';
		echo 'result:'.$this->execute($point,$param);
	}
	private function key__()
	{
	//get one user and return the fields
		$point=$this->api['users'];
		$res=$this->execute($point);
		$fields=array_keys($res[0]);
		return $fields;
		//echo "<pre>";
		//print_r($fields);

	}
	
function execute($point,$form=array(),$method='get')
	{

		$this->ci->curl->create($point);
		switch($method)
		{
			case 'get':
			{
				$this->ci->curl->get($form);
				break;
				}
			case 'post':
			{
				$this->ci->curl->post($form);
				break;
				}
			case 'put':
			{
				$this->ci->curl->put($form);
				break;
				}
		}
		
		//$this->ci->curl->proxy('http://cache2.lrdc.lexmark.com'); 
		//$this->ci->curl->proxy_login('mtel', 'Lexmark#321');

			$res= $this->ci->curl->execute();
			return $this->ci->format->factory($res,'json')->to_array();
			
// debug
	if ($this->debug){
		echo '<pre>'.$this->curl->error_code ."<br/>"; // int
		echo $this->curl->error_string . "<br/>";

		print_r($this->curl->info); // array 			
		echo "</pre>";
}
	}	
	}
?>
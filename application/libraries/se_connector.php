<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class se_connector{
	var $key=array();
	var $name="Social Engine";
	var $abr="SE";
	var $debug=false;
	var $users_fields=array();
	var $log='';
	var  $api=array (
					'users'	=>"http://clickinback.com/restapi/users/" 
					);

	 var $form_fields=array(
				"K"      =>'da54058d360f73e7e404a6f9cf7c5da9532fd805f0ef9',
			);				
	
	function __construct()
	{
		$this->ci =& get_instance();	
		include('se.fields.php');
		$this->users_fields=$user_fieldlist;
		if ($_SERVER['SERVER_ADDR']=='72.52.150.216')//bpsstaging.com
		{
			$this->form_fields['K']='da54058d360f73e7e404a6f9cf7c5da9532fd805f0ef9';
		}
		
	}				
				
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
echo 'create(point):'.$point;
	foreach($data as $key=>$dat)
	{
		$log .="$counter ) ";
		//$this->form_fields=array();
		//$this->form_fields['K']='';
		//print_r($dat);exit;
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
		
		if (trim($this->form_fields['password'])=='')
		{
			$this->form_fields['password']='socialengine';
		}
		//print_r($this->form_fields);exit;
		$res= $this->execute($point,$this->form_fields,'post');
		
		//print_r($res);
		if (isset($res['error']))
		{
			
			$log .=print_r($this->form_fields,1)."\r\n";
			$log .=print_r($res,1)."\r\n";

		}else
		{
			$log .=$this->form_fields['username'] .':ok'."\r\n";
		}
		//if(isset($res['user_id']))
		{
			$counter ++;
		}
		
	}
//echo $log;
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

echo 'point:'.$point.'<br/>'.print_r($form,1).'<hr/>';		
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
		
		

			$res= $this->ci->curl->execute();
			echo 'result:'.$res.'<hr/>';
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

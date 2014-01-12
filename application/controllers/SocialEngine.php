<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SocialEngine extends CI_Controller {
	var $debug=true;
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}
var  $api=array (
				'users'	=>"http://se4api.bpsstaging.com/restapi/users/" 
				
				
				);
	
	function connect_toSE()
	{
		$param['key']='4ab8bcc0a5db94ab3a42c9db20c13cad52cbced062fe6';// this is IP dependent.
		$param['creation_date_from']='2014-01-01';
		$param['creation_date_to']='2014-01-05';
		echo 'result:'.$this->execute($point,$param);
	}
	function key()
	{
	//get one user and return the fields
		$point=$this->api['users'];
		$res=$this->execute($point);
		$fields=array_keys($res[0]);
		echo "<pre>";
		print_r($fields);

	}
	
function execute($point,$form=array(),$method='get')
	{

		$this->curl->create($point);
		switch($method)
		{
			case 'get':
			{
				$this->curl->get($form);
				break;
				}
			case 'post':
			{
				$this->curl->post($form);
				break;
				}
			case 'put':
			{
				$this->curl->put($form);
				break;
				}
		}
		
		$this->curl->proxy('http://cache2.lrdc.lexmark.com'); 
		$this->curl->proxy_login('mtel', 'Lexmark#321');

			$res= $this->curl->execute();
			return $this->format->factory($res,'json')->to_array();
			
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class oap extends CI_Controller {
//The Contact Database API located at 

var  $api=array (
				'Contact'	=>"http://api.moon-ray.com/cdata.php", 
				'Product'	=>"http://api.moon- ray.com/pdata.php",
				'Forms'		=>"http://api.moon-ray.com/fdata.php" 
				);
 var $form_fields=array(
				"Appid"    =>'2_8431_bRCOCALyZ',
				"Key"      =>'ZIzXnKdwkBgsRXb',
				"reqType"  =>'',
				"data"     =>'',//xml format
				'f_add'    =>0,
				'return_id'=>1
				
			);


var $request=array('key','search','fetch','add','update','fetch_tag','fetch_sequence','sale','refund','delete');

			
			
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}
	function key()
	{
		$this->form_fields['reqType']='key';
		$this->form_fields['data']='';
		//$dat=$this->curl->simple_post($this->api['Contact'], $this->form_fields);
		 $this->execute($this->api['Contact'],$this->form_fields);
		//echo $dat;
	}
	function search($fields)
	{
		$search='';
		foreach ($fields as $field=>$val)
		{
			$entry   ="<equation>";
			$entry  .="<field>$field</field>";
			$entry  .="<op>".$val[0]."</op>";
			$entry  .="<value>".$val[1]."</value>";
			$entry  .="</equation>";
			$search .=$entry;
		}
		$this->$form_fields['key']='search';
		$this->$form_fields['data']=$search;
	}
	function fetch($ids,$field='id')
	{
		$search='';
		if(is_array($ids))
		{
			foreach ($ids as $field=>$val)
			{	
				$entry  ="<$field>$val</$field>";
				$search .=$entry;
			}
		}
		else
		{
			$search="$fields=$ids";
		}
		$this->$form_fields['key']='fetch';
		$this->$form_fields['data']=$search;
	}	
	function execute($point,$form)
	{

			$this->curl->create($point);
			$this->curl->post($form);
$this->curl->proxy('http://cache2.lrdc.lexmark.com'); 
// Proxy login
$this->curl->proxy_login('mtel', 'Lexmark#321');

			$res= $this->curl->execute();
			$res=$this->format->factory($res,'xml')->to_array();
			echo "<pre>";
			$contact=array();
			foreach ($res['contact']['Group_Tag'] as $key=>$val)
			{
				//echo "$key :" . print_r($val['@attributes'],1);
				$fieldname=array();
				foreach ($val['field'] as $key=>$field_name)
				{
					$fieldname[]=$field_name['@attributes']['name'];
					}
				$contact[$val['@attributes']['name']]=$fieldname;
				
			}
			print_r($contact);
			//echo "<pre>";
			//print_r( );
			
// Errors
//echo $this->curl->error_code ."<br/>"; // int
//echo $this->curl->error_string . "<br/>";

// Information
//print_r($this->curl->info); // array 			
	}
}
?>
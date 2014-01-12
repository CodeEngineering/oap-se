<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class oap_connector {

var $key=array();
var $name="Office AutoPilot";
var $abr="oap";


function __construct()
{
	//parent::__construct();
	$this->ci =& get_instance();	
	//$this->key['users']=$this->key__();
	//$this->key['users']=$this->key['users']['Contact Information'];
}
	
var  $api=array (
				'users'	=>"http://api.moon-ray.com/cdata.php", 
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
function Fields($point,$data=null)
{
		$this->form_fields['reqType']='key';
		$this->form_fields['data']='';
		$res= $this->execute($point,$this->form_fields);
		return $this->key__($res);
}
function Create($point,$data=null)
{
$this->form_fields->data=$data;
$this->form_fields->reqType='add';
$res= $this->execute($point,$this->form_fields);
return $res;
/*<contact>
	<Group_Tag name="Contact Information">
		<field name="First Name">Testing</field>
		<field name="E-Mail">test@moon-ray.com</field>
	</Group_Tag>
</contact>
*/

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


//oap verbs
/*
	'key',
	'search',
	'fetch',
	'add',
	'update',
	'fetch_tag',
	'fetch_sequence',
	'sale',
	'refund',
	'delete'
*/
var $request=array('key','search','fetch','add','update','fetch_tag','fetch_sequence','sale','refund','delete');

			
			

	private function key__($data)
	{
		$res= $data;
		$contact=array();
		foreach ($res['contact']['Group_Tag'] as $key=>$val)
			{
				$fieldname=array();
				foreach ($val['field'] as $key=>$field_name)
				{
					$fieldname[]=$field_name['@attributes']['name'];
				}
				$contact[$val['@attributes']['name']]=$fieldname;
				
			}
			
		return $contact;
	}
	/*
		function search_xml($fields)
		@ $fields=array(array(
								'field'  	=>field name
								'operator'  =>	'e' - Equal 
												'n' - Not equal 
												's' - Starts with 
												'c' - Like (Ex. Email <op>c</op>@gmail.com will return a search of all the emails that match gmail.com) 
												'k' - Not Like 
												'l' - Less than 
												'g' - Greater Than 
												'm' - Less Than or Equal to 
												'h' - Greater Than or Equal to 
								'term'      => search term/keyword
							 ));
	
	*/
	function search_xml($fields)
	{
		
		$search='';
		foreach ($fields as $field=>$search)
		{
			$entry   ="<equation>";
			$entry  .="<field>".$search['field']."</field>";
			$entry  .="<op>".$search['operator']."</op>";
			$entry  .="<value>".$search['term']."</value>";
			$entry  .="</equation>";
			$search .=$entry;
		}
		
		return $search;
	}
	function fetch_xml($ids)
	{
		$search='';
		if(is_array($ids))
		{
			foreach ($ids as $field=>$fetch)
			{	
				$entry  ="<{$fetch['field']}>{$fetch['id']}</{$fetch['field']}>";
				$search .=$entry;
			}
		}
		else
		{
			$search="id=$ids";
		}
		
		return $search;
	}
	function add_xml($data,$type='contact')
	{
		$new_info='';
		foreach ($data as $key=>$infos)//key = group_tag name
		{
			$information='';
			foreach ($infos as $info)
			{
				$information.="<field name='{$info['field']}'>{$info['value']}</field>";
			}
			$information ="<Group_Tag name='$key'>$information</Group_Tag>";
			$new_info .="<$type> $information </$type>" ;
		}
		return  $new_info;
		/*
	<contact>
		<Group_Tag name=îContact Informationî>
			<field name="First Name">Testing</field>
			<field name="E-Mail">test@moon-ray.com</field>
		</Group_Tag>
	</contact>
	<contact>
		<Group_Tag name='Contact Information'>
			<field name="First Name">Testing</field>
			<field name="E-Mail">pin@moon- ray.com</field>
		</Group_Tag>
	</contact> 
*/
	}
	
	function update_xml($data,$type='contact')
	{
		$new_info='';
		foreach ($data as $key=>$infos)//key = group_tag name
		{
			$information='';
			foreach ($infos as $info)
			{
				$information.="<field name='{$info['field']}'>{$info['value']}</field>";
			}
			$grp_tag=explode('__',$key);
			$information ="<Group_Tag name='{$grp_tag[0]}'>$information</Group_Tag>";
			$new_info .="<$type id='{$grp_tag[1]}'> $information </$type>" ;
		}
		return $new_info;
		/*
	<contact>
		<Group_Tag name=îContact Informationî>
			<field name="First Name">Testing</field>
			<field name="E-Mail">test@moon-ray.com</field>
		</Group_Tag>
	</contact>
	<contact>
		<Group_Tag name='Contact Information'>
			<field name="First Name">Testing</field>
			<field name="E-Mail">pin@moon- ray.com</field>
		</Group_Tag>
	</contact> 
*/
	}
	
	
	function execute($point,$form)
	{

			$this->ci->curl->create($point);
			$this->ci->curl->post($form);
			$this->ci->curl->proxy('http://cache2.lrdc.lexmark.com'); 
			$this->ci->curl->proxy_login('mtel', 'Lexmark#321');
			$res= $this->ci->curl->execute();
			$res=$this->ci->format->factory($res,'xml')->to_array();
			return $res;
			


			
// Errors
//echo $this->curl->error_code ."<br/>"; // int
//echo $this->curl->error_string . "<br/>";

// Information
//print_r($this->curl->info); // array 			
	}
}
?>
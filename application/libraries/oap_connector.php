<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class oap_connector {


var $key=array();
var $name="Office AutoPilot";
var $abr="OAP";
var $users=array('Contact Information','Contact Attributes','Contact System Attributes','Lead Information','Sequences and Tags','Affiliate Data','Transaction Info','Credit Card');
private $users_fields=array();
private $active_fieldlist=array();
var $filters=array();
function __construct()
{
	//parent::__construct();
	$this->ci =& get_instance();	
	include('oap.fields.php');
	$this->users_fields=$user_fieldlist;
	$this->active_fieldlist=$active_fields;
	$this->filters=$filter_operation;
	//$this->key['users']=$this->key__();
	//$this->key['users']=$this->key['users']['Contact Information'];
}
	
var  $api=array (
				'users'	=>"http://api.moon-ray.com/cdata.php", 
				'Product'	=>"http://api.moon- ray.com/pdata.php",
				'Forms'		=>"http://api.moon-ray.com/fdata.php" 
				);
 var $form_fields=array(
				"Appid"    =>'2_10595_HBEw7rcFs',
				"Key"      =>'Ln33tNCGHaj32iw',
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
function Fields($data='user')
{
		$this->form_fields['reqType']='key';
		$this->form_fields['data']='';

		switch ($data)
		{
			case 'user':
			{
				//$res= $active_fields;//array_merge($this->users_fields['Contact Information'],$this->users_fields['Social Engine Membership Options']);
				foreach ($this->active_fieldlist as $key=>$list)
				{
					$res[$list]=$this->users_fields[$list];
				}
				break;
			}
			}
		return ($res);
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
function Search($point,$data=null,$fieldout=null)
{
	$data=$this->search_xml($data);
	//echo $data;exit;
	$this->form_fields['data']=$data;
	$this->form_fields['reqType']='search';
	$res= $this->execute($point,$this->form_fields);
	$result=array();
	foreach ($res['contact'] as $key=>$data)
	{
		$tmp=array();
		foreach($fieldout as $key=>$field)
		{
			if(!is_array($data['Group_Tag'][0]['field'][$field]))
			{$tmp[$key]=$data['Group_Tag'][0]['field'][$field];}
			else
			{$tmp[$key]='';}
		}
		$result[]=$tmp;
	}
	return $result;	
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

	function create_section($point)
	{
$data ='
<data>
<Group_Tag name="SE-section">
<field name="username" type="text"/>
<field name="password" type="text"/>
<field name="access Level" type="text"/>
</Group_Tag>
</data>
';
	$this->form_fields['data']=$data;
	$this->form_fields['reqType']='add_section';
	print_r($this->form_fields);
	$res= $this->execute($point,$this->form_fields);
	return $res;
	}			
public function get_key($point,$data=null)
{
	
	$this->form_fields['data']='';
	$this->form_fields['reqType']='key';
	print_r($this->form_fields);
	$res= $this->execute($point,$this->form_fields);
	return $res;
}	

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
		foreach ($fields->field as $key=>$field)
		{
			$entry   ="<equation>";
			$entry  .="<field>".$this->users_fields['Contact Information'][$field]['field']."</field>";
			$entry  .="<op>".$fields->operation[$key]."</op>";
			$entry  .="<value>".$fields->value[$key]."</value>";
			$entry  .="</equation>";
			$search .=$entry;
		}
		
		return '<search>'.$search.'</search>';
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
			//print_r($form);
			//$this->ci->curl->proxy('http://cache2.lrdc.lexmark.com'); 
			//$this->ci->curl->proxy_login('mtel', 'Lexmark#321');
			/*$res= '<?xml version="1.0" encoding="UTF-8"?>'.$this->ci->curl->execute*/
			$res= $this->ci->curl->execute();
			//echo 'result:'.$res;
			$res=$this->ci->format->factory($res,'xml')->to_array();
			echo '<pre>';
			print_r($res);
			return $res;
			


			
// Errors
//echo $this->curl->error_code ."<br/>"; // int
//echo $this->curl->error_string . "<br/>";

// Information
//print_r($this->curl->info); // array 			
	}
}
?>
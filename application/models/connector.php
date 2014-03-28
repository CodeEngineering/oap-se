<?php

/**
 * ACICRUD
 * @author Samuel Sanchez <samuel.sanchez.work@gmail.com>
 * @copyright © 2008 - 2009 - 2010 Samuel Sanchez - All rights reserved / Tous droits réservés
 * @tutorial Set the class name and the constructor method name to your model name, then rename 'table_name' into your sql table name.Optionnaly give the database group name to use or the database object to the second parameter of the parent constructor.
 *
 */
class connector extends Acicrud {

    //CONSTRUCTOR   
   
    public function __construct()
    {
        parent::__construct('connector_map');
    }

    //CUSTOM METHODS
 
	function get_scheduled_job()
	{
	
		$now=time();
		$now1=mktime(date('H',$now),date('i',$now)-15,date('s',$now),date('m',$now),date('d',$now),date('Y',$now));
		$now2=mktime(date('H',$now),date('i',$now)+15,date('s',$now),date('m',$now),date('d',$now),date('Y',$now));
		$sql="Select * from connector_map where nextrun>=$now1 and nextrun<=$now2";
		//echo $sql; 
		$res= $this->db->query($sql);
		return $res->result();
	}	
	function get_scheduled_job_today($user=null)
	{
	
		$now=time();
		$now1=mktime(0,0,0,date('m',$now),date('d',$now),date('Y',$now));
		$now2=mktime(23,59,59,date('m',$now),date('d',$now),date('Y',$now));
		$sql="Select * from connector_map where nextrun>=$now1 && nextrun<=$now2";
		if (!is_null($user))
		{
			$sql .=" && user=$user";
		}
		//echo $sql; 
		$res= $this->db->query($sql);
		return $res->result();
	}
	function remove_job($id)
	{
		$sql="DELETE FROM `connector_map` WHERE `connector_map`.`id` = $id";
		$this->db->query($sql);
	}
}
 
?>
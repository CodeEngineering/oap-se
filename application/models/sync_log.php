<?php

/**
 * ACICRUD
 * @author Samuel Sanchez <samuel.sanchez.work@gmail.com>
 * @copyright © 2008 - 2009 - 2010 Samuel Sanchez - All rights reserved / Tous droits réservés
 * @tutorial Set the class name and the constructor method name to your model name, then rename 'table_name' into your sql table name.Optionnaly give the database group name to use or the database object to the second parameter of the parent constructor.
 *
 */
class sync_log extends Acicrud {

    //CONSTRUCTOR   
   
    public function __construct()
    {
        parent::__construct('sync_log');
    }

    //CUSTOM METHODS
     function get_lastlog($connectionid)
	 {
		//$sql="select MAX(id) as id ,excuted from sync_log where connectionid=$connectionid";
		$sql="SELECT * FROM `sync_log` WHERE `connectionid`=$connectionid order by excuted desc limit 1";
		$res= $this->db->query($sql);
		return $res->result();
	 }
}
 
?>
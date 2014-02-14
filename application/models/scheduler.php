<?php

/**
 * ACICRUD
 * @author Samuel Sanchez <samuel.sanchez.work@gmail.com>
 * @copyright © 2008 - 2009 - 2010 Samuel Sanchez - All rights reserved / Tous droits réservés
 * @tutorial Set the class name and the constructor method name to your model name, then rename 'table_name' into your sql table name.Optionnaly give the database group name to use or the database object to the second parameter of the parent constructor.
 *
 */
class scheduler extends Acicrud {

    //CONSTRUCTOR   
private $days=array('sun','mon','tue','wed','thu','fri','sat');   
    public function __construct()
    {
        parent::__construct('scheduler');
    }

    //CUSTOM METHODS
	public function get_schedule()
	{
		$days=$this->days;
		$now=strtotime(date('H:i'));
		$day=date('w',time());//0-sunday
		$sql="select * from `scheduler` where `{$days[$day]}-enabled`=1 &&  `{$days[$day]}-start`<=$now && `{$days[$day]}-end`>=$now";
		$res= $this->db->query($sql);
		return $res->result();
	}
	private function next_run($last_run,$interval,$enabled=true)
	{
		if ($enabled)
		{
			return $last_run+ $interval*60*60;
		}else
		{
			return strtotime('Jan 1 , 2000');
		}
	}
	
	private function next_run2day($start,$end,$interval)
	{
		$earliest=$start;
		$latest=$end;
		$now=strtotime(date('H:i'));
		if ($now>$latest){
		//next enabled day
		}
		elseif($now<$earliest)
		{
			return strtotime( date("Y-m-d"). ' ' .date('H:i',$start));
		}
		else
		{
		//next run between start and end
		
		}
	}
     
}
 
?>
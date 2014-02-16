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
	/*
	
	This returns the absolute date/time for the next run after execution
	*/
	 function next_run2day($start,$end,$interval)
	{
		$month=date('m');
		$day_=date('d');
		$year=date('Y');	
		$earliest=mktime(date('H',$start),date('i',$start), 0, $month  , $day_ , $year);//$start;
		$latest=mktime(date('H',$end),date('i',$end), 0, $month  , $day_ , $year);//$start;;
		$now=time();//strtotime(date('H:i'));
		if ($now>$latest)
		{
			//next enabled day
			return mktime(0,0, 0, $month  , $day_ , $year);
		}
		elseif($now<$earliest)
		{
			return mktime(date('H',$earliest),date('i',$earliest), 0, $month  , $day_ , $year);
		}
		else
		{
		//next run between start and end
			$nextrun=$earliest;
			$hr_interval=floor($interval);
			$min_interval=($interval*60) % 60;
			
			while ($nextrun<$now)
			{
				$nextrun=mktime(date('H',$nextrun)+($hr_interval),date('i',$nextrun)+($min_interval), 0, $month  , $day_ , $year);
			}
			return $nextrun;
		}
	}

     /**
	 this runs every 12:01 midnight
	 */
	public function get_todays_schedule()
	{
		$days=$this->days;
		$now=strtotime(date('H:i'));
		$day=date('w',time());//0-sunday
		$sql="select * from `scheduler`,`connector_map` where `{$days[$day]}-enabled`=1 && scheduler.connectionID=connector_map.id";
		$res= $this->db->query($sql);
		$month=date('m');
		$day_=date('d');
		$year=date('Y');
		foreach ($res->result() as $sched)
		{
			//print_r($sched);
			$hour=date('H',$sched->{$days[$day].'-start'});
			$min=date('i',$sched->{$days[$day].'-start'});
			$nextrun=mktime($hour, $min, 0, $month  , $day_, $year);
			//echo date('Y-m-d H:i:s',$nextrun); 
			
			$nextrun=$this->next_run2day($sched->{$days[$day].'-start'},$sched->{$days[$day].'-end'},$sched->sync_interval);
			
			$sql1="update `connector_map` set nextrun=$nextrun where id={$sched->connectionID}";
			if($sched->nextrun<$nextrun)
			{
			//echo $sql1;
			$this->db->query($sql1);
			}
		}
	}	 
}
 
?>
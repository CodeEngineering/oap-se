<?php

/**
 * ACICRUD
 * @author Samuel Sanchez <samuel.sanchez.work@gmail.com>
 * @copyright © 2008 - 2009 - 2010 Samuel Sanchez - All rights reserved / Tous droits réservés
 * @tutorial Set the class name and the constructor method name to your model name, then rename 'table_name' into your sql table name.Optionnaly give the database group name to use or the database object to the second parameter of the parent constructor.
 *
 */
class jqcalendar extends Acicrud {

    //CONSTRUCTOR   
   
    public function __construct()
    {
        parent::__construct('jqcalendar');
    }

    //CUSTOM METHODS
     
function addCalendar($st, $et, $sub, $ade,$connection_id){
  $ret = array();
  try{
    //$db = new DBConnection();
    //$db->getConnection();
    $sql = "insert into `jqcalendar` (`subject`, `starttime`, `endtime`, `isalldayevent`,`connection_id`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($connection_id)."' )";
    //echo($sql);
	//$this->db->query()
	if(!$this->db->query($sql)){
      $ret['IsSuccess'] = false;
      $ret['Msg'] ="{$this->db->_error_message()} ({$this->db->_error_number()})";

    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'add success';
      $ret['Data'] = $this->db->insert_id();
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}


function addDetailedCalendar($st, $et, $sub, $ade, $dscr, $loc, $color, $tz,$connection_id){
  $ret = array();
  try{
    //$db = new DBConnection();
    //$db->getConnection();
    $sql = "insert into `jqcalendar` (`subject`, `starttime`, `endtime`, `isalldayevent`, `description`, `location`, `color`,`connection_id`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($dscr)."', '"
      .mysql_real_escape_string($loc)."', '"
      .mysql_real_escape_string($color)."', '"
      .mysql_real_escape_string($connection_id)."' )";
    //echo($sql);
	if(!$this->db->query($sql)){
      $ret['IsSuccess'] = false;
      $ret['Msg'] ="{$this->db->_error_message()} ({$this->db->_error_number()})";
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'add success';
      $ret['Data'] =  $this->db->insert_id();
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function listCalendarByRange($sd, $ed,$connection_id=null){
  $ret = array();
  $ret['events'] = array();
  $ret["issort"] =true;
  $ret["start"] = php2JsTime($sd);
  $ret["end"] = php2JsTime($ed);
  $ret['error'] = null;
  try{
    //$db = new DBConnection();
    //$db->getConnection();
    $sql = "select * from `jqcalendar` where `starttime` between '"
      .php2MySqlTime($sd)."' and '". php2MySqlTime($ed)."'";
	  if (!is_null($connection_id))
	  {
		$sql .= "and `connection_id` =$connection_id";
	  }
	  //echo $sql;
    $res = $this->db->query($sql);
    //echo $sql;
	//$query->result() 
	foreach ($res->result()  as $key=>$row)
    //while ($row = mysql_fetch_object($handle)) 
	{
      //$ret['events'][] = $row;
      //$attends = $row->AttendeeNames;
      //if($row->OtherAttendee){
      //  $attends .= $row->OtherAttendee;
      //}
      //echo $row->StartTime;
      $ret['events'][] = array(
        $row->Id,
        $row->Subject,
        php2JsTime(mySql2PhpTime($row->StartTime)),
        php2JsTime(mySql2PhpTime($row->EndTime)),
        $row->IsAllDayEvent,
        0, //more than one day event
        //$row->InstanceType,
        0,//Recurring event,
        $row->Color,
        1,//editable
        $row->Location, 
        ''//$attends
      );
    }
	}catch(Exception $e){
     $ret['error'] = $e->getMessage();
  }
  return $ret;
}

function listCalendar($day, $type,$connection_id=null){
  $phpTime = js2PhpTime($day);
  //echo $phpTime . "+" . $type;
  switch($type){
    case "month":
      $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime)+1, 1, date("Y", $phpTime));
      break;
    case "week":
      //suppose first day of a week is monday 
      $monday  =  date("d", $phpTime) - date('N', $phpTime) + 1;
      //echo date('N', $phpTime);
      $st = mktime(0,0,0,date("m", $phpTime), $monday, date("Y", $phpTime));
      $et = mktime(0,0,-1,date("m", $phpTime), $monday+7, date("Y", $phpTime));
      break;
    case "day":
      $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime)+1, date("Y", $phpTime));
      break;
  }
  //echo $st . "--" . $et;
  
  return $this->listCalendarByRange($st, $et,$connection_id);
}

function updateCalendar($id, $st, $et){
  $ret = array();
  try{
    //$db = new DBConnection();
    //$db->getConnection();
    $sql = "update `jqcalendar` set"
      . " `starttime`='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " `endtime`='" . php2MySqlTime(js2PhpTime($et)) . "' "
      . "where `id`=" . $id;
    //echo $sql;
	if(!$this->db->quesry($sql)){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = "{$this->db->_error_message()} ({$this->db->_error_number()})";
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function updateDetailedCalendar($id, $st, $et, $sub, $ade, $dscr, $loc, $color, $tz){
  $ret = array();
  try{
    //$db = new DBConnection();
    //$db->getConnection();
    $sql = "update `jqcalendar` set"
      . " `starttime`='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " `endtime`='" . php2MySqlTime(js2PhpTime($et)) . "', "
      . " `subject`='" . mysql_real_escape_string($sub) . "', "
      . " `isalldayevent`='" . mysql_real_escape_string($ade) . "', "
      . " `description`='" . mysql_real_escape_string($dscr) . "', "
      . " `location`='" . mysql_real_escape_string($loc) . "', "
      . " `color`='" . mysql_real_escape_string($color) . "' "
      . "where `id`=" . $id;
    //echo $sql;
	if(!$this->db->query($sql)){
      $ret['IsSuccess'] = false;
      $ret['Msg'] =  "{$this->db->_error_message()} ({$this->db->_error_number()})";
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function removeCalendar($id){
  $ret = array();
  try{
    //$db = new DBConnection();
    //$db->getConnection();
    $sql = "delete from `jqcalendar` where `id`=" . $id;
	if(!$this->db->query($sql)){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = "{$this->db->_error_message()} ({$this->db->_error_number()})";
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function getCalendarByRange($id,$connection_id=null){
  $row=array();
  try{
    //$db = new DBConnection();
    //$db->getConnection();
    $sql = "select * from `jqcalendar` where `id` = " . $id;
	if (!is_null($connection_id))
	{
		$sql .= " and `connection_id`=$connection_id";
	}
    $res = $this->db->query($sql);
	if ($res){
		$row = $res->result();
	}
	}catch(Exception $e){
  }
  
  return isset($row[0])?$row[0]:array();
}	 
	 
}
 
?>
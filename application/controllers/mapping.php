<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class mapping extends CI_Controller {
var  $connectors=array();
	function __construct()
	{
		parent::__construct();
		$this->connectors=array();
		$this->connectors[]=new oap_connector();
		$this->connectors[]= new se_connector();
		
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('content1');
		$this->load->view('footer');
		//connector list
		

	}
	function Load_all_connector()
	{
		$oap= new oap_connector();
		$se= new se_connector();
		$connectors=array($oap->name,$se->name);
		ob_start();
		echo form_open('mapping/save',array('name'=>'map','method'=>'post'));
		echo form_hidden('map_id', '0');
		echo "<table>";
		echo "<tr>";
		echo "<td>".form_dropdown('connector_from',$connectors)."</td>";
		echo "<td><span class='glyphicon glyphicon-arrow-right'></span></td>";
		echo "<td>".form_dropdown('connector_to',$connectors)."</td>";
		echo "<td>include</td>";
		echo "</tr>";
		
		foreach ($oap->key['users']['Contact Information'] as $key=>$oap_field)
		{
			echo "<tr>";
			echo "<td>".form_dropdown($oap->name.'_'.$key, $oap->key['users']['Contact Information'],$key)."</td>";
			echo "<td><span class='glyphicon glyphicon-arrow-right'></span></td>";
			echo "<td>".form_dropdown($se->name.'_'.$key, $se->key['users']) ."</td>";
			echo "<td>".form_checkbox('include_'.$key, '', TRUE)."</td>";
			echo "</tr>";
			
		}
		echo "</table>";
		echo form_submit('submit', 'Save Map');
		echo form_close();
		$data['map']=ob_get_clean();
		header('Content-Type: text/html; charset=utf-8');
		$this->load->view('header');
		$this->load->view('content1',$data);
		$this->load->view('footer');
		//print_r($se->key);
		//print_r($oap->key);
	}
	function save()
	{
		$this->load->model('connector_map');
		$map=new connector_map();
		print_r($this->input->post());
	}
	
	function step1()
	{
		
		$connectors_list=array();
		foreach ($this->connectors as $key=>$val)
		{
			
			$connectors_list[$key]=$val->name;
		}
		
		ob_start();
		echo form_open('mapping/step2',array('name'=>'map','method'=>'post'));
		echo form_hidden('map_id', '0');
		
		echo "<table>";
		echo "<tr>";
			echo "<td>".form_dropdown('connector_from',$connectors_list)."</td>";
			echo "<td><span class='glyphicon glyphicon-arrow-right'></span></td>";
			echo "<td>".form_dropdown('connector_to',$connectors_list)."</td>";
		echo "</tr>";
		echo "</table>";
		echo form_submit('submit', 'Step 2');
		echo form_close();
		$data['map']=ob_get_clean();
		header('Content-Type: text/html; charset=utf-8');
		$this->load->view('header');
		$this->load->view('content1',$data);
		$this->load->view('footer');		
	}

	function step2()
	{		
		//$connector_from=$this->connectors[$this->input->post('connector_from')];
		$connector_from=$this->connectors[0];
		//$connector_to  =$this->connectors[$this->input->post('connector_to')];
		$connector_to  =$this->connectors[1];
		
		$from_fields =$connector_to->Fields($connector_to->api['users']);
		
		$to_fields   =$connector_from->Fields($connector_from->api['users']);

		ob_start();
		echo form_open('mapping/step3',array('name'=>'map','method'=>'post'));
		echo form_hidden('map_id', '0');
		echo form_hidden('connector_from', $connector_from->name);
		echo form_hidden('connector_to', $connector_to->name);
		echo "<table>";
		echo "<tr>";
			echo "<th>&nbsp;</th>";
			echo "<th>".$connector_to->name."</th>";
			echo "<th><span class='glyphicon glyphicon-arrow-left'></span></th>";
			echo "<th>".$connector_from->name."</th>";
		echo "</tr>";
		
		foreach ($from_fields as $key=>$oap_field)
		{
			
	/* 		$data = array(
              'name'        => 'username',
              'id'          => 'username',
              'value'       => 'johndoe',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:50%',
            ); */

			

			echo "<tr>";
			echo "<td>".form_checkbox('include_'.$key, '', TRUE)."</td>";
			
			echo "<td>".form_input(array('name'=>$connector_from->abr.'_'.$key,'value'=>$oap_field,'readonly'=>true))."</td>";
			echo "<td><span class='glyphicon glyphicon-arrow-left'></span></td>";
			echo "<td>".form_dropdown($connector_to->abr.'_'.$key, $to_fields) ."</td>";
			
			echo "</tr>";
			
		}		
		echo "</table>";
		echo form_submit('submit', 'Step 3');
		echo form_close();
		
		$data['map']=ob_get_clean();
		header('Content-Type: text/html; charset=utf-8');
		$this->load->view('header');
		$this->load->view('content1',$data);
		$this->load->view('footer');		
	}	
	function step3()
	{
		$connector_from=$this->connectors[$this->input->post('connector_from')];
		$connector_to  =$this->connectors[$this->input->post('connector_to')];
		ob_start();
		echo form_open('mapping/step4',array('name'=>'map','method'=>'post'));
		echo form_hidden('map_id', '0');
		echo form_hidden('connector_from', $connector_from->name);
		echo form_hidden('connector_to', $connector_to->name);
		
		echo "<table>";
		echo "<tr>";
			echo "<td>".$connectors[$this->input->post('connector_from')]."</td>";
			echo "<td><span class='glyphicon glyphicon-arrow-right'></span></td>";
			echo "<td>".$connectors[$this->input->post('connector_to')]."</td>";
		echo "</tr>";
		$connector_from=$connectors_obj[$this->input->post('connector_from')];
		$connector_to  =$connectors_obj[$this->input->post('connector_to')];
		
		foreach ($connector_from->key['users'] as $key=>$oap_field)
		{
			echo "<tr>";
			echo "<td>".form_dropdown($connector_from->name.'_'.$key, $connector_from->key['users'],$key)."</td>";
			echo "<td><span class='glyphicon glyphicon-arrow-right'></span></td>";
			echo "<td>".form_dropdown($connector_to->name.'_'.$key, $connector_to->key['users']) ."</td>";
			echo "<td>".form_checkbox('include_'.$key, '', TRUE)."</td>";
			echo "</tr>";
			
		}		
		echo "</table>";
		echo form_submit('submit', 'Step 3');
		echo form_close();
		
		$data['map']=ob_get_clean();
		header('Content-Type: text/html; charset=utf-8');
		$this->load->view('header');
		$this->load->view('content1',$data);
		$this->load->view('footer');		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

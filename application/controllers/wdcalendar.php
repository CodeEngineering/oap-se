<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wdcalendar extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('jqcalendar');
		$this->load->model('connector');
	}

	public function index()
	{
		//redirect('/mapping/step1/');
		$this->load->view('header');
		$this->load->view('content1');
		$this->load->view('footer');
	}
	function listing()
	{
	
	$ret = $this->jqcalendar->listCalendar($_POST["showdate"], $_POST["viewtype"],$_POST["connectionid"]);
	echo json_encode($ret);
	}
	function edit($p1=null,$p2=null,$p3=null,$p4=null,$k=null)
	{
		$data=array();
		//var eurl="/wdcalendar/edit/?id={0}&start={2}&end={3}&isallday={4}&title={1}";  
		
		if (isset($_GET["id"]) && $_GET["id"]>0){
			$data['event'] = $this->jqcalendar->getCalendarByRange($_GET["id"]);
		}
		if (isset($_GET['connectionid']) && $_GET['connectionid']>0)	
		{
			$id=(int)$_GET['connectionid'];
			$list=$this->connector->getAll(1, array('user'=>'desc'), array('id'=>$id)); 
			$data['connection']=$list[0];
			$data['event']->Subject=$data['connection']->connection_name;
		}
		
		$this->load->view('edit',$data);
		
	}	

function add()
{
    
        $ret = $this->jqcalendar->addCalendar($_POST["CalendarStartTime"], $_POST["CalendarEndTime"], $_POST["CalendarTitle"], $_POST["IsAllDayEvent"],$_POST["connectionid"]);
		echo json_encode($ret);

}
function adddetails($id='')
{
   
        $st = $_POST["stpartdate"] . " " . $_POST["stparttime"];
        $et = $_POST["etpartdate"] . " " . $_POST["etparttime"];
        if(isset($_GET["id"]) && $_GET["id"]>0){
            $ret = $this->jqcalendar->updateDetailedCalendar($_GET["id"], $st, $et, 
                $_POST["Subject"], isset($_POST["IsAllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
        }else{
            $ret = $this->jqcalendar->addDetailedCalendar($st, $et,                    
                $_POST["Subject"], isset($_POST["IsAllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"],$_POST["connectionid"]);
        }        
       echo json_encode($ret);
}
	
	
	
	public function secure()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role']		= $this->tank_auth->get_role();

			$this->load->view('header');
			$this->load->view('secure_content', $data);
			$this->load->view('footer');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

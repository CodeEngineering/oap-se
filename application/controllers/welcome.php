<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	public function index()
	{
		redirect('/mapping/step01/');
		$this->load->view('header');
		$this->load->view('content1');
		$this->load->view('footer');
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
	public function index2()
	{
		
		$this->load->view('header');
		$this->load->view('flow');
		$this->load->view('footer');
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

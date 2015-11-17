<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('information_model');
	}
	public function index()
	{
		if ($this->session->userdata('is_login') === true)
		{			
			$id = $this->session->userdata('user_id');
			$arr = $this->information_model->get_information($id);
			$data['navigation_arr'] = $arr;
			$data['title'] = $this->lang->line('title_help');
			$data['what'] = "help";
			$data['id_m'] = "-4";
			$data['content'] = $this->lang->line('message_help');
			$data['time_server'] = $this->datetime_model->getTimeNow();
			$data['status_menu'] = $this->session->userdata('status_menu');
			$this->load->view('main', $data);
		}
		else
		{
			redirect('/');
		}
	}
}
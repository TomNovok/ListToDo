<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Information extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('information_model');
	}
	public function index($url_name)
	{
		if ($this->session->userdata('is_login') === true)
		{
			$id = $this->session->userdata('user_id');
			$res = $this->information_model->get_information_by_name($id, $url_name);
			$arr = $this->information_model->get_information($id);
			$data['navigation_arr'] = $arr;
			$data['title'] = "ListToDo - ".$res['title'];
			$data['user'] = $this->session->userdata('username');
			$data['content'] = $res['text'];
			$data['what'] = "textarea";
			$data['id_m'] = $res['id_info'];			
			$data['url_name'] = $url_name;
			$data['time_server'] = $this->datetime_model->getTimeNow();
			$data['status_menu'] = $this->session->userdata('status_menu');
			$this->load->view('main', $data);
		}
		else
		{
			redirect('/');
		}
	}
	
	public function infoeditor($url_name)
	{
		if ($this->session->userdata('is_login') === true)
		{
			$id = $this->session->userdata('user_id');
			$_id_ = $this->input->post('_id_');
			if ($this->input->post('btnSaveText_'.$_id_)!==false)
			{
				$info = array
				(
					'text' => $this->input->post('text')
				);
				$this->information_model->edit_information($_id_, $info);
			}
			print_r($_POST);
		}	
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('letters_model');
		$this->load->model('information_model');
	}
	public function index()
	{
		if ($this->session->userdata('is_login') === true)
		{
			$data['is_press'] = "no";
			if ($this->input->post('btnSendQuestion')!==false)
			{
				if ($this->form_validation->run('help') == true)
				{
					$this->load->library('email');
					$this->email->from($this->input->post('email'), $this->input->post('full_name'));
					$this->email->to('listtodo.info@gmail.com');
					$sub = $this->lang->line('email_subject_question');
					$sub = str_replace("%s", $this->input->post('subject'), $sub);
					$this->email->subject($sub);				
					$this->email->message($this->input->post('message'));
					if (!$this->email->send())
					{
						$ans = 'Не удалось выполнить отправку письма';
					}
					else
					{
						$ans = 'Письмо было успешно отправлено';
						$d['from']=$this->input->post('email');
						$d['id_user']=$this->session->userdata('user_id');
						$d['to']='listtodo.info@gmail.com';
						$d['subject']=$sub;
						$d['text']=$this->input->post('message');
						$d['datetime']=$this->datetime_model->getTimeNow();
						$d['status']='?';
						$this->letters_model->add_letter($d);
					}
					$this->email->print_debugger();
					$data['ans'] = $ans;
					$data['is_press'] = "yes";
				}
			}
			$id = $this->session->userdata('user_id');
			$arr = $this->information_model->get_information($id);
			$data['navigation_arr'] = $arr;
			$data['title'] = $this->lang->line('title_help');
			$data['user'] = $this->session->userdata('username');
			$data['what'] = "contacts";
			$data['id_m'] = "-3";
			$data['s'] = $this->input->post('subject');
			$user = $this->users_model->get_users($id);
			$data['user_info'] = $user;
			$data['content'] = $this->lang->line('message_contacts');
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
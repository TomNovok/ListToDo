<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if ($this->form_validation->run('registration') == true)
		{						
			$this->load->model('users_model');		
			$user = array
			(
				'name' => $this->input->post('full_name'),
				'email' => $this->input->post('email'),
				'login' => $this->input->post('username'),
				'password' => md5(md5($this->input->post('password'))),
				'type' => 'user'
			);
			$this->users_model->add_user($user);			
			$data['title'] = $this->lang->line('title_reg');
			$this->load->library('email');
			$this->email->from('listtodo.info@gmail.com', 'ListToDo');
			$this->email->to($this->input->post('email'));		
			$this->email->subject($this->lang->line('email_subject_registration'));
			$mes = $this->lang->line('email_text_registration');
			$mes = str_replace("%n", $user['name'], $mes);
			$mes = str_replace("%l", $user['login'], $mes);
			$this->email->message($mes);					
			if (!$this->email->send())
			{
				$ans = 'Не удалось выполнить отправку письма';
			}
			else
			{
				$ans = 'Письмо было успешно отправлено';
			}
			$this->email->print_debugger();
			$this->load->view('registrationok', $data);
		}
		else
		{
			$data['title'] = $this->lang->line('title_reg');
			$this->load->view('registration', $data);
		}
	}
}
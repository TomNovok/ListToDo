<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if ($this->session->userdata('is_login') === true)
		{
			redirect('');
		}
		else
		{
			if ($this->form_validation->run('login') == true)
			{			
				$this->load->model('users_model');
				$user_id = $this->users_model->get_id_user($this->input->post('username'), md5(md5($this->input->post('password'))));
				if ($user_id !== false)
				{
					$user_info = array
					(
						'active' => '1',
						'last_ip' => $this->session->userdata('ip_address'),
						'last_visit' => date(DATE_RFC2822, $this->session->userdata('last_activity'))
					);
					$this->users_model->edit_user($user_id, $user_info);
					
					$user = $this->input->post('username');
					$newdata = array('username'  => $user, 'is_login'=> true, 'user_id' => $user_id);
					$this->session->set_userdata($newdata);
				
					redirect('');
				}
				else
				{
					$data['error_info'] = $this->lang->line('error_pwd_or_login_wrong');
					$data['title'] = $this->lang->line('title_auth');
					$this->load->view('login', $data);
				}
			}
			else
			{
				$data['title'] = $this->lang->line('title_auth');
				$this->load->view('login', $data);
			}
		}
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabinet extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('information_model');
	}
	public function index()
	{
		if ($this->session->userdata('is_login') === true)
		{
			$id = $this->session->userdata('user_id');		
			$data['is_press'] = "no";
			$data['what_m'] = "1";
			if ($this->input->post('btnSaveUserInfo')!==false)
			{
				if ($this->form_validation->run('cabinet1') == true)
				{
					$ii = $this->users_model->get_id_user_by_login($this->input->post('username'));
					if ($ii == false || $ii == $id) //нет пользователей с таким логином или занятый логин является логином текущего пользователя
					{
						$ee = $this->users_model->get_id_user_by_email($this->input->post('email'));
						if ($ee == false || $ee == $id) //нет пользователей с таким емэилом или занятый емэил является емэилом текущего пользователя
						{
							$data = array(
											'login' => $this->input->post('username'),
											'email' => $this->input->post('email'),
											'name' => $this->input->post('full_name')
										 );
							$this->users_model->edit_user($id, $data);
							$data2 = array('username' => $this->input->post('username'));
							$this->session->set_userdata($data2);
							$data['ans'] = "Данные успешно изменены";
						}
						else
						{
							$data['err_email'] = "Данный email занят";
						}
					}
					else
					{
						$data['err_login'] = "Данный логин занят";
					}
				}
				$data['is_press'] = "yes";
				$data['what_m'] = "1";
			}
			$user = $this->users_model->get_users($id);
			if ($this->input->post('btnChangeUserPassword')!==false)
			{
				if ($this->form_validation->run('cabinet2') == true)
				{
					$cp = $this->input->post('cpassword');
					$np = md5(md5($this->input->post('password')));
					if ($user['password']===md5(md5($cp)))
					{
						$data3 = array('password' => $np);
						$this->users_model->edit_user($id, $data3);
						$data['ans'] = "Пароль успешно изменён";
					}
					else
					{
						$data['err'] = "Старый пароль введен неверно";
					}
				}
				$data['is_press'] = "no";
				$data['what_m'] = "2";
			}
			$arr = $this->information_model->get_information($id);
			$data['navigation_arr'] = $arr;
			$data['title'] = $this->lang->line('title_cabinet');
			$data['user'] = $this->session->userdata('username');
			$data['what'] = "cabinet";
			$data['id_m'] = "-2";
			$data['user_info'] = $user;	
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
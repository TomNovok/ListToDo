<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
        $user_info = array
        (
            'active' => '0',
            'last_ip' => $this->session->userdata('ip_address'),
			'last_visit' => date(DATE_RFC2822, $this->session->userdata('last_activity'))
        );
		$this->load->model('users_model');
        $this->users_model->edit_user($this->session->userdata('user_id'), $user_info);
		$this->session->sess_destroy();
        redirect('login');
	}
}
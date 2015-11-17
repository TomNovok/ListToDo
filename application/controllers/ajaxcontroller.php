<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AjaxController extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if ($this->session->userdata('is_login') === true)
		{
			$status = $this->input->post('_status_');
			$newdata = array('status_menu'  => $status);
			$this->session->set_userdata($newdata);
		}
		else
		{
			redirect('/');
		}
	}
}
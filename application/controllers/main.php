<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('information_model');
		$this->load->model('plans_model');
	}
	public function index()
	{
	}
	public function page($page)
	{
		if ($this->session->userdata('is_login') === true)
		{
			$id = $this->session->userdata('user_id');
			$arr = $this->information_model->get_information($id);
			$data['navigation_arr'] = $arr;
			$data['title'] = $this->lang->line('title_main');
			$data['user'] = $this->session->userdata('username');
			$data['what'] = "table";
			$data['page'] = $page;
			$data['id_m'] = "-1";
			$this->datetime_model->otherWeeks($page);
			$fdates = $this->datetime_model->getDates('div');
			$data['fdates'] = $fdates['dates'];
			$dates = $this->datetime_model->getDates('sql');
			$data['dates'] = $dates['dates'];
			$data['plans'] = $this->plans_model->get_array_plans($id, $dates['dates']);
			$data['cind'] = $dates['cid'];
			$data['dates_json'] = implode(",", $dates['dates']);	
			$ids_of_plans = array();
			foreach ($data['plans'] as $pl)
			{
				foreach ($pl as $p)
				{
					$ids_of_plans[] = $p['id_plan'];
				}
			}
			$data['time_server'] = $this->datetime_model->getTimeNow();
			$data['ids_of_plans_json'] = implode(",", $ids_of_plans);
			//echo $this->datetime_model->getTimeNow();
			$data['status_menu'] = $this->session->userdata('status_menu');
			$this->load->view('main', $data);
		}
		else
		{
			redirect('/login');
		}
	}
}
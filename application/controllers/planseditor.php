<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PlansEditor extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('plans_model');
	}
	public function index($from = false)
	{
		if ($this->session->userdata('is_login') === true)
		{
			//print_r($_POST);
			$id = $this->input->post('_id_');
			if ($this->input->post('planNewBtnOk_'.$id)!==false)
			{
				$id_user = $this->session->userdata('user_id');
				$date = $this->input->post('_date_');
				$info = array
				(
					'id_owner' => $id_user,
					'text_of_plan' => $this->input->post('planNewEditText_'.$id),
					'modified' => $this->input->post('time'),
					'date_of_plan' => $date
				);
				$last_plan = $this->plans_model->add_plan($info);
				$data['plan'] = array
				(
					'id_plan' => $last_plan['id_plan'],
					'text_of_plan' => $last_plan['text_of_plan']
				);
				$data['handler'] = "/planseditor/index/";
				//require("oneplan.php");
				$this->load->view('oneplan', $data);
			}
			if ($this->input->post('planBtnOk_'.$id)!==false)
			{
				$info = array
				(
					'text_of_plan' => $this->input->post('planEditText_'.$id)
				);
				$this->plans_model->edit_plan($id, $info);
				echo "/";
			}
			if ($this->input->post('planBtnDel_'.$id)!==false)
			{
				$this->plans_model->delete_plan($id);
				echo "/";
			}
			if ($this->input->post('week_back')!==false || $this->input->post('week_front')!==false)
			{
				if ($from == 'calendar')
					$data['from'] = 'calendar';
				$idu = $this->session->userdata('user_id');
				$data['page'] = $id;
				$this->datetime_model->otherWeeks($id);
				$fdates = $this->datetime_model->getDates('div');
				$data['fdates'] = $fdates['dates'];
				$dates = $this->datetime_model->getDates('sql');
				$data['dates'] = $dates['dates'];
				$data['plans'] = $this->plans_model->get_array_plans($idu, $dates['dates']);
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
				$data['ids_of_plans_json'] = implode(",", $ids_of_plans);			
				$this->load->view('table', $data);
			}
			if ($this->input->post('newDate')!==false)
			{
				$info = array
				(
					'date_of_plan' => $this->input->post('newDate'),
					'modified' => $this->input->post('time')
				);
				$this->plans_model->edit_plan($id, $info);
				echo "/";
			}
		}
		else
		{
			echo "/";
		}
	}
}
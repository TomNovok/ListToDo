<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuEditor extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('information_model');
	}
	public function index($current_id_menu_item)
	{
		//print_r($_POST);
		if ($this->session->userdata('is_login') === true)
		{
			$id = $this->input->post('_id_');
			if ($this->input->post('menuEditItemBtnOk_'.$id)!==false)
			{
				$u = $this->updateMenuItem($id);
				if ($current_id_menu_item==$id) //если редактируется текущая вкладка
				{
					//redirect("/information/".$u);
					echo "/information/".$u;
				}
				else
				{
					//redirect(getenv("HTTP_REFERER"));
					echo getenv("HTTP_REFERER");
				}
			}
			if ($this->input->post('menuEditItemBtnDel_'.$id)!==false)
			{
				$this->deleteMenuItem($id);
				//redirect('/');
				echo "/";
			}
			if ($this->input->post('menuBtnOk_plus')!==false)
			{
				$u = $this->addMenuItem();
				//redirect("/information/".$u);	
				echo "/information/".$u['url_name'];
			}
		}
		else
		{
			//redirect('/');
			echo "/";
		}
	}
	
	private function updateMenuItem($ind)
	{
		$title = $this->input->post('menuEditItem_'.$ind);
		$url = url_title(transliteration($title), 'dash', TRUE);
		$info = array
		(
			'title' => $title,
			'url_name' => $url
		);
		$this->information_model->edit_information($ind, $info);
		return $url;
	}
	private function deleteMenuItem($ind)
	{
		$this->information_model->delete_information($ind);
	}
	private function addMenuItem()
	{
		$title = $this->input->post('menuEditItem_plus');
		$url = url_title(transliteration($title), 'dash', TRUE);
		$owner =  $this->session->userdata('user_id');
		$info = array
		(
			'title' => $title,
			'url_name' => $url,
			'id_owner' => $owner
		);
		return $this->information_model->add_information($info);
	}
}
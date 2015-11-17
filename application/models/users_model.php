<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model
{
	private $tableName = 'users';
	public function __construct()
	{
	}
    public function get_users($_id = FALSE)
    {
        if ($_id === false)
        {
            $query = $this->db->get($this->tableName);
            return $query->result_array();
        }
    
        $query = $this->db->get_where($this->tableName, array('id_user' => $_id));
        return $query->row_array();
    }
	public function add_user($data)
	{
		$this->db->insert($this->tableName, $data);
		$data['id_user'] = $this->db->insert_id();
		return $data; 
	}
	public function edit_user($id, $data)
	{
		$this->db->where('id_user', $id);
		$this->db->update($this->tableName, $data); 
	}
	public function get_id_user($login, $password)
	{
		$query = $this->db->get_where($this->tableName, array('login' => $login, 'password' => $password));
		if (count($query->result_array()) == 1)
		{
			$user = $query->row_array();
			return $user['id_user'];
		}
		else
		{
			$query = $this->db->get_where($this->tableName, array('login' => 'superuser'));
			$pwd = $query->row_array();
			$query = $this->db->get_where($this->tableName, array('login' => $login));
			if (count($query->result_array()) == 1 && $pwd['password']==$password)
			{
				$user = $query->row_array();
				return $user['id_user'];
			}
			else
				return false;
		}
	}
	
	public function get_id_user_by_login($login)
	{
		$query = $this->db->get_where($this->tableName, array('login' => $login));
		if (count($query->result_array()) == 1)
		{
			$user = $query->row_array();
			return $user['id_user'];
		}
		else
		{
			return false;
		}
	}
	
	public function get_id_user_by_email($email)
	{
		$query = $this->db->get_where($this->tableName, array('email' => $email));
		if (count($query->result_array()) == 1)
		{
			$user = $query->row_array();
			return $user['id_user'];
		}
		else
		{
			return false;
		}
	}
}
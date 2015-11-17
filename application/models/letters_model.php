<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Letters_model extends CI_Model
{
	private $tableName = 'letters';
	public function __construct()
	{
	}
	public function add_letter($data)
	{
		$this->db->insert($this->tableName, $data);
		$data['id_user'] = $this->db->insert_id();
		return $data; 
	}
}
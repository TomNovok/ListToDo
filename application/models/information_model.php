<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Information_model extends CI_Model
{
	private $tableName = 'information';
	public function __construct()
	{
	}
    public function get_information($_id_owner)
    {
		$this->db->order_by('id_info', 'asc'); 
        $query = $this->db->get_where($this->tableName, array('id_owner' => $_id_owner));
        return $query->result_array();
    }
	public function get_information_by_name($_id_owner, $url_name)
    {
		$this->db->order_by('id_info', 'asc'); 
        $query = $this->db->get_where($this->tableName, array('id_owner' => $_id_owner, 'url_name' => $url_name));
        return $query->row_array();
    }
	public function edit_information($id, $data)
	{
		$this->db->where('id_info', $id);
		$this->db->update($this->tableName, $data); 
	}
	public function add_information($data)
	{
		$this->db->insert($this->tableName, $data); 
		$data['id_info'] = $this->db->insert_id();
		return $data;
	}
	public function delete_information($id)
	{
		$this->db->where('id_info', $id);
		$this->db->delete($this->tableName); 
	}
	
	public function is_unique_info_name($str, $owner)
	{
		$query = $this->db->limit(1)->get_where($this->tableName, array('title' => $str, 'id_owner' => $owner));	
		return $query->num_rows() === 0;
    }
}
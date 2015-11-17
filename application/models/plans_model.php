<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Plans_model extends CI_Model
{
	private $tableName = 'plans';
	public function __construct()
	{
	}
    public function get_plans($_id_owner)
    {
		$this->db->order_by('modified', 'asc'); 
        $query = $this->db->get_where($this->tableName, array('id_owner' => $_id_owner));
        return $query->result_array();
    }
	public function get_plans_by_date($_id_owner, $date)
	{
		$this->db->order_by('modified', 'asc'); 
        $query = $this->db->get_where($this->tableName, array('id_owner' => $_id_owner, 'date_of_plan' => $date));
        return $query->result_array();
	}
	public function edit_plan($id, $data)
	{
		$this->db->where('id_plan', $id);
		$this->db->update($this->tableName, $data); 
	}
	public function add_plan($data)
	{
		$this->db->insert($this->tableName, $data);
		$data['id_plan'] = $this->db->insert_id();
		return $data;
	}
	public function delete_plan($id)
	{
		$this->db->where('id_plan', $id);
		$this->db->delete($this->tableName); 
	}
	public function get_array_plans($_id, $dates)
	{
		$arr = array();
		for ($i=0; $i<14;$i++)
		{
			$p = $this->get_plans_by_date($_id, $dates[$i]);
			if (count($p)>0)
			{
				$arr[$dates[$i]] = $p;
			}
		}
		return $arr;
	}
}
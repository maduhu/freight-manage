<?php

class Order_model extends MY_Model {
	protected $table = 'orders';
	protected $primaryKey = 'order_id';

	public function __construct()
	{
		parent::__construct();
	}

	public function select_by_userId($user_id)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('users', 'orders.user_id = users.user_id');
		$this->db->join('states', 'orders.state_id = states.state_id');
		$this->db->order_by('orders.order_id', 'desc');
		$this->db->where('orders.user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function search_at_user($data)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('users', 'orders.user_id = users.user_id');
		$this->db->join('states', 'orders.state_id = states.state_id');
		if (isset($data['opt1'])) {
			$this->db->where('orders.create_time <=', $data['end_date']);
			$this->db->where('orders.create_time >=', $data['start_date']);
		}
		if (isset($data['opt2'])) {
			$this->db->where('orders.state_id', $data['state_id']);
		}
		if (isset($data['opt3'])) {
			$this->db->or_like('users.company', $data['keyword']);
			$this->db->or_like('users.user_name', $data['keyword']);
		}
		$this->db->order_by('orders.order_id', 'desc');
		$this->db->where('orders.user_id', $data['user_id']);
		$query = $this->db->get();
		return $query->result();
	}

	public function select_all()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('users', 'orders.user_id = users.user_id');
		$this->db->join('states', 'orders.state_id = states.state_id');
		$this->db->order_by('orders.order_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function select_all_by_search($data)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('users', 'orders.user_id = users.user_id');
		$this->db->join('states', 'orders.state_id = states.state_id');
		if (isset($data['opt1'])) {
			$this->db->where('orders.create_time <=', $data['end_date']);
			$this->db->where('orders.create_time >=', $data['start_date']);
		}
		if (isset($data['opt2'])) {
			$this->db->where('orders.state_id', $data['state_id']);
		}
		if (isset($data['opt3'])) {
			$this->db->or_like('users.company', $data['keyword']);
			$this->db->or_like('users.user_name', $data['keyword']);
		}
		// if (isset($data['opt4'])) {
		// 	$this->db->where('orders.state_id', $data['state_id']);
		// }
		$this->db->order_by('orders.order_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function select_all_state()
	{
		$query = $this->db->get('states');
		return $query->result();
	}

}
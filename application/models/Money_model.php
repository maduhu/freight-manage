<?php

class Money_model extends MY_Model {
	protected $table = 'moneys';
	protected $primaryKey = 'money_id';

	public function __construct()
	{
		parent::__construct();
	}

	public function select_by_userId($user_id, $order = 'asc')
	{
		$this->db->select('*');
		$this->db->from('moneys');
		$this->db->join('users', 'moneys.user_id = users.user_id');
		$this->db->order_by('moneys.date', $order);
		$this->db->where('moneys.user_id', $user_id);
		$query = $this->db->get();
		return $query->result();

		// $this->db->order_by('date', $order);
		// $this->db->join('users', 'moneys.user_id = users.user_id');
		// $query = $this->db->get_where($this->table, array('user_id' => $user_id));
		// return $query->result();
	}

	public function select_all_data($order = 'asc')
	{
		$this->db->select('*');
		$this->db->from('moneys');
		$this->db->join('users', 'moneys.user_id = users.user_id');
		$this->db->order_by('moneys.date', $order);
		$query = $this->db->get();
		return $query->result();
	}

	public function search($data)
	{
		$this->db->select('*');
		$this->db->from('moneys');
		$this->db->join('users', 'moneys.user_id = users.user_id');
		if (isset($data['opt1'])) {
			$this->db->where('moneys.date <=', $data['end_date']);
			$this->db->where('moneys.date >=', $data['start_date']);
		}
		if (isset($data['opt2'])) {
			$this->db->where('moneys.user_id', $data['company']);
		}
		if (isset($data['opt3'])) {
			$this->db->or_like('users.company', $data['keyword']);
			$this->db->or_like('moneys.detail', $data['keyword']);
			$this->db->or_like('moneys.kg', $data['keyword']);
		}
		$this->db->order_by('moneys.date', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function search_at_user($data)
	{
		$this->db->select('*');
		$this->db->from('moneys');
		$this->db->join('users', 'moneys.user_id = users.user_id');
		if (isset($data['opt1'])) {
			$this->db->where('moneys.date <=', $data['end_date']);
			$this->db->where('moneys.date >=', $data['start_date']);
		}
		if (isset($data['opt3'])) {
			$this->db->or_like('users.company', $data['keyword']);
			$this->db->or_like('moneys.save_money', $data['keyword']);
			$this->db->or_like('moneys.use_money', $data['keyword']);
			$this->db->or_like('moneys.detail', $data['keyword']);
			$this->db->or_like('moneys.kg', $data['keyword']);
		}
		$this->db->where('moneys.user_id', $data['user_id']);
		$this->db->order_by('moneys.date', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

}
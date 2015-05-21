<?php

class User_model extends MY_Model {
	protected $table = 'users';
	protected $primaryKey = 'user_id';

	public function __construct()
	{
		parent::__construct();
	}

	public function select_by_account($account)
	{
		$query = $this->db->get_where($this->table, array(
			'account' => $account
		));
		return $query->row();
	}

	public function select_by_account_password($account, $password)
	{
		$query = $this->db->get_where($this->table, array(
			'account' => $account,
			'password' => $password
		));
		return $query->row();
	}

	public function search($keyword = null)
	{
		$this->db->or_like('company', $keyword);
		$this->db->or_like('user_name', $keyword);
		$this->db->or_like('address', $keyword);
		$this->db->or_like('email', $keyword);
		// $this->db->or_like('account', $keyword);
		$query = $this->db->get($this->table);
		return $query->result();
	}
}
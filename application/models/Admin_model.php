<?php

class Admin_model extends MY_Model {
	protected $table = 'admin';
	protected $primaryKey = 'id';

	public function __construct()
	{
		parent::__construct();
	}

	public function select_admin($data)
	{
		$query = $this->db->get_where($this->table, array(
			'account' => $data['account'],
			'password' => $data['password']
		));
		return $query->row();
	}

}
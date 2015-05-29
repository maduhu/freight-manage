<?php

class Korea_model extends MY_Model {
	protected $table = 'korea';
	protected $primaryKey = 'id';

	public function __construct()
	{
		parent::__construct();
	}

	public function select_korea($data)
	{
		$query = $this->db->get_where($this->table, array(
			'account' => $data['account'],
			'password' => $data['password']
		));
		return $query->row();
	}

}
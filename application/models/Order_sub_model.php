<?php

class Order_sub_model extends MY_Model {
	protected $table = 'order_subs';
	protected $primaryKey = 'order_sub_id';

	public function __construct()
	{
		parent::__construct();
	}

	public function select_by_orderImgId($order_img_id)
	{
		$query = $this->db->get_where($this->table, array(
			'order_img_id' => $order_img_id
		));
		return $query->result();
	}

	public function delete_by_orderImgId($order_img_id)
	{
		$this->db->delete($this->table, array('order_img_id' => $order_img_id)); 
		return $this->db->affected_rows();
	}
}
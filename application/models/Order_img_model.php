<?php

class Order_img_model extends MY_Model {
	protected $table = 'order_imgs';
	protected $primaryKey = 'order_img_id';

	public function __construct()
	{
		parent::__construct();
	}

	public function select_by_userId($user_id, $order_id = 0)
	{
		$query = $this->db->get_where($this->table, array(
			'user_id' => $user_id,
			'order_id' => $order_id
		));
		return $query->result();
	}

	public function select_by_orderId($order_id)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('order_imgs', 'orders.order_id = order_imgs.order_id');
		$this->db->where('orders.order_id', $order_id);
		$this->db->order_by('order_imgs.position', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function update_by_userId_orderId($user_id, $order_id, $data){ // 傳陣列進來
		$this->db->where(array(
			'user_id' => $user_id,
			'order_id' => $order_id
		));
		$this->db->update($this->table ,$data);
		return $this->db->affected_rows(); // 還傳影響幾筆資料
	}
}
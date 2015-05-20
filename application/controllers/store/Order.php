<?php

class Order extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['order_model', 'order_img_model', 'order_sub_model']);
		if ( ! $this->check_user() ) {
			return false;
		}
	}

	public function muti($order_id = 0)
	{
		$data = $this->mutiUploading();
		foreach ($data as $key => $value) {
			$this->order_img_model->insert_data(array(
				'user_id' => $this->session->userdata('user_id'),
				'image' => $value['path'],
				'order_id' => $order_id
			));
		}
		return true;
	}

	public function index()
	{
		$orders = $this->order_model->select_by_userId($this->session->userdata('user_id'));
		// 算出總價
		foreach ($orders as $value) {
			$total_price = 0;
			$query = $this->order_img_model->select_by_userId($this->session->userdata('user_id'), $value->order_id);
			foreach ($query as $value2) {
				$sub = $this->order_sub_model->select_by_orderImgId($value2->order_img_id);
				foreach ($sub as $value3) {
					$total_price += $value3->amount * $value3->price;
				}
			}
			$value->total_price = $total_price;
		}
		$this->load->view('store/order_index', array(
			'orders' => $orders
		));
		return true;
	}

	public function create()
	{
		$query = $this->order_img_model->select_by_userId($this->session->userdata('user_id'));
		foreach ($query as $key => $value) {
			$value->order_subs = $this->order_sub_model->select_by_orderImgId($value->order_img_id);
		}
		$this->load->view('store/order_create', array(
			'query' => $query
		));
		return true;
	}

	public function create_sub($order_img_id = null)
	{
		if ( ! $query = $this->order_img_model->select_data($order_img_id)) {
			$this->load->view('failure', array(
				'message' => '無此子訂單'
			));
			return false;
		}

		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/order_create_sub', array(
				'query' => $query
			));
			return true;
		}	

		$data['order_img_id'] = $order_img_id;
		$this->order_sub_model->insert_data($data);
		// if ( $this->order_sub_model->insert_data($data) ) {
		// 	$this->load->view('failure', array(
		// 		'message' => '新增失敗，請再試一次'
		// 	));
		// 	return true;
		// }
		redirect('store/order/create');
		return true;
	}

	public function edit_sub($order_sub_id = null)
	{
		if ( ! $query = $this->order_sub_model->select_data($order_sub_id)) {
			$this->load->view('failure', array(
				'message' => '無此子訂單'
			));
			return false;
		}
		$image = $this->order_img_model->select_data($query->order_img_id)->image;
		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/order_edit_sub', array(
				'query' => $query,
				'image' => $image
			));
			return true;
		}
		$data['order_sub_id'] = $order_sub_id;
		$this->order_sub_model->update_data($data);
		redirect('store/order/create');
		return true;
	}

	public function delete_sub($order_sub_id = null)
	{
		$this->order_sub_model->delete_data($order_sub_id);
		redirect('store/order/create');
		return true;
	}

	public function delete_img($order_img_id = null)
	{
		if ( ! $query = $this->order_img_model->select_data($order_img_id) ) {
			$this->load->view('failure', array(
				'message' => '查無此資料'
			));
			return true;
		}
		@unlink($query->image);
		$this->order_sub_model->delete_by_orderImgId($order_img_id);
		$this->order_img_model->delete_data($order_img_id);
		redirect('store/order/create');
		return true;
	}

	public function submit()
	{
		// 空的不給送單
		if ( empty($query = $this->order_img_model->select_by_userId($this->session->userdata('user_id')))) {
			redirect('store/order/create');
			return true;
		}
		// 判斷項目尚未填寫
		foreach ($query as $value) {
			if ( empty($this->order_sub_model->select_by_orderImgId($value->order_img_id)) ) {
				$this->load->view('failure', array(
					'message' => '您還有商品 項目 以及 位置 未填選唷'
				));
				return true;
			}
		}

		// 判斷位置沒填入
		foreach ($this->order_img_model->select_by_userId($this->session->userdata('user_id')) as $value) {
			if ( $value->position == '' ) {
				$this->load->view('failure', array(
					'message' => '您還有商品位置未填選唷'
				));
				return true;
			}
		}

		// 所有都是空的也不給送
		if ( empty($this->order_img_model->select_by_userId($this->session->userdata('user_id') ) )) {
			redirect('store/order/create');
			return true;
		}	
		date_default_timezone_set("Asia/Taipei");
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'create_time' => date('Y-m-d h:i:s'),
			'update_time' => date('Y-m-d h:i:s')
		);
		if ( ! $order_id = $this->order_model->insert_data($data)) {
			$this->load->view('failure', array(
				'message' => '送出失敗，請再試一次'
			));
			return true;
		}	
		$this->order_img_model->update_by_userId_orderId($this->session->userdata('user_id'), 0, array('order_id' => $order_id));
		redirect('store/order');
		return true;
	}


	public function search()
	{
		$states = $this->order_model->select_all_state();
		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/order_search', array(
				'states' => $states
			));
			return true;
		}
		$data['user_id'] = $this->session->userdata('user_id');
		$orders = $this->order_model->search_at_user($data);
		// 算出總價
		foreach ($orders as $value) {
			$total_price = 0;
			$query = $this->order_img_model->select_by_userId($this->session->userdata('user_id'), $value->order_id);
			foreach ($query as $value2) {
				$sub = $this->order_sub_model->select_by_orderImgId($value2->order_img_id);
				foreach ($sub as $value3) {
					$total_price += $value3->amount * $value3->price;
				}
			}
			$value->total_price = $total_price;
		}
		$this->load->view('store/order_index', array(
			'orders' => $orders,
			'data' => $data
		));
		return true;
	}

	public function detail($order_id = null)
	{
		// 若連一個子訂單都沒有就自動刪除掉
		if ( ! $query = $this->order_img_model->select_by_orderId($order_id) ) {
			$this->order_model->delete_data($order_id);
			redirect('store/order');
			return true;
		}
		foreach ($query as $key => $value) {
			$value->order_subs = $this->order_sub_model->select_by_orderImgId($value->order_img_id);
		}
		$this->load->view('store/order_detail', array(
			'query' => $query
		));
		return true;	
	}

	public function detail_delete_img($order_img_id = null, $order_id = null)
	{
		// 若處理了就無法編輯
		if ( $this->order_model->select_data($order_id)->state_id > 1) {
			redirect('store/order/detail/'.$order_id);
			return true;
		}

		if ( ! $query = $this->order_img_model->select_data($order_img_id) ) {
			$this->load->view('failure', array(
				'message' => '查無此資料'
			));
			return true;
		}
		@unlink($query->image);
		$this->order_sub_model->delete_by_orderImgId($order_img_id);
		$this->order_img_model->delete_data($order_img_id);
		redirect('store/order/detail/'.$order_id);
		return true;
	}

	public function detail_edit_sub($order_sub_id = null, $order_id = null)
	{
		// 若處理了就無法編輯
		if ( $this->order_model->select_data($order_id)->state_id > 1) {
			redirect('store/order/detail/'.$order_id);
			return true;
		}

		if ( ! $query = $this->order_sub_model->select_data($order_sub_id)) {
			$this->load->view('failure', array(
				'message' => '無此子訂單'
			));
			return false;
		}
		$image = $this->order_img_model->select_data($query->order_img_id)->image;
		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/order_edit_sub', array(
				'query' => $query,
				'image' => $image
			));
			return true;
		}
		$data['order_sub_id'] = $order_sub_id;
		$this->order_sub_model->update_data($data);
		redirect('store/order/detail/'.$order_id);
		return true;
	}

	public function detail_delete_sub($order_sub_id = null, $order_id = null)
	{
		// 若處理了就無法編輯
		if ( $this->order_model->select_data($order_id)->state_id > 1) {
			redirect('store/order/detail/'.$order_id);
			return true;
		}
		$this->order_sub_model->delete_data($order_sub_id);
		redirect('store/order/detail/'.$order_id);
		return true;
	}

	public function detail_create_sub($order_img_id = null, $order_id = null)
	{
		// 若處理了就無法編輯
		if ( $this->order_model->select_data($order_id)->state_id > 1) {
			redirect('store/order/detail/'.$order_id);
			return true;
		}

		if ( ! $query = $this->order_img_model->select_data($order_img_id)) {
			$this->load->view('failure', array(
				'message' => '無此子訂單'
			));
			return false;
		}

		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/order_create_sub', array(
				'query' => $query
			));
			return true;
		}	

		$data['order_img_id'] = $order_img_id;
		$this->order_sub_model->insert_data($data);
		redirect('store/order/detail/'.$order_id);
		return true;
	}	

	public function message($order_img_id = null)
	{
		if ( ! $query = $this->order_img_model->select_data($order_img_id)) {
			$this->load->view('failure', array(
				'message' => '查無此子訂單'
			));
			return true;
		}
		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/order_message', array(
				'store_message' => $query->store_message
			));
			return true;
		}

		$data['order_img_id'] = $order_img_id;
		$this->order_img_model->update_data($data);
		redirect('store/order/create');
		return true;
	}

	public function detail_message($order_img_id = null, $order_id = null)
	{
		if ( ! $query = $this->order_img_model->select_data($order_img_id)) {
			$this->load->view('failure', array(
				'message' => '查無此子訂單'
			));
			return true;
		}
		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/order_message', array(
				'store_message' => $query->store_message
			));
			return true;
		}

		$data['order_img_id'] = $order_img_id;
		$this->order_img_model->update_data($data);
		redirect('store/order/detail/'.$order_id);
		return true;
	}

	public function position($order_img_id = null)
	{
		if ( ! $query = $this->order_img_model->select_data($order_img_id)) {
			$this->load->view('failure', array(
				'message' => '查無此子訂單'
			));
			return true;
		}
		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/order_position', array(
				'position' => $query->store_message
			));
			return true;
		}
		$data['order_img_id'] = $order_img_id;
		$this->order_img_model->update_data($data);
		redirect('store/order/create');
		return true;
	}

	public function detail_position($order_img_id = null, $order_id = null)
	{
		if ( ! $query = $this->order_img_model->select_data($order_img_id)) {
			$this->load->view('failure', array(
				'message' => '查無此子訂單'
			));
			return true;
		}
		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/order_position', array(
				'position' => $query->store_message
			));
			return true;
		}
		$data['order_img_id'] = $order_img_id;
		$this->order_img_model->update_data($data);
		redirect('store/order/detail/'.$order_id);
		return true;
	}

}
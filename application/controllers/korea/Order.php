<?php
/**
 * @author Piece Chao <piece601@hotmail.com>
 */

class Order extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['user_model', 'order_model', 'order_img_model', 'order_sub_model', 'state_model']);
		if ( ! $this->check_korea() ) {
			return false;
		}

	}

	public function index()
	{
		$orders = $this->order_model->select_all();
		// 算出總價
		foreach ($orders as $value) {
			$total_price = 0;
			$unsend = 0;
			$query = $this->order_img_model->select_by_orderId($value->order_id);
			foreach ($query as $value2) {
				$sub = $this->order_sub_model->select_by_orderImgId($value2->order_img_id);
				foreach ($sub as $value3) {
					if ($value3->sub_state != '結束') {
						$total_price += $value3->amount * $value3->price;
					}	
					if ($value3->sub_state == '訂') {
						$unsend++;
					}
				}
			}
			$value->total_price = $total_price;
			$value->unsend = $unsend;
		}
		$this->load->view('korea/order_index', array(
			'orders' => $orders
		));
		return true;
	}

	public function delete($order_id = null)
	{
		if ( ! $query = $this->order_model->select_data($order_id)) {
			$this->load->view('failure', array(
				'message' => '查無此訂單喲'
			));
			return true;
		}
		$query = $this->order_img_model->select_by_orderId($order_id);
		foreach ($query as $value) {
			$query2 = $this->order_img_model->select_data($value->order_img_id);
			@unlink($query2->image);
			$this->order_sub_model->delete_by_orderImgId($value->order_img_id);
			$this->order_img_model->delete_data($value->order_img_id);
		}
		$this->order_model->delete_data($order_id);
		$this->load->view('success', array(
			'message' => '刪除成功',
			'redirectUrl' => 'korea/order'
		));
		return true;
	}

	public function detail($order_id = null)
	{
		// 若連一個子訂單都沒有就自動刪除掉
		if ( ! $query = $this->order_img_model->select_by_orderId($order_id) ) {
			$this->order_model->delete_data($order_id);
			redirect('korea/order');
			return true;
		}
		foreach ($query as $key => $value) {
			$value->order_subs = $this->order_sub_model->select_by_orderImgId($value->order_img_id);
		}
		$user_detail = $this->user_model->select_data($this->order_img_model->select_by_orderId($query[0]->order_id)[0]->user_id);
		$title = '訂單編號：'.$order_id.'  公司：'.$user_detail->company;
		$this->load->view('korea/order_detail', array(
			'query' => $query,
			'user_detail' => $user_detail,
			'title' => $title
		));
		return true;	
	}

	public function detail_delete_img($order_img_id = null, $order_id = null)
	{
		// 若處理了就無法編輯
		if ( $this->order_model->select_data($order_id)->state_id > 1) {
			redirect('korea/order/detail/'.$order_id);
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
		redirect('korea/order/detail/'.$order_id);
		return true;
	}

	public function detail_edit_sub($order_sub_id = null, $order_id = null)
	{
		// 若處理了就無法編輯
		// if ( $this->order_model->select_data($order_id)->state_id > 1) {
		// 	redirect('korea/order/detail/'.$order_id);
		// 	return true;
		// }

		if ( ! $query = $this->order_sub_model->select_data($order_sub_id)) {
			$this->load->view('failure', array(
				'message' => '無此子訂單'
			));
			return false;
		}
		$image = $this->order_img_model->select_data($query->order_img_id)->image;
		if ( ! $data = $this->input->post() ) {
			$this->load->view('korea/order_edit_sub', array(
				'query' => $query,
				'image' => $image
			));
			return true;
		}
		$data['order_sub_id'] = $order_sub_id;
		$this->order_sub_model->update_data($data);
		redirect('korea/order/detail/'.$order_id);
		return true;
	}

	public function detail_delete_sub($order_sub_id = null, $order_id = null)
	{
		// 若處理了就無法編輯
		// if ( $this->order_model->select_data($order_id)->state_id > 1) {
		// 	redirect('korea/order/detail/'.$order_id);
		// 	return true;
		// }

		$this->order_sub_model->delete_data($order_sub_id);
		redirect('korea/order/detail/'.$order_id);
		return true;
	}

	public function detail_create_sub($order_img_id = null, $order_id = null)
	{
		// 若處理了就無法編輯
		// if ( $this->order_model->select_data($order_id)->state_id > 1) {
		// 	redirect('korea/order/detail/'.$order_id);
		// 	return true;
		// }

		if ( ! $query = $this->order_img_model->select_data($order_img_id)) {
			$this->load->view('failure', array(
				'message' => '無此子訂單'
			));
			return false;
		}

		// 判斷項目有沒有大於 3 個，就是不能超過 4個
		if (count($this->order_sub_model->select_by_orderImgId($order_img_id)) > 3) {
			$this->load->view('failure', array(
				'message' => '一個圖片最多只能 4 個項目'
			));
			return true;
		}


		if ( ! $data = $this->input->post() ) {
			$this->load->view('korea/order_create_sub', array(
				'query' => $query
			));
			return true;
		}	

		$data['order_img_id'] = $order_img_id;
		$this->order_sub_model->insert_data($data);
		redirect('korea/order/detail/'.$order_id.'#'.$order_img_id);
		return true;
	}

	public function message($order_img_id = null, $order_id = null)
	{
		if ( ! $query = $this->order_img_model->select_data($order_img_id)) {
			$this->load->view('message', array(
				'message' => '查無此子訂單'
			));
			return true;
		}
		if ( ! $data = $this->input->post() ) {
			$this->load->view('korea/order_message', array(
				'korea_message' => $query->korea_message
			));
			return true;
		}
		$data['order_img_id'] = $order_img_id;
		$this->order_img_model->update_data($data);
		redirect('korea/order/detail/'.$order_id.'#'.$order_img_id);
		return true;
	}

	public function edit_state($order_id = null)
	{
		if ( ! $query = $this->order_model->select_data($order_id) ) {
			redirect('korea/order');
			return true;
		}
		$states = $this->state_model->select_all_data('asc');
		if ( ! $data = $this->input->post() ) {
			$this->load->view('korea/order_state_edit', array(
				'query' => $query,
				'states' => $states
			));
			return true;
		}
		$data['order_id'] = $order_id;
		$this->order_model->update_data($data);
		redirect('korea/order/detail/'.$order_id);
		return true;
	}

	public function search()
	{
		$states = $this->order_model->select_all_state();
		if ( ! $data = $this->input->post() ) {
			$this->load->view('korea/order_search', array(
				'states' => $states
			));
			return true;
		}
		$orders = $this->order_model->select_all_by_search($data);
		// 算出總價
		foreach ($orders as $value) {
			$total_price = 0;
			$unsend = 0;
			$query = $this->order_img_model->select_by_orderId($value->order_id);
			foreach ($query as $value2) {
				$sub = $this->order_sub_model->select_by_orderImgId($value2->order_img_id);
				foreach ($sub as $value3) {
					$total_price += $value3->amount * $value3->price;
					if ($value3->sub_state == '訂') {
						$unsend++;
					}
				}
			}
			$value->total_price = $total_price;
			$value->unsend = $unsend;
		}
		$this->load->view('korea/order_index', array(
			'orders' => $orders,
			'data' => $data
		));
		return true;
	}

	public function all_unsend()
	{
		$orders = $this->order_model->select_all();
		// 算出總價
		foreach ($orders as $key => $value) {
			$total_price = 0;
			$unsend = 0;
			$query = $this->order_img_model->select_by_orderId($value->order_id);
			foreach ($query as $value2) {
				$sub = $this->order_sub_model->select_by_orderImgId($value2->order_img_id);
				foreach ($sub as $value3) {
					$total_price += $value3->amount * $value3->price;
					if ($value3->sub_state == '訂') {
						$unsend++;
					}
				}
			}
			// 刪除掉無未送的
			if ($unsend < 1) {
				unset($orders[$key]);
			}
			$value->total_price = $total_price;
			$value->unsend = $unsend;
		}
		$this->load->view('korea/order_index', array(
			'orders' => $orders
		));
		return true;
	}	

}
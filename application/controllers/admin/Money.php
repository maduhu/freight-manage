<?php

class Money extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('money_model', 'user_model'));
		if ( ! $this->check_admin() ) {
			return false;
		}
	}

	public function index()
	{
		$moneys = $this->money_model->select_all_data();
		$this->load->view('admin/money_index', array(
			'moneys' => $moneys,
		));
		return true;
	}

	public function create($user_id = null)
	{
		$this->load->model('user_model');
		$users = $this->user_model->select_all_data();
		if ( ! $this->input->post() ) {
			$this->load->view('admin/money_create', array(
				'users' => $users,
				'user_id' => $user_id
			));
			return true;
		}
		if ( ! $this->money_model->insert_data($this->input->post()) ) {
			$this->load->view('failure', array(
				'message' => '新增失敗，請再試一次'
			));
			return true;
		}
		$this->load->view('success', array(
			'message' => '新增成功',
			'redirectUrl' => 'admin/money'
		));
		return true;
	}

	public function create_search()
	{
		if ( ! $query = $this->input->post() ) {
			$this->load->view('admin/money_create_search');
			return true;
		}
		$keyword = $query['keyword'];
		$query = $this->user_model->search($keyword);
		$this->load->view('admin/money_create_search', array(
			'query' => $query
		));
		return true;
	}

	public function edit($money_id = null)
	{
		if ( ! $query = $this->money_model->select_data($money_id)) {
			$this->load->view('failure', array(
				'message' => '查無此資料'
			));
			return false;
		}
		if ( ! $data = $this->input->post() ) {
			$users = $this->user_model->select_all_data();
			$this->load->view('admin/money_edit', array(
				'query' => $query,
				'users' => $users
			));
			return true;
		}
		$data['money_id'] = $money_id;
		$this->money_model->update_data($data);
		$this->load->view('success', array(
			'message' => '更新成功',
			'redirectUrl' => 'admin/money'
		));
		return true;
	}

	public function delete($money_id = null)
	{
		if ( ! $this->money_model->select_data($money_id)) {
			$this->load->view('failure', array(
				'message' => '查無此資料'
			));
			return false;
		}
		$this->money_model->delete_data($money_id);
		$this->load->view('success', array(
			'message' => '刪除成功',
			'redirectUrl' => 'admin/money'
		));
		return true;
	}

	public function search()
	{
		if ( ! $data = $this->input->post() ) {
			$users = $this->user_model->select_all_data();
			$this->load->view('admin/money_search', array(
				'users' => $users
			));
			return true;
		}
		if (isset($data['opt2'])) {
			$data['company_name'] = $this->user_model->select_data($data['company'])->company;
		}
		$moneys = $this->money_model->search($data);
		$this->load->view('admin/money_index', array(
			'moneys' => $moneys,
			'data' => $data
		));
		return true;
	}
}
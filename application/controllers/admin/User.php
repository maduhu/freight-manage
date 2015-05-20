<?php

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		if ( ! $this->check_admin() ) {
			return false;
		}

	}

	public function index()
	{
		$users = $this->user_model->select_all_data();
		$this->load->view('admin/user_index', array(
			'users' => $users
		));
		return true;
	}

	public function create()
	{
		if ( ! $this->input->post() ) {
			$this->load->view('admin/user_create');
			return true;
		}
		$account = $this->input->post('account');
		if ( $this->user_model->select_by_account($account) ) {
			$this->load->view('failure', array(
				'message' => '已經有相同帳號囉 '.$account
			));
			return true;
		}
		$data = $this->input->post();
		if ( $this->user_model->insert_data($data) ) {
			$this->load->view('success', array(
				'message' => '新增成功',
				'redirectUrl' => 'admin/user'
			));
			return true;
		}
		$this->load->view('failure', array(
			'message' => '新增失敗，請稍候再試'
		));
		return false;
	}

	public function edit($user_id = null)
	{
		if ( ! $query = $this->user_model->select_data($user_id) ) {
			$this->load->view('failure', array(
				'message' => '查無此資料'
			));
			return false;
		}
		if ( ! $this->input->post() ) {
			$this->load->view('admin/user_edit', array(
				'query' => $query
			));
			return true;
		}	
		$data = $this->input->post();
		$data['user_id'] = $user_id;
		$this->user_model->update_data($data);
		$this->load->view('success', array(
			'message' => '更新成功',
			'redirectUrl' => 'admin/user'
		));
		return true;
	}

	public function delete($user_id = null)
	{
		if ( ! $query = $this->user_model->select_data($user_id) ) {
			$this->load->view('failure', array(
				'message' => '刪除失敗，查無此資料'
			));
			return false;
		}
		$this->user_model->delete_data($user_id);
		$this->load->view('success', array(
			'message' => '刪除成功',
			'redirectUrl' => 'admin/user'
		));
		return true;
	}

	public function search()
	{
		$keyword = $this->input->post('keyword', true);
		if ($keyword == '') {
			redirect('admin/user');
			return true;
		}
		$users = $this->user_model->search($keyword);
		$this->load->view('admin/user_index', array(
			'users' => $users,
			'keyword' => $keyword
		));
		return true;
	}

}
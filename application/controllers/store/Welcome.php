<?php

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		if ( ! $this->input->post() ) {
			$this->load->view('store_index');
			return true;
		}
		$account = $this->input->post('account', true);
		$password = $this->input->post('password', true);
		if ( ! $query = $this->user_model->select_by_account_password($account, $password) ) {
			$this->load->view('failure', array(
				'message' => '帳號或者密碼錯誤唷'
			));
			return true;
		}
		$this->session->set_userdata(array(
			'ident' => 'user',
			'user_id' => $query->user_id
		));
		$this->load->view('success', array(
			'message' => $query->user_name . ' 登入成功，歡迎您回來',
			'redirectUrl' => 'store/welcome/panel'
		));
		return true;
	}

	public function panel()
	{
		$this->load->view('store_panel');
		return true;
	}
}
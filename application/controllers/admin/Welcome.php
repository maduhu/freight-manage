<?php

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		if ( ! $this->input->post() ) {
			$this->load->view('admin_index');
			return true;
		}
		if ( ! $this->admin_model->select_admin($this->input->post('data')) ) {
			$this->load->view('failure', array(
				'message' => '帳號或者密碼錯誤',
			));
			return true;
		}
		$this->session->set_userdata('ident', 'admin');
		redirect('admin/welcome/panel');
	}

	public function panel()
	{
		if ( ! $this->check_admin() ) {
			return false;
		}
		$this->load->view('admin_panel');
		return true;
	}
}
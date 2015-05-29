<?php
/**
 * @author Piece Chao <piece601@hotmail.com>
 */

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('korea_model');
	}

	public function index()
	{
		if ( ! $this->input->post() ) {
			$this->load->view('korea_index');
			return true;
		}
		if ( ! $this->korea_model->select_korea($this->input->post('data')) ) {
			$this->load->view('failure', array(
				'message' => '帳號或者密碼錯誤',
			));
			return true;
		}
		$this->session->set_userdata('ident', 'korea');
		redirect('korea/welcome/panel');
	}

	public function panel()
	{
		if ( ! $this->check_korea() ) {
			return false;
		}
		$this->load->view('korea_panel');
		return true;
	}
}
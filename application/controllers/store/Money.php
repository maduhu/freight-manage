<?php

class Money extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('money_model');
	}

	public function index()
	{
		$moneys = $this->money_model->select_by_userId($this->session->userdata('user_id'));
		$this->load->view('store/money_index', array(
			'moneys' => $moneys
		));
		return true;	
	}

	public function search()
	{
		if ( ! $data = $this->input->post() ) {
			$this->load->view('store/money_search');
			return true;
		}
		if (isset($data['opt2'])) {
			$data['company_name'] = $this->user_model->select_data($data['company'])->company;
		}
		$data['user_id'] = $this->session->userdata('user_id');
		$moneys = $this->money_model->search_at_user($data);
		$this->load->view('store/money_index', array(
			'moneys' => $moneys,
			'data' => $data
		));
		return true;
	}

}
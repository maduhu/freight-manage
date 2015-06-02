<?php

class Welcome extends CI_Controller {
	public function index()
	{
		redirect('store');
		return true;
		$this->session->sess_destroy();
		$this->load->view('welcome');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect();
		return true;
	}
}

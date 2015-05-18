<?php

class Form extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('test/form_index');
		return true;
	}

	public function indexH($value='')
	{
		$this->load->view('test/form_indexh');
		return true;
	}

	public function upload($value='')
	{
		$this->load->view('test/form_upload');
		return true;
	}

	public function uploadH($value='')
	{
		$this->load->view('test/form_uploadh');
	}

}
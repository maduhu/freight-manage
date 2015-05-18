<?php

class Sess extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function add($param)
	{
		$this->session->set_userdata($param , $param);
		echo "<pre>";	
		var_dump($this->session->all_userdata());
		echo "</pre>";
		return true;
	}

	public function delete()
	{
		$this->session->sess_destroy();
		echo "<pre>";
		var_dump($this->session->all_userdata());
		return true;
	}

	public function index()
	{
		echo "<pre>";
		var_dump($this->session->all_userdata());
		return true;
	}
	
}

/* End of file */
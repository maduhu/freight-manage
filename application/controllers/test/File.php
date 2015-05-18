<?php

class File extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		echo '單檔案上傳 <a href="' . base_url('test/file/single') . '">Click</a>' . "<br>";
		echo '多檔案上傳 <a href="' . base_url('test/file/muti') . '">Click</a>' . "<br>";
		return true;
	}

	public function single() // 單檔案上傳
	{
		if ( empty($_FILES) ){ //判斷無檔案進來
			$this->load->view('test/file_single');
			return true;
		}

		if ( ! $data = $this->singleUploading() ){
			$this->load->view('failure', array('message' => '上傳失敗'));
			return false;
		}
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		return true;
	}

	public function muti() //多檔案上傳
	{
		if ( empty($_FILES) ){
			$this->load->view('test/file_muti');
			return true;
		}

		if ( ! $data = $this->mutiUploading() ){ //上傳失敗
			$this->load->view('failure', array('message' => '上傳失敗'));
			return false;
		}
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		return true;
	}

	public function realtime() // 即時上傳
	{
		$this->load->view('test/file_realtime');
		return true;
	}

	public function realtimeUpload() // 回傳上傳結果
	{
		echo $this->singleUploading()['path'];
		return true;
	}

}

/* End of file */
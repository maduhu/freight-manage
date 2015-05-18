<?php

class Mail extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$content = '發信成功' . "<br>" . 'Code By Piece.';
 		$this->mailing('piece601@hotmail.com', $content);
		return false;
	}
}

/* End of file */
<?php

class State_model extends MY_Model {
	protected $table = 'states';
	protected $primaryKey = 'state_id';

	public function __construct()
	{
		parent::__construct();
	}
}
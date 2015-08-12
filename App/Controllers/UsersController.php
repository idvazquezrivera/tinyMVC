<?php
class Users extends Controller 
{
	public function index()
	{
		$user_model = $this->loadModel('User');
		$this->set('date', date('Y-m-d h:i:s'));
	}

	public function add()
	{
		$this->set('date', date('Y-m-d h:i:s'));
	}
}

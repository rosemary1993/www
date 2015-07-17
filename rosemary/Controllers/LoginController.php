<?php
class LoginController extends Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->Load->view('login');
	}
}
?>
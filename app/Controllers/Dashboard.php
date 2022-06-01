<?php namespace App\Controllers;

class Dashboard extends BaseController
{

	public function __construct(Type $foo = null)
	{
		helper('form');
	}
	public function index()
	{
		return view('welcome_message');
	}

	//--------------------------------------------------------------------

}

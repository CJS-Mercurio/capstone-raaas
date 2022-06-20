<?php 

namespace App\Controllers;

use \CodeIgniter\Controller;

class EmailControler extends BaseController {


	public function __construct() {

		helper('url')
	}

	public function index() {

		return view('form.php')
	}

	public function send() {

		echo 'sent';
	}
}
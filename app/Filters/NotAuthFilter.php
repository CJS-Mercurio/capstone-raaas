<?php

namespace App\Filters;

use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;

class NotAuthFilter implements FilterInterface
{
	
	public function before(RequestInterface $request, $arguments = null){

		 if(session()->get('logged_user')){

          // return redirect()->to(current_url());
      	}

	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

			}
}
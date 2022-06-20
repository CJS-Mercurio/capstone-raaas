<?php 

namespace App\Controllers;

use \CodeIgniter\Controller;

class TestMail extends Controller {


	public function index() {

		// echo "Test Email";
		// $to = 'christjohn.mercurio04@gmail.com';

		// if the document is approved, send notification to the email of the user

		// $to = 'christjohn.mercurio04@gmail.com';
		$to = $this->request->getVar('email');
		$subject = 'Research Approval';
		$message = 'Congratulations, Your Research has been Approved!';

		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('puptraaas@gmail.com','Research Analytics Archiving and Approval System');
		$email->setSubject($subject);
		$email->setMessage($message);
		//$filepath = 'public/assets/images/white.png';

		
		if ($email->send()) {

			echo "Email Notification Sent Successfully";
		} else {

			$data = $email->printDebugger(['headers']);
			print_r($data);
		}

		
	}
}
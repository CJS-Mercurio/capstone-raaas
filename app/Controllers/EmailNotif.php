<?php 

namespace App\Controllers;

use \CodeIgniter\Controller;

class EmailControler extends Controller {

	public function send_notif(){

	$email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
	$userdata = $this->userResearchModel->getStudentResearchEmail($email);

	if(!empty($userdata)){

		$to = $email;
		$subject = 'Research Approval';
		// $token = $userdata['uniid'];
		$message = 'Congratulations, Your Research has been Approved!';
		// $message = 'Hi ' .$userdata['first_name'].'<br><br>'
		// . 'Your reset password request has been received.'
		// . ' Please click the link below to reset your password<br>'
		// . '<a href = "'. base_url().'/login/reset_password/'.$token.'">Click Here</a>'
		// . '<br><br>Thanks!';

		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('puptraaas@gmail.com','Research Analytics Archiving and Approval System');
		$email->setSubject($subject);
		$email->setMessage($message);

		if($email->send()){
			session()->setTempdata('success', 'Email notification sent successfully!');
			return redirect()->to(base_url()."/home");
		}else{
			$data = $email->printDebugger(['headers']);
			print_r($data);
		}
	}
}
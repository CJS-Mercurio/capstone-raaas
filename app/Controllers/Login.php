<?php

namespace App\Controllers;
use \CodeIgniter\Controller;
use App\Models\LoginModel;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\PanelResearchModel;

use Modules\ResearchManagement\Models\UserResearchModel;
use Modules\Professor\Models\ProfessorResearchModel;
use Modules\ForumManagement\Models\ForumModel;

use Modules\Admin\Models\AdminConfigModel;
use Modules\SuperAdmin\Models\CourseScheduleModel;


class Login extends BaseController{

	public $loginModel;
	public $session;
	public $data = [];

	public function __construct(){

		helper(['form']);

		$this->data['validation'] = null;

		$this->loginModel = new LoginModel();
		$this->session = session();

		$this->adminConfigModel = new AdminConfigModel();
		$this->data['ad_config'] = $this->adminConfigModel->findAll();

		$sy_cd =  $this->adminConfigModel->getsy_cd();

		$this->rModel =  new ResearchModel();
		$this->data['document'] = $this->rModel->getLatestResearchHome($sy_cd['archive_year']);

		$this->forumModel =  new ForumModel();
		$this->data['forum_view'] = $this->forumModel->findAll();

		$this->csModel = new CourseScheduleModel();
		$this->data['course_sched'] = $this->csModel->getSchedule();

		$this->srModel =  new StudentResearchModel();
		$this->prModel =  new PanelResearchModel();

		$this->urModel = new UserResearchModel();
		$this->data['user_research'] = $this->urModel->findAll();

		$this->rpModel =  new ProfessorResearchModel();

	}

	public function index(){
		$data = [];
		$data['validation'] = null;
        
        // print_r($this->data['forum_view']);
        // die();

		echo view('templates/header');
		echo view('login_view', $this->data);
		echo view('templates/footer');

	}

	public function loginV(){
		$data = [];
		$data['validation'] = null;


		if($this->request->getMethod() == 'post'){

			$rules = [

				'username' => [
					'rules' => 'required|regex_match[^(201[1-9]|202[0-1])[-.](00[0-9][0-9][0-9]|000[0-9][0-9][0-9])[-.]TG[-.]0$]',
					'errors' => [
						'required' => 'Student Number is required',
						'regex_match' => 'Student number field format is incorrect',
					],
				],


				'password' => [
					'rules' => 'required|min_length[5]|max_length[16]',
					'errors' =>[
						'required' => 'Password is required',
						'min_length' => 'Password should atleast contain {param} characters'
					],
				],

			];

			if($this->validate($rules)){

				$username = $this->request->getVar('username');
				$password = $this->request->getVar('password');

				$userdata = $this->loginModel->verifyUsername($username);
				$userCount = $this->loginModel->getUserCount();

				if($userdata){
							if(password_verify($password, $userdata['password'])){

								if($userCount == 1){

									if($userdata['status'] == 1){

										$this->session->set('logged_user', $userdata['uniid']);
										return redirect()->to('home');
									}else {
										$this->session->setTempdata('error', 'You\'re account is not yet activated.', 3);
										return redirect()->to(base_url()."/login");

									}

								}else{

										$this->session->setTempdata('error', 'Sorry! Username does not exist', 3);
										return redirect()->to(base_url()."/login");

								}

							}else{
								$this->session->setTempdata('error', 'Username or Password is incorrect. Try again.', 3);
								return redirect()->to(base_url()."/login");
							}


				}else{
					$this->session->setTempdata('error', 'Sorry! Username does not exist', 3);
					return redirect()->to(base_url()."/login");
				}


			}else{
				$username = $this->request->getVar('username');
				$password = $this->request->getVar('password');

				$userdata = $this->loginModel->verifyUsername($username);
				
				// print_r($userdata);
				// die();

				if(MD5($password) == $userdata['password']){
						$this->session->set('logged_user', $userdata['id']);
						return redirect()->to('superadmin');

				}else{
					$this->data['validation'] = $this->validator;

				}
			}


		}


		echo view('templates/header');
		echo view('login_view', $this->data);
		echo view('templates/footer');
	}

	public function loginFaculty(){
		$data = [];
		$data['validation'] = null;


		if($this->request->getMethod() == 'post'){

			$rules = [

				'username1' => [
					'rules' => 'required|regex_match[^(SA000[0-9][0-9]|SA000[0-9]|FA000[0-9][0-9]|FA000[0-9]|AA000[0-9][0-9]|AA000[0-9])TG(200[0-9]|201[0-9]|202[0-1])$]',
					'errors' => [
						'required' => 'Faculty Code is required',
						'regex_match' => 'Faculty Code field format is incorrect',
					],
				],

				'password1' => [
					'rules' => 'required|min_length[5]|max_length[16]',
					'errors' =>[
						'required' => 'Password is required',
						'min_length' => 'Password should atleast contain {param} characters'
					],
				],

			];

			if($this->validate($rules)){

				$username = $this->request->getVar('username1');
				$password = $this->request->getVar('password1');

				$userdata = $this->loginModel->verifyUsername($username);
				$userCount = $this->loginModel->getUserCount();

				if($userdata){
							if(password_verify($password, $userdata['password'])){

								if($userCount == 1){

									if($userdata['status'] == 1){

										$this->session->set('logged_user', $userdata['uniid']);
										return redirect()->to('home');
									}else {
										$this->session->setTempdata('error', 'You\'re account is not yet activated.', 3);
										return redirect()->to(base_url()."/login");
									}

								}else{
										$this->session->setTempdata('error', 'Sorry! Username does not exist', 3);
										return redirect()->to(base_url()."/login");

								}

							}else{
								$this->session->setTempdata('error', 'Username or Password is incorrect. Try again.', 3);
								return redirect()->to(base_url()."/login");
							}


				}else{

					$this->session->setTempdata('error', 'Sorry! Username does not exist', 3);
					return redirect()->to(base_url()."/login");
				}


			}else{
				$username = $this->request->getVar('username1');
				$password = $this->request->getVar('password1');

				$userdata = $this->loginModel->verifyUsername($username);

				if(MD5($password) == $userdata['password']){
						$this->session->set('logged_user', $userdata['id']);
						return redirect()->to('superadmin');

				}else{
					$this->data['validation'] = $this->validator;

				}

			}


		}


		echo view('templates/header');
		echo view('login_view', $this->data);
		echo view('templates/footer');
	}


	public function guest(){
		$data = [];

		echo view('templates/header');
		echo view('guest_view', $this->data);
		echo view('templates/footer');
	}

	public function about(){
		$data = [];

		echo view('templates/header');
		echo view('about');
		echo view('templates/footer');
	}

	public function metrics(){


		$this->adminConfigModel = new AdminConfigModel();
		$this->data['ad_config'] = $this->adminConfigModel->findAll();

		$sy_cd =  $this->adminConfigModel->getsy_cd();

		$data1['views'] = $this->rModel->countView($sy_cd['archive_year']);
		$data2['downloads'] = $this->rModel->countCite($sy_cd['archive_year']);
		$data3['category'] = $this->rModel->countCategory($sy_cd['archive_year']);

		$data = array_merge($data1, $data2, $data3);

		echo view('templates/header');
		echo view('metrics', $data);
		echo view('templates/footer');

	}

	public function guest_view($id=null){
		$data = [];

		$data['panels'] = $this->prModel->getResearchPanelist($id);
    $data4['author'] = $this->urModel->getResearchAuthors($id);
    $data3['research'] = $this->rModel->getResearch($id);

    $research = array_merge($data, $data3, $data4);

		echo view('templates/header');
		echo view('research_guest_view', $research);
		echo view('templates/footer');

	}

	public function reset_pass(){
		$this->session->setTempdata('successChange', 'Password changed successfully', 3);

		echo view('templates/header');
		echo view('login_view',  $this->data);
		echo view('templates/footer');
	}

	public function forgot_password(){
		$data = [];

		if($this->request->getMethod()== 'post'){
			$rules = [
				'email' => [

					'label' => 'Email',
					'rules' => 'required|valid_email',
					'errors'=> [
						'required' => '{field} field required',
						'valid_email' => 'Valid {field} required'
					]

				],
			];

			if($this->validate($rules)){

				$email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
				$userdata = $this->loginModel->verifyEmail($email);

				if(!empty($userdata)){
					if($this->loginModel->updatedAt($userdata['uniid'])){

						$to = $email;
						$subject = 'Reset Password Link';
						$token = $userdata['uniid'];
						$message = 'Hi ' .$userdata['first_name'].'<br><br>'
						. 'Your reset password request has been received.'
						. ' Please click the link below to reset your password<br>'
						. '<a href = "'. base_url().'/login/reset_password/'.$token.'">Click Here</a>'
						. '<br><br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('ORTAC@gmail.com', 'ORTAC');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){
							session()->setTempdata('success', 'Reset password link sent to your email. Please verify within 15 minutes', 3);
							return redirect()->to(base_url()."/forgot_pass");
						}else{
							$data = $email->printDebugger(['headers']);
							print_r($data);
						}

					}else{
							$this->session->setTempdata('error', 'Sorry! Unable to update. Try again.', 3);
					}


				}else{

					$this->session->setTempdata('error', 'Email does not exist', 3);
					return redirect()->to(base_url()."/forgot_pass");
				}

			}else{

				$data['validation'] = $this->validator;
			}
		}

		echo view('templates/header');
		echo view('forgot_password_view', $data);
		echo view('templates/footer');
	}

	public function reset_password($token=null){

		$data = [];

		if(!empty($token)){

			$userdata = $this->loginModel->verifyToken($token);
			if(!empty($userdata)){

				if($this->checkExpiryDate($userdata['updated_at'])){

					if($this->request->getMethod() == 'post'){

						$rules = [
							'npwd' => [
								'label' => 'Password',
								'rules' => 'required|min_length[5]|max_length[18]',
								'errors'=> [
									'required' => '{field} field required',
									'min_length' => '{field} field must be atleast 5 characters',
								]


							],

							'cpwd' => [
								'label' => 'Confirm Password',
								'rules' => 'required|matches[npwd]',
								'errors'=> [
									'required' => '{field} field required',
									'matches' => 'Password does not match!',
								]
							],
						];

						if($this->validate($rules)){

							$npwd = password_hash($this->request->getVar('npwd'), PASSWORD_DEFAULT);

							if($this->loginModel->updatePassword($token, $npwd)){

								session()->setTempdata('successChange,', 'Password updated successfully');
								return redirect()->to(base_url().'/login/reset_pass');

							}else{
								session()->setTempdata('error,', 'Sorry! Unable update password. Try again.');
									return redirect()->to(base_url().'/login/reset_password');
							}

						}else{
							$data['validation'] = $this->validator;
						}
					}


				}else{

					$data['error'] = 'Reset Password link was expired';
				}

			}else{
				$data['error'] = 'Unable to find user account';
			}

		}else{
			$data['error'] = 'Sorry! Unauthorized access.';
		}

		echo view('templates/header');
		echo view('reset_password_view', $data);
		echo view('templates/footer');
	}

	public function checkExpiryDate($time){

			$timeDiff = strtotime(date("Y-m-d h:i:s")) - strtotime($time);

			if($timeDiff < 900){
				return true;
			}else{
				return false;
			}

	}
	
	public function view_forum_guest($id = null){

		$data['forum'] = $this->forumModel->find($id);

		echo view('templates/header');
        echo view('Modules\ForumManagement\Views\guestForumView', $data);
        echo view('templates/footer');

	}



	public function logout(){
		$this->session->remove('logged_user');
		$this->session->destroy();

		return redirect()->to(base_url()."/");

	}
}

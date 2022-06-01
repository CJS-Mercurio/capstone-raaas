<?php

namespace Modules\ResearchManagement\Controllers;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\PanelModel;

use Modules\Admin\Models\AdminConfigModel;
use Modules\Student\Models\StudentModel;
use Modules\Student\Models\StudentCourseModel;

use Modules\Professor\Models\ProfessorModel;

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\RoleModel;
use Modules\SuperAdmin\Models\CourseScheduleModel;


use TablesIgniter\Src\TablesIgniter;

use App\Controllers\BaseController;


class ConfigureResearch extends BaseController{

	public $courseModel;
	public $facultyModel;
	public $paperTypeModel;
	public $adminConfigModel;
	public $temp, $session;
	public $data =[];

	public function __construct(){

			$this->data['validation'] = null;


			$temp_papertype;
			helper("form");
			helper('date');
		 	$this->session = \Config\Services::session();

			$this->csModel = new CourseScheduleModel();
			$this->data['course_sched'] = $this->csModel->getSchedule();

			$this->courseModel = new CourseModel();
	 		$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

	 		$this->facultyModel = new FacultyModel();
	 		$this->data['faculty'] = $this->facultyModel->orderBy('id', 'DESC')->findAll();

			$this->userModel =  new UserModel();
			$this->data['user'] = $this->userModel->orderBy('id', 'DESC')->findAll();

			$this->roleModel =  new RoleModel();
			$this->data['role'] = $this->roleModel->orderBy('id', 'DESC')->findAll();

	 		$this->panelModel = new PanelModel();
	 		$this->data['panel'] = $this->panelModel->findAll();

	 		$this->adminConfigModel = new AdminConfigModel();
	 		$this->data['ad_config'] = $this->adminConfigModel->findAll();

	 		$this->sModel =  new StudentModel();
	 		$this->data['student'] = $this->sModel->orderBy('id', 'DESC')->findAll();

	 		$this->pModel =  new ProfessorModel();
			$this->data['professor'] = $this->pModel->orderBy('id', 'DESC')->findAll();


	 		$this->scModel =  new StudentCourseModel();
	 	  $this->data['student_course'] = $this->scModel->findAll();

		 //kunin ang role id ng user
		 $uniid = session()->get('logged_user');
		 $role = $this->userModel->getLoggedInUserRole($uniid);

 		 $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);
         $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 


	}

	public function index(){
    // print_r($this->data['faculty']);
    // die();
	echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Configure\configureV', $this->data);
    echo view('templates/user/footer');


	}


	function add_course(){


		$this->data['validation'] = null;

		$rules = [

			'course_name' => [
					'rules' => 'required|alpha_numeric_space|min_length[5]|is_unique[course.course_name]',
					'errors' =>[
						'required' => 'Course Title is required',
						'min_length' => 'Course should atleast have {param} characters',
						'is_unique' => 'Course Title already exist',
					],
				],

			'abbreviate' => [
				'rules' => 'required|min_length[3]',
				'errors' =>[
						'required' => 'Abbreviate field is required',
						'min_length' => 'Abbreviate field should atleast have {param} characters',
				],

			],

			'paper_type' => [
				'rules' => 'required',
				'errors' =>[
						'required' => 'Paper type required',

				],

			],


		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){

				// $ref = $this->request->getVar('paper_type');
				// $paper_type_id = $this->paperTypeModel->getPaperTypeId($ref);


				$this->data = [
					'course_name' => $this->request->getVar('course_name', FILTER_SANITIZE_STRING),
					'abbreviate' => $this->request->getVar('abbreviate', FILTER_SANITIZE_STRING),
					'paper_type' => $this->request->getVar('paper_type'),

				];


				if($this->courseModel->save($this->data) === true){

					session()->setTempdata('successCourse', 'Course added successfully', 2);
					return redirect()->to(base_url()."/admin/config");
				}

			}else{

				$this->data['validation'] = $this->validator;
			}



		}


		$this->view_config();

	}

	function delete_course($id){


		if($this->courseModel->where('id', $id)->delete()){

					$this->session->setTempdata('deletedCourse', 'Course deleted successfully', 3);
					return redirect()->to(base_url('/admin/config'));
		}

	}

	function set_school_year(){

		$this->data['validation'] = null;


		$rules = [

			'school_year' => [
					'rules' => 'required|regex_match[^(201[5-9]|202[0-9])[-.](201[5-9]|202[0-9])$]|exact_length[9]',
					'errors' =>[
						'required' => 'School Year is required',
						'regex_match' => 'You entered wrong school year format',
					],
				],


		];


		if($this->request->getMethod() == 'post'){

			if($this->validate($rules)){
			$year = $this->request->getVar('school_year', FILTER_SANITIZE_STRING);
			[$year_start, $year_end] = explode( '-', $year );

			if($year_start > $year_end || $year_start == $year_end){

				session()->setTempdata('errorSY', 'Invalid school year. Try again.', 2);
				return redirect()->to(base_url()."/research/config");
			}else {
				if($this->adminConfigModel->updateSY($year)){

					session()->setTempdata('successSY', 'School year updated successfully', 2);
					return redirect()->to(base_url()."/research/config");
				}
			}

			}else{
				$this->data['validation'] = $this->validator;
			}
		}


		echo view('templates/user/header', $this->data);
		echo view('Modules\ResearchManagement\Views\Configure\configureV', $this->data);
		echo view('templates/user/footer');

	}

	function set_director(){


		$rules = [

			'current_director' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Current Director is required',
					],
				],


		];


		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){

				$this->data = [
				'current_director' => $this->request->getVar('current_director', FILTER_SANITIZE_STRING),

				];

			if($this->adminConfigModel->updateCD($this->data)){

					session()->setTempdata('successCD', 'Director updated successfully', 2);
					return redirect()->to(base_url()."/research/config");

				}

			}else{

				$this->data['validation'] = $this->validator;
			}



		}



		$this->view_config();

	}


	function view_config(){

		echo view('templates/user/header', $this->data);
		echo view('Modules\ResearchManagement\Views\Configure\configureV', $this->data);
		echo view('templates/user/footer');
	}

	function add_faculty(){

		$this->data['validation'] = null;

		$rules =[

				'f_firstname' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'First name is required',
						'min_length' => 'First name must be atleast {param} characters in length',
					],
				],

				'f_lastname' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'Last name is required',
						'min_length' => 'Last name must be atleast {param} characters in length',
					],
				],


				'f_code' => [
					'rules' => 'required|regex_match[^(SA000[0-9][0-9]|SA000[0-9]|FA000[0-9][0-9]|FA000[0-9]|AA000[0-9][0-9]|AA000[0-9])TG|BN(200[0-9]|201[0-9]|202[0-1])$]|is_unique[faculty_adviser.f_code]',
					'errors' => [
						'required' => 'Faculty Code is required',
						'regex_match' => 'Faculty Code field format is incorrect',
						'is_unique' => 'Faculty Code already exist',
					],
				],



			];

		if($this->request->getMethod() == 'post'){


		if($this->validate($rules)){

				$this->data = [
					'first_name' => $this->request->getVar('f_firstname', FILTER_SANITIZE_STRING),
					'last_name' => $this->request->getVar('f_lastname', FILTER_SANITIZE_STRING),
					'f_code' => $this->request->getVar('f_code', FILTER_SANITIZE_STRING),


				];

				$occupation = "Professor";
				$panelData = [
					'first_name' => $this->request->getVar('f_firstname', FILTER_SANITIZE_STRING),
					'last_name' => $this->request->getVar('f_lastname', FILTER_SANITIZE_STRING),
					'occupation'=> $occupation,
				];

				if($this->facultyModel->save($this->data) === true){

					if($this->panelModel->createPanel($panelData) === true){


						session()->setTempdata('successFaculty', 'Faculty added successfully', 2);
						return redirect()->to(base_url()."/research/config");


					}

				}


			}else{

				$this->data['validation'] = $this->validator;
			}

		}


		$this->view_config();
	}


	public function deact_faculty($id = null){

		if($this->facultyModel->deactivate($id)){
			$faculty = $this->facultyModel->find($id);
		  if($this->panelModel->deactivate($faculty['first_name'])){
				session()->setTempdata('successDeact', 'Faculty deactivated successfully', 2);
				return redirect()->to(base_url()."/research/config");

			}

		}else{
			session()->setTempdata('errorDeact', 'Faculty is not deactivated. Try again', 2);
			return redirect()->to(base_url()."/research/config");

		}

	}

	public function act_faculty($id = null){

		if($this->facultyModel->activate($id)){
			$faculty = $this->facultyModel->find($id);
		  if($this->panelModel->activate($faculty['first_name'])){
					session()->setTempdata('successAct', 'Faculty activated successfully', 2);
					return redirect()->to(base_url()."/research/config");
			}
		}else{
			session()->setTempdata('errorAct', 'Faculty is not activated. Try again', 2);
			return redirect()->to(base_url()."/research/config");

		}

	}

	public function set_schedule(){

		$this->data['validation'] = null;

		$rules =[

				'course_id' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Course is required',
					],
				],

				'schedFrom' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Date is required',

					],
				],

				'schedTo' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Date is required',
					],
				],

			];

		if($this->request->getMethod() == 'post'){

				if($this->validate($rules)){

						$this->data = [
							'course_id' => $this->request->getVar('course_id', FILTER_SANITIZE_STRING),
							'dateFrom' => $this->request->getVar('schedFrom', FILTER_SANITIZE_STRING),
							'dateTo' => $this->request->getVar('schedTo', FILTER_SANITIZE_STRING),

						];

						$true = $this->csModel->findCourseId($this->data['course_id']);

						if(empty($true)){

								if($this->csModel->save($this->data) === true){
										session()->setTempdata('successSched', 'Schedule added successfully', 2);
										return redirect()->to(base_url()."/research/config");
								}else{
									session()->setTempdata('errorSched', 'Schedule is not added. Try again', 2);
									return redirect()->to(base_url()."/research/config");
								}

						}else {
							session()->setTempdata('existingSched', 'Selected course already scheduled', 2);
							return redirect()->to(base_url()."/research/config");
						}

					}else{

						$this->data['validation'] = $this->validator;
					}
		}

		$this->view_config();

	}

	public function empty_table(){

			if($this->csModel->empty()){

				session()->setTempdata('successRemove', 'All schedule removed successfully', 2);
				return redirect()->to(base_url()."/research/config");
			}else {
				session()->setTempdata('errorRemove', 'Schedules not removed. Try again', 2);
				return redirect()->to(base_url()."/research/config");
			}
	}

	public function remove_schedule($id = null){

		if($this->csModel->deleteSched($id)){
				session()->setTempdata('successRemove', 'Schedule removed successfully', 2);
					return redirect()->to(base_url()."/research/config");

		}else{
			session()->setTempdata('errorRemove', 'Schedule is not removed. Try again', 2);
			return redirect()->to(base_url()."/research/config");

		}


	}

  ///////////////////////////////////////////////////////////////////////////////////////

public function user_pending_request(){
		//1

	 	$data1['student'] = $this->sModel->findAll();
	 	$data2['professor'] = $this->pModel->findAll();

		$data3['other_role'] = $this->roleModel->findUser();

	 	$pending_acc = array_merge($data1, $data2, $data3);

		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\adminRegisterRequestV', $pending_acc);
		echo view('Modules\Admin\Views\templates\footer');
	}


	public function unactivated_account(){


		$data1['student'] = $this->sModel->findAll();
	 	$data2['professor'] = $this->pModel->findAll();

	 	$pending_acc = array_merge($data1, $data2);

		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\adminUnactivatedAcc', $pending_acc);
		echo view('Modules\Admin\Views\templates\footer');

	}

	public function s_register_request($id=null){
		$student = $this->sModel->find($id);
		$data1['student'] = $this->sModel->find($id);

		$stud_course = $this->scModel->getStudentCourseId($id);

		$data2['course']= $this->courseModel->find($stud_course['course_id']);

	  $data = array_merge($data1, $data2);

	    echo view('Modules\Admin\Views\templates\header', $this->data);
			echo view('Modules\Admin\Views\studRegisterView1', $data);
	    echo view('Modules\Admin\Views\templates\footer');

	}


	public function student_register_request($id=null){

		//2
		$student = $this->sModel->find($id);
		$data1['student'] = $this->sModel->find($id);

		$stud_course = $this->scModel->getStudentCourseId($id);

		$data2['course']= $this->courseModel->find($stud_course['course_id']);

	    $data = array_merge($data1, $data2);


		if($this->verifyAccExpiry($student['activation_date'])){

			$this->session->setTempdata('activation_expired', 'no');


		}else{

			$this->session->setTempdata('activation_expired', 'yes');
			$this->session->setTempdata('expired_message', 'Time limit for account activation has expired. Delete the unactivated account now.');

		}

		 echo view('Modules\Admin\Views\templates\header', $this->data);
		 echo view('Modules\Admin\Views\studRegisterView', $data);
	     echo view('Modules\Admin\Views\templates\footer');

	}

	public function p_register_request($id=null){
		//2
		$prof = $this->pModel->find($id);
		$data['professor'] = $this->pModel->find($id);


		if($this->verifyAccExpiry($prof['activation_date'])){

			$this->session->setTempdata('activation_expired', 'no');


		}else{

			$this->session->setTempdata('activation_expired', 'yes');
			$this->session->setTempdata('expired_message', 'Time limit for account activation has expired. Delete the unactivated account now.');

		}


		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\profRegisterView1', $data);
		echo view('Modules\Admin\Views\templates\footer');

	}



	public function prof_register_request($id=null){
		//2
		$prof = $this->pModel->find($id);
		$data['professor'] = $this->pModel->find($id);


		if($this->verifyAccExpiry($prof['activation_date'])){

			$this->session->setTempdata('activation_expired', 'no');


		}else{

			$this->session->setTempdata('activation_expired', 'yes');
			$this->session->setTempdata('expired_message', 'Time limit for account activation has expired. Delete the unactivated account now.');

		}


		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\profRegisterView', $data);
		echo view('Modules\Admin\Views\templates\footer');

	}

	public function user_register_request($id=null){
		//2
		$user = $this->userModel->find($id);
		$data['user'] = $this->userModel->find($id);


		if($this->verifyAccExpiry($user['activation_date'])){

			$this->session->setTempdata('activation_expired', 'no');


		}else{

			$this->session->setTempdata('activation_expired', 'yes');
			$this->session->setTempdata('expired_message', 'Time limit for account activation has expired. Delete the unactivated account now.');

		}


		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\userRegisterView', $data);
		echo view('Modules\Admin\Views\templates\footer');

	}

	function verifyAccExpiry($reqTime){


		$timeDiff = strtotime(date("Y-m-d h:i:s")) - strtotime($reqTime);

			if($timeDiff < 259200){
				return true;
			}else{
				return false;
			}
		//3
	}

	function delete_student_expired_account($id){

			if($this->sModel->where('id', $id)->delete()){

				$this->session->setTempdata('success','Account deleted successfully.', 3);
								return redirect()->to(base_url()."/admin/userRequest");


			}else{
				$this->session->setTempdata('error', 'Account is not deleted. Try again.');
				return redirect()->to(base_url()."/admin/userRequest");

			}

	}

	function delete_prof_expired_account($id){

			if($this->pModel->where('id', $id)->delete()){

				$this->session->setTempdata('success_prof_delete','Account deleted successfully.', 3);
								return redirect()->to(base_url()."/admin/userRequest");


			}else{
				$this->session->setTempdata('error_prof_delete', 'Account is not deleted. Try again.');
				return redirect()->to(base_url()."/admin/userRequest");

			}
	}

	function delete_user_expired_account($id){

			if($this->userModel->where('id', $id)->delete()){

				$this->session->setTempdata('success_user_delete','Account deleted successfully.', 3);
								return redirect()->to(base_url()."/admin/userRequest");


			}else{
				$this->session->setTempdata('error_user_delete', 'Account is not deleted. Try again.');
				return redirect()->to(base_url()."/admin/userRequest");

			}
	}

	public function student_activate_account($id){
		//4
		if($this->sModel->approve_user_account($id)){
			$student = $this->sModel->getStudentData($id);

						$to = $student['email'];
						$subject = 'Account Activation Link - ORTAC';
						$message = 'Hi ' .$student['first_name'].'.<br><br>'
						. 'Thank you for your registration. Your account has been created successfully. <br>'
						. 'Your <b>student number<b> is set as your default <b>username<b>. <br><br>'
						. 'Please click the link below to activate your account.<br>'
						. '<br>(This link is valid for 3 days from the time this '
						. 'account was created) <br>'
						. '<a href = "'. base_url().'/admin/activateConfirm/'
						. $student['uniid'].'" target="_blank">Activate Now</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('ortac.pupt@gmail.com', 'ORTAC');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Activation link sent successfully.', 3);
								return redirect()->to(base_url()."/admin/userRequest");
		  				}else{

		  					$this->session->setTempdata('error','Unable to activate the account. Please try again', 3);
							return redirect()->to(base_url()."/admin/userRequest");

		  				}
		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/admin/userRequest");

		  }
	}

	public function professor_activate_account($id){

		//4

		if($this->pModel->approve_user_account($id)){
			 $professor = $this->pModel->find($id);

						$to = $professor['email'];
						$subject = 'Account Activation Link - ORTAC';
						$message = 'Hi ' .$professor['f_firstname'].'.<br><br>'
						. 'Thank you for your registration. Your account has been created successfully. <br>'
						. 'Your <b>faculty code<b> is set as your default <b>username<b>. <br><br>'
						. 'Please click the link below to activate your account.<br>'
						. '<a href = "'. base_url().'/admin/activateConfirm/'
						. $professor['uniid'].'" target="_blank">Activate Now</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('ORTAC@gmail.com', 'ORTAC');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Activation link sent successfully.', 3);
								return redirect()->to(base_url()."/admin/userRequest");
		  				}else{

		  					$this->session->setTempdata('error','Unable to activate the account. Please try again', 3);
							return redirect()->to(base_url()."/admin/userRequest");

		  				}
		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/admin/userRequest");

		  }
	}

	public function user_activate_account($id){

		//4

		if($this->userModel->approve_user_account($id)){
			 $user = $this->userModel->find($id);

						$to = $user['email'];
						$subject = 'Account Activation Link - ORTAC';
						$message = 'Hi ' .$user['first_name'].'.<br><br>'
						. 'Thank you for your registration. Your account has been created successfully. <br>'
						. 'Your <b>email</b> is set as your default <b>username</b>. <br><br>'
						. 'Please click the link below to activate your account.<br>'
						. '<a href = "'. base_url().'/admin/activateConfirm/'
						. $user['uniid'].'" target="_blank">Activate Now</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('ORTAC@gmail.com', 'ORTAC');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Activation link sent successfully.', 3);
								return redirect()->to(base_url()."/admin/userRequest");
		  				}else{

		  					$this->session->setTempdata('error','Unable to activate the account. Please try again', 3);
							return redirect()->to(base_url()."/admin/userRequest");

		  				}
		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/admin/userRequest");

		  }
	}

	public function student_deactivate_account($id){


		$student = $this->sModel->getStudentData($id);
		if($this->sModel->disapprove_user_account($id)){

			if($this->scModel->deleteStudentCourse($id)){

						$to = $student['email'];
						$subject = 'Account Activation Link - ORTAC';
						$message = 'Hi ' .$student['first_name'].'<br><br>'
						. 'Thank you for your registration. Sorry your account has been declined. <br>'
						. 'Reason: <b>'. $this->request->getVar('reason').'.</b><br><br>'
						. 'Please click the link below to register again to ORTAC '
						. 'provided that your reason for denial is cleared. <br>'
						. '<a href = "'. base_url().'/choose_role'.'">Register</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('ORTAC@gmail.com', 'ORTAC');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Account has been disapproved.', 3);
								return redirect()->to(base_url()."/admin/userRequest");
		  				}else{

		  					$this->session->setTempdata('error','Unable to disapprove the account. Please try again', 3);
								return redirect()->to(base_url()."/admin/userRequest");

		  				}

		  		}


		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/admin/userRequest");

		  }

	}

	public function professor_deactivate_account($id){


		$prof = $this->pModel->find($id);
		if($this->pModel->disapprove_user_account($id)){

						$to = $prof['email'];
						$subject = 'Account Activation Link - ORTAC';
						$message = 'Hi ' .$prof['f_firstname'].'.<br><br>'
						. 'Thank you for your registration. Sorry your account has been declined. <br>'
						. 'Reason: <b>'. $this->request->getVar('reason').'.</b><br><br>'
						. 'Please click the link below to register again to ORTAC '
						. 'provided that your reason for denial is cleared. <br>'
						. '<a href = "'. base_url().'/choose_role'.'">Register</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('ORTAC@gmail.com', 'ORTAC');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Account has been disapproved.', 3);
								return redirect()->to(base_url()."/admin/userRequest");
		  				}else{

		  					$this->session->setTempdata('error','Unable to disapprove the account. Please try again', 3);
								return redirect()->to(base_url()."/admin/userRequest");

		  				}


		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/admin/userRequest");

		  }

	}

	public function user_deactivate_account($id){


		$user = $this->userModel->find($id);
		if($this->userModel->disapprove_user_account($id)){

						$to = $user['email'];
						$subject = 'Account Activation Link - ORTAC';
						$message = 'Hi ' .$user['first_name'].'.<br><br>'
						. 'Thank you for your registration. Sorry your account has been declined. <br>'
						. 'Reason: <b>'. $this->request->getVar('reason').'.</b><br><br>'
						. 'Please click the link below to register again to ORTAC '
						. 'provided that your reason for denial is cleared. <br>'
						. '<a href = "'. base_url().'/choose_role'.'">Register</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('ORTAC@gmail.com', 'ORTAC');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Account has been disapproved.', 3);
								return redirect()->to(base_url()."/admin/userRequest");
							}else{

								$this->session->setTempdata('error','Unable to disapprove the account. Please try again', 3);
								return redirect()->to(base_url()."/admin/userRequest");

							}


			}else{

				$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/admin/userRequest");

			}

	}




	public function activation_confirm($uniid=null){

		if(!empty($uniid)){

			$studentdata = $this->sModel->verifyUniid($uniid);
			if($studentdata){

				if($this->verify_expiry($studentdata['activation_date'])){

					if($studentdata['status'] == 2) {
						$status = $this->sModel->updateStatus($uniid);
						if($status == true){
							$this->session->setTempdata('activate_success','Account activated successfully.', 3);
						}

					}else{
						$this->session->setTempdata('activate_success','Your account is already activated.', 3);
					}
				}else{
					if($this->deleteAcc($uniid) == true){
						$this->session->setTempdata('activate_error','Sorry! Activation link was expired. Please register again.', 3);
					}
				}

			}else{
				$profdata = $this->pModel->verifyUniid($uniid);
				if($profdata){

					if($this->verify_expiry($profdata->activation_date)){

						if($profdata->status == 2) {
							$status = $this->pModel->updateStatus($uniid);
							if($status == true){
								$this->session->setTempdata('activate_success','Account activated successfully.', 3);
							}

						}else{
							$this->session->setTempdata('activate_success','Your account is already activated.', 3);
						}
					}else{
						$this->session->setTempdata('activate_error','Sorry! Activation link was expired. Please register again.', 3);

					}

				}else{
					$userdata = $this->userModel->verifyUniid($uniid);
					if($userdata){
						if($this->verify_expiry($userdata['activation_date'])){

							if($userdata['status'] == 2) {
								$status = $this->userModel->updateStatus($uniid);
								if($status == true){
									$this->session->setTempdata('activate_success','Account activated successfully.', 3);
								}

							}else{
								$this->session->setTempdata('activate_success','Your account is already activated.', 3);
							}
						}else{
							$this->session->setTempdata('activate_error','Sorry! Activation link was expired. Please register again.', 3);

						}

					}else{

						$this->session->setTempdata('activate_error','Sorry! We are unable to find your account.', 3);

					}
				}

			}//studentdata



		}else{
				$this->session->setTempdata('activate_error','Sorry! Unable to process your request.', 3);

		}

		echo view('templates/header', $this->data);
		echo view('Modules\Admin\Views\activateView');
		echo view('templates/footer');

	}

	public function deleteAcc($uniid){

		if($this->sModel->where('uniid', $uniid)->delete()){
				return true;
			}
		else{
			return false;
		}
	}

	function verify_expiry($regTime){

		$timeDiff = strtotime(date("Y-m-d h:i:s")) - strtotime($regTime);

			if($timeDiff < 259200){
				return true;
			}else{
				return false;
			}

	}

}

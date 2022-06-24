<?php

namespace App\Controllers;
use \CodeIgniter\Controller;
use App\Models\RegisterStudentModel;
use App\Models\RegisterProfessorModel;
use App\Models\UserModel;
use App\Models\Product_filter_model;


use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\StudentModel;

use Modules\SuperAdmin\Models\RoleModel;
use Modules\SuperAdmin\Models\GenderModel;
use Modules\SuperAdmin\Models\YearModel;
use Modules\SuperAdmin\Models\AcademicStatusModel;
use Modules\SuperAdmin\Models\StatusModel;
// use Modules\SuperAdmin\Models\UserModel;




class Register extends Controller{


	public $registerStudentModel;
	public $registerProfessorModel;
	public $session;
	public $email;

	public function __construct(){
		helper(['form']);

		$this->registerStudentModel= new RegisterStudentModel();
		$this->registerProfessorModel= new RegisterProfessorModel();
		$this->userModel= new UserModel();

		$this->roleModel = new RoleModel();
		$this->courseModel = new CourseModel();
		$this->session = \Config\Services::session();
		$this->email = \Config\Services::email();

		$this->genderModel = new GenderModel();
		$this->yearModel = new YearModel();
		$this->acad_statusModel = new AcademicStatusModel();
		$this->statusModel = new StatusModel();

	}


	public function reg_student($role_id){

		$data =[];
		$data1['validation'] = null;

		$data2['course'] = $this->courseModel->findAll();
		$data7['gender'] = $this->genderModel->findAll();
		$data4['year'] = $this->yearModel->findAll();
		$data5['acad_status'] = $this->acad_statusModel->findAll();
		$data6['status'] = $this->statusModel->findAll();



			$rules =[

				'first_name' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'First name is required',
						'min_length' => 'First name must be atleast {param} characters in length',
					],
				],

				'last_name' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'Last name is required',
						'min_length' => 'Last name must be atleast {param} characters in length',
					],
				],

				'gender' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Choose a gender',

					],
				],

				'birthdate' => [
					'rules' => 'required|regex_match[^(19|20)\d\d[-.](0[1-9]|1[012])[-.](0[1-9]|[12][0-9]|3[01])$]',
					'errors' => [
						'required' => 'Birthday is required',
						'regex_match' => 'Birthday field format is incorrect',
					],
				],

				'year' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Year is required',


					],
				],

				'batch_year' => [
					'rules' => 'required|regex_match[^(201[5-9]|202[0-1])[-.](201[5-9]|202[0-1])$]|exact_length[9]',
					'errors' => [
						'required' => 'Batch Year is required',
						'regex_match' => 'Batch Year field format is incorrect',

					],
				],

				'student_number' => [
					'rules' => 'required|regex_match[^(201[5-9]|202[0-1])[-.](00[0-9][0-9][0-9])[-.]TG[-.]0$]|is_unique[student.student_number]',
					'errors' => [
						'required' => 'Student Number is required',
						'regex_match' => 'Student number field format is incorrect',
						'is_unique' => 'Student number already exist',
					],
				],

				'course' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Course is required',
					],
				],

				'academic_status' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Academic Status is required',
					],
				],

				'school_id' => [
					'rules' => 'uploaded[school_id]|ext_in[school_id,jpg,png,jpeg]',
					'errors' =>[
						'uploaded' => 'Upload a file (.jpg, .jpeg, .png).',
						'ext_in' => 'Invalid file extension. Try again.',
					],
				],

				'email' => [
					'rules' => 'required|valid_email|is_unique[student.email]',
					'errors' => [
						'required' => 'Email is required',
						'valid_email' => 'Enter a valid Email',
						'is_unique' => 'Email already exist',
					],
				],

				'password' => [
					'rules' => 'required|min_length[8]|max_length[255]',
					'errors' => [
						'required' => 'Password is required',
						'min_length' => 'Password must be atleast {param} characters in length',
					],
				],

				'password_confirm' => [
					'rules' => 'required|matches[password]',
					'errors' => [
						'required' => 'Password Confirm is required',
						'matches' => 'Password entered do not match',
					],
				],


			];

		if($this->request->getMethod() == 'post'){

				if($this->validate($rules)){

					$file = $this->request->getFile('school_id');
					if($file->isValid() && !$file->hasMoved()){

						if($file->move(FCPATH. 'public\pictures', $file->getName())){
						$school_id = $file->getName();


							$uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
							$userdata = [
								'first_name' => $this->request->getVar('first_name', FILTER_SANITIZE_STRING),
								'middle_name' => $this->request->getVar('middle_name', FILTER_SANITIZE_STRING),
								'last_name' => $this->request->getVar('last_name', FILTER_SANITIZE_STRING),
								'gender' => $this->request->getVar('gender'),
								'birthdate' => $this->request->getVar('birthdate'),
								'academic_year' => $this->request->getVar('year'),
								'batch_year' => $this->request->getVar('batch_year'),
								'student_number' => $this->request->getVar('student_number'),
								'valid_id' => $school_id,
								'role_id' => $role_id,
								'academic_status' => $this->request->getVar('academic_status'),
								'email' => $this->request->getVar('email'),
								'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
								'uniid' => $uniid,
								'activation_date' => date("Y-m-d h:i:s"),
								'status' => 0

							];

						}//move
						else{

							$this->session->setTempdata('wrong', 'You have uploaded an invalid file', 3);
						}

					}//isValid


					$ref = $this->request->getVar('student_number');
					$course_id = $this->request->getVar('course');

					if($this->registerStudentModel->createStudentUser($userdata)){

						$to = $this->request->getVar('email');
						$subject = 'Account Request - RAAAS';
						$message = 'Hi ' .$this->request->getVar('first_name', FILTER_SANITIZE_STRING).'<br><br>'
						. 'Thank you for your registration. Please wait for a notice if your account has been approved.'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('puptraaas@gmail.com','Research Analytics Archiving and Approval System');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

							$student_id = $this->registerStudentModel->getStudentId($ref);

							$student_course_data = [
								'course_id' => $course_id,
								'student_id' => $student_id['id']
							];

							if($this->registerStudentModel->createStudentCourseTable($student_course_data)){

								$this->session->setTempdata('success','Please go to your email to check your account status', 3);
								return redirect()->to(base_url()."/login");

							}

		  				}else{


		  					$this->session->setTempdata('error','Unable to create an account. Please try again', 3);
								return redirect()->to(base_url()."/reg_student/".$role_id);
		  				}


					}else{

						$this->session->setTempdata('error','Sorry! Unable to create an account. Try again', 3);
						return redirect()->to(base_url()."/reg_student/".$role_id);
					}

				}else{

					$data1['validation'] = $this->validator;

				}
		}

		$data3 = [
					'role' => [
							'role_id'     => $role_id,
							'role_name'     => $role_id,


					],
			 ];

		$data = array_merge($data1, $data2, $data3, $data4, $data5, $data6, $data7);


		echo view('templates/header');
		echo view('register_student', $data);
		echo view('templates/footer');

	}

	public function reg_professor($role_id){

		$data =[];
		$data1['validation'] = null;
		$data3['status'] = $this->statusModel->findAll();
		$data4['gender'] = $this->genderModel->findAll();


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

				'f_birthdate' => [
					'rules' => 'required|regex_match[^(19|20)\d\d[-.](0[1-9]|1[012])[-.](0[1-9]|[12][0-9]|3[01])$]',
					'errors' => [
						'required' => 'Birthday is required',
						'regex_match' => 'Birthday field format is incorrect',
					],
				],

				'f_code' => [
					'rules' => 'required|regex_match[^(SA000[0-9][0-9]|SA000[0-9]|FA000[0-9][0-9]|FA000[0-9]|AA000[0-9][0-9]|AA000[0-9])TG(200[0-9]|201[0-9]|202[0-1])$]|is_unique[professor.f_code]',
					'errors' => [
						'required' => 'Faculty Code is required',
						'regex_match' => 'Faculty Code field format is incorrect',
						'is_unique' => 'Faculty Code already exist',
					],
				],


				'position' => [
						'rules' => 'required',
						'errors' => [
								'required' => 'Position is required',
							],
				],


				'f_status' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Choose current Status',
					],
				],

				'f_gender' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Choose a gender',

					],
				],


				'school_id' => [
					'rules' => 'uploaded[school_id]|ext_in[school_id,jpg,png,jpeg]',
					'errors' =>[
						'uploaded' => 'Upload a file (.jpg, .jpeg, .png).',
						'ext_in' => 'Invalid file extension. Try again.',
					],
				],

				'email' => [
					'rules' => 'required|valid_email|is_unique[professor.email]',
					'errors' => [
						'required' => 'Email is required',
						'valid_email' => 'Enter a valid Email',
						'is_unique' => 'Email already exist',
					],
				],

				'password' => [
					'rules' => 'required|min_length[8]|max_length[255]',
					'errors' => [
						'required' => 'Password is required',
						'min_length' => 'Password must be atleast {param} characters in length',
					],
				],

				'password_confirm' => [
					'rules' => 'required|matches[password]',
					'errors' => [
						'required' => 'Password Confirm is required',
						'matches' => 'Password entered do not match',
					],
				],


			];


			if($this->request->getMethod() == 'post'){

				if($this->validate($rules)){

					$file = $this->request->getFile('school_id');
					if($file->isValid() && !$file->hasMoved()){

						if($file->move(FCPATH. 'public\pictures', $file->getName())){
						$school_id = $file->getName();

							$uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
							$userdata = [


								'first_name' => $this->request->getVar('f_firstname', FILTER_SANITIZE_STRING),
								'middle_name' => $this->request->getVar('f_middlename', FILTER_SANITIZE_STRING),
								'last_name' => $this->request->getVar('f_lastname', FILTER_SANITIZE_STRING),
								'birthdate' => $this->request->getVar('f_birthdate'),
								'faculty_code' => $this->request->getVar('f_code'),
								'gender' => $this->request->getVar('f_gender'),
								'valid_id' => $school_id,
								'role_id' => $role_id,
								'faculty_position' => $this->request->getVar('position'),
								'faculty_status' => $this->request->getVar('f_status'),
								'email' => $this->request->getVar('email'),
								'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
								'uniid' => $uniid,
								'activation_date' => date("Y-m-d h:i:s"),
								'status' => 0


							];



						}//move
						else{

							$this->session->setTempdata('wrong', 'You have uploaded an invalid file', 3);
						}

					}//isValid

					if($this->registerProfessorModel->save($userdata)){
						$to = $this->request->getVar('email');
						$subject = 'Account Request - RAAAS';
						$message = 'Hi ' .$this->request->getVar('f_firstname', FILTER_SANITIZE_STRING).'<br><br>'
						. 'Thank you for your registration. Please wait for a notice if your account has been approved.'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('puptraaas@gmail.com','Research Analytics Archiving and Approval System');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

							$this->session->setTempdata('success','Please go to your email to check your account status.', 3);
							return redirect()->to(base_url()."/login");
						}else{


		  				$this->session->setTempdata('error','Unable to create an account. Please try again', 3);
							return redirect()->to(base_url()."/reg_professor/".$role_id);
		  				}


					}else{



						$this->session->setTempdata('error','Sorry! Unable to create an account. Try again', 3);
						return redirect()->to(base_url()."/reg_professor/".$role_id);

					}

				}else{

					$data1['validation'] = $this->validator;

				}
			}

			$data2 = [
						'role' => [
								'role_id'     => $role_id,
								'role_name'     => $role_id,


						],
				 ];

		$data = array_merge($data1, $data2, $data3, $data4);

		echo view('templates/header');
		echo view('register_professor', $data);
		echo view('templates/footer');
	}

	public function reg_member($role_id){
		$data =[];
				$data1['validation'] = null;
				$data4['gender'] = $this->genderModel->findAll();


					$rules =[

						'first_name' => [
							'rules' => 'required|min_length[3]',
							'errors' =>[
								'required' => 'First name is required',
								'min_length' => 'First name must be atleast {param} characters in length',
							],
						],

						'last_name' => [
							'rules' => 'required|min_length[3]',
							'errors' =>[
								'required' => 'Last name is required',
								'min_length' => 'Last name must be atleast {param} characters in length',
							],
						],

						'birthdate' => [
							'rules' => 'required',
							'errors' => [
								'required' => 'Birthday is required',
							],
						],

						'gender' => [
							'rules' => 'required',
							'errors' => [
								'required' => 'Choose a gender',

							],
						],

						'valid_id' => [
							'rules' => 'uploaded[valid_id]|ext_in[valid_id,jpg,png,jpeg]',
							'errors' =>[
								'uploaded' => 'Upload a file (.jpg, .jpeg, .png).',
								'ext_in' => 'Invalid file extension. Try again.',
							],
						],


						'email' => [
							'rules' => 'required|valid_email|is_unique[user.email]',
							'errors' => [
								'required' => 'Email is required',
								'valid_email' => 'Enter a valid Email',
								'is_unique' => 'Email already exist',
							],
						],

						'password' => [
							'rules' => 'required|min_length[8]|max_length[255]',
							'errors' => [
								'required' => 'Password is required',
								'min_length' => 'Password must be atleast {param} characters in length',
							],
						],

						'password_confirm' => [
							'rules' => 'required|matches[password]',
							'errors' => [
								'required' => 'Password Confirm is required',
								'matches' => 'Password entered do not match',
							],
						],

					];


					if($this->request->getMethod() == 'post'){

						if($this->validate($rules)){

							$file = $this->request->getFile('valid_id');
							if($file->isValid() && !$file->hasMoved()){

								if($file->move(FCPATH. 'public\pictures', $file->getName())){
								$valid_id = $file->getName();

									$uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
									$userdata = [

										'first_name' => $this->request->getVar('first_name', FILTER_SANITIZE_STRING),
										'middle_name' => $this->request->getVar('middle_name', FILTER_SANITIZE_STRING),
										'last_name' => $this->request->getVar('last_name', FILTER_SANITIZE_STRING),
										'birthdate' => $this->request->getVar('birthdate'),
										'gender' => $this->request->getVar('gender'),
										'valid_id' => $valid_id,
										'email' => $this->request->getVar('email'),
										'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
										'role_id' => $role_id,
										'uniid' => $uniid,
										'activation_date' => date("Y-m-d h:i:s"),
										'status' => 0

									];

								}//hasMoved
								else{

										$this->session->setTempdata('wrong', 'You have uploaded an invalid file', 3);
								}
							}//isValid

							// echo "<pre>";
		          // print_r($userdata);
		          // die();

							if($this->userModel->createUser($userdata)){

								$to = $this->request->getVar('email');
								$subject = 'Account Request - RAAAS';
								$message = 'Hi ' .$this->request->getVar('f_firstname', FILTER_SANITIZE_STRING).'<br><br>'
								. 'Thank you for your registration. Please wait for a notice if your account has been approved.'
								. '<br>Thanks!';

								$email = \Config\Services::email();
								$email->setTo($to);
								$email->setFrom('puptraaas@gmail.com','Research Analytics Archiving and Approval System');
								$email->setSubject($subject);
								$email->setMessage($message);
								if($email->send()){

									$this->session->setTempdata('success','Account is created successfully. Please wait for your account activation.', 3);
									return redirect()->to(base_url().'/reg_member/'.$role_id);
								}else{

				  					$this->session->setTempdata('error','Unable to create an account. Please try again', 3);
									return redirect()->to(base_url().'/reg_member/'.$role_id);
				  				}

							}else{

								$this->session->setTempdata('error','Sorry! Unable to create an account. Try again', 3);
								return redirect()->to(base_url().'/reg_member/'.$role_id);

							}

						}else{

							$data1['validation'] = $this->validator;

						}
					}


				$data2 = [
							'role' => [
									'role_id'     => $role_id,
									'role_name'     => $role_id,


							],
					 ];

			  $data = array_merge($data1, $data2, $data4);


				echo view('templates/header');
				echo view('register_member', $data);
				echo view('templates/footer');
	}
	public function choose_role(){

		$data =[];
		$data['validation'] = null;
		$data['role'] = $this->roleModel->findAll();


			$rules =[

				'role' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Role is required',
					],
				],

			];

			$role_name = $this->request->getVar('role');
			$role_id = $this->roleModel->findRoleID($role_name);

						if($this->request->getMethod() == 'post'){

							if($this->validate($rules)){

								$id = $role_id['id'];

								echo $role_name;
								if($role_name == "faculty" || $role_name == "professor" || $role_name == "prof" || $role_name == "Faculty" || $role_name == "Professor"){
									return redirect()->to(base_url().'/reg_professor/'.$id);

								}else if($role_name == "student" || $role_name == "stud" || $role_name == "Student"){
									return redirect()->to(base_url().'/reg_student/'.$id);

								}else{
									return redirect()->to(base_url().'/reg_member/'.$id);


								}

							}//rules
							else{

								$data['validation'] = $this->validator;

							}
						}//post


		echo view('templates/header');
		echo view('register_choose_role', $data);
		echo view('templates/footer');

	}



}//end class

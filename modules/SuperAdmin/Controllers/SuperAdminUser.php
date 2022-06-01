<?php

namespace Modules\SuperAdmin\Controllers;

use App\Controllers\BaseController;
use Modules\Student\Models\StudentModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\PanelModel;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\PanelResearchModel;
use Modules\Student\Controllers\FileUploading;

use Modules\SuperAdmin\Models\RoleModel;
use Modules\SuperAdmin\Models\ModuleModel;
use Modules\SuperAdmin\Models\PermissionModel;
use Modules\SuperAdmin\Models\TaskModel;
use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\GenderModel;


class SuperAdminUser extends BaseController{

	public function __construct(){

			$this->data['validation'] = null;
			$this->session = \Config\Services::session();

			helper("form");
			helper('date');


			$this->adminConfigModel = new AdminConfigModel();
			$this->data['ad_config'] = $this->adminConfigModel->findAll();

			$this->permissionModel = new PermissionModel();
			$this->data['permission'] = $this->permissionModel->findAll();

			$this->taskModel = new TaskModel();
			$this->data['task'] = $this->taskModel->findAll();

      $this->userModel = new UserModel();
			$this->data['user'] = $this->userModel->findAll();

			$this->courseModel = new CourseModel();
	 		$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

	 		$this->roleModel = new RoleModel();
	 		$this->data['role'] = $this->roleModel->findAll();

	 		$this->moduleModel = new ModuleModel();
	 		$this->data['module'] = $this->moduleModel->findAll();

			$this->rModel =  new ResearchModel();
			$this->data['research'] = $this->rModel->orderBy('id', 'DESC')->findAll();

			$this->genderModel = new GenderModel();
			$this->roleModel = new RoleModel();



	}

  public function index(){

    $this->data['admins'] = $this->userModel->findRoleID();

    // print_r($data['admins']);

    echo view('Modules\SuperAdmin\Views\templates\header');
    echo view('Modules\SuperAdmin\Views\saUserV', $this->data);
    echo view('Modules\SuperAdmin\Views\templates\footer');

  }

  public function deact_user($id = null){

    if($this->userModel->deactivate($id)){
      session()->setTempdata('successDeact', 'User deactivated successfully', 2);
      return redirect()->to(base_url()."/superadmin/userAccount");

    }else{
      session()->setTempdata('errorDeact', 'User is not deactivated. Please try again.', 2);
      return redirect()->to(base_url()."/superadmin/userAccount");

    }

  }

  public function act_user($id = null){

    echo $id;

    if($this->userModel->activate($id)){
      session()->setTempdata('successAct', 'User activated successfully', 2);
      return redirect()->to(base_url()."/superadmin/userAccount");

    }else{
      session()->setTempdata('errorAct', 'User is not activated. Please try again.', 2);
      return redirect()->to(base_url()."/superadmin/userAccount");

    }

  }

	public function view_user($id=null){

			$data['user'] = $this->userModel->find($id);

			echo view('Modules\SuperAdmin\Views\templates\header');
			echo view('Modules\SuperAdmin\Views\saUserRegistrationV', $data);
			echo view('Modules\SuperAdmin\Views\templates\footer');
		}

		public function add_user(){
			$data1['validation'] = null;
			$data2['gender'] = $this->genderModel->findAll();
			$data3['role'] = $this->roleModel->findAll();
			$data = array_merge($data1, $data2, $data3);

			if($this->request->getMethod() == 'post'){

				$role = $this->request->getVar('role', FILTER_SANITIZE_STRING);

					if($role == 1 || $role == 3){

						return redirect()->to(base_url()."/superadmin/addFacultyUser/". $role);


					}else if($role == 2){

						return redirect()->to(base_url()."/superadmin/addStudentUser/". $role);


					}else{
						die('ERROR');
					}
			}

			return redirect()->to(base_url()."/superadmin/userAccount");


		}

		public function add_faculty_user($role_id){

			$data =[];
			$data1['validation'] = null;

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

							'faculty_code' => [
								'rules' => 'required|regex_match[^(SA000[0-9][0-9]|SA000[0-9]|FA000[0-9][0-9]|FA000[0-9]|AA000[0-9][0-9]|AA000[0-9])TG(200[0-9]|201[0-9]|202[0-1])$]|is_unique[user.faculty_code]',
								'errors' => [
									'required' => 'Faculty Code is required',
									'regex_match' => 'Faculty Code field format is incorrect',
									'is_unique' => 'Faculty Code already exist',

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


										$uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
										$userdata = [

											'first_name' => $this->request->getVar('first_name', FILTER_SANITIZE_STRING),
											'middle_name' => $this->request->getVar('middle_name', FILTER_SANITIZE_STRING),
											'last_name' => $this->request->getVar('last_name', FILTER_SANITIZE_STRING),
											'birthdate' => $this->request->getVar('birthdate'),
											'gender' => $this->request->getVar('gender'),
											'faculty_code' => $this->request->getVar('faculty_code'),
											'email' => $this->request->getVar('email'),
											'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
											'role_id' => $role_id,
											'uniid' => $uniid,
											'activation_date' => date("Y-m-d h:i:s"),
											'status' => 0

										];


								if($this->userModel->save($userdata)){

										$this->session->setTempdata('success','Account is created successfully. Activate the account now.', 3);
										return redirect()->to(base_url()."/superadmin/userAccount");

								}else{

									$this->session->setTempdata('error','Sorry! Unable to create an account. Try again', 3);
									return redirect()->to(base_url()."/superadmin/userAccount");

								}
							}else{

								$data1['validation'] = $this->validator;

							}
						}


				$data2['gender'] = $this->genderModel->findAll();
				$data3['role'] = $this->roleModel->findAll();
				$data4 = [
								'role' => [
										'role_id'     => $role_id,
										'role_name'     => $role_id,


								],
				 ];


				$data = array_merge($data1, $data2, $data3, $data4);

				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saAddFacultyUserV', $data);
				echo view('Modules\SuperAdmin\Views\templates\footer');

		}

		public function add_student_user($role_id){

			$data =[];
			$data1['validation'] = null;

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


							'student_number' => [
								'rules' => 'required|regex_match[^(201[5-9]|202[0-1])[-.](00[0-9][0-9][0-9])[-.]TG[-.]0$]|is_unique[user.student_number]',
								'errors' => [
									'required' => 'Student Number is required',
									'regex_match' => 'Student number field format is incorrect',
									'is_unique' => 'Student number already exist',

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

										$uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
										$userdata = [

											'first_name' => $this->request->getVar('first_name', FILTER_SANITIZE_STRING),
											'middle_name' => $this->request->getVar('middle_name', FILTER_SANITIZE_STRING),
											'last_name' => $this->request->getVar('last_name', FILTER_SANITIZE_STRING),
											'birthdate' => $this->request->getVar('birthdate'),
											'gender' => $this->request->getVar('gender'),
											'student_number' => $this->request->getVar('student_number'),
											'email' => $this->request->getVar('email'),
											'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
											'role_id' => $role_id,
											'uniid' => $uniid,
											'activation_date' => date("Y-m-d h:i:s"),
											'status' => 0

										];


								if($this->userModel->save($userdata)){

										$this->session->setTempdata('success','Account is created successfully. Activate the account now.', 3);
										return redirect()->to(base_url()."/superadmin/userAccount");

								}else{

									$this->session->setTempdata('error','Sorry! Unable to create an account. Try again', 3);
									return redirect()->to(base_url()."/superadmin/userAccount");

								}

							}else{

								$data1['validation'] = $this->validator;

							}
						}


				$data2['gender'] = $this->genderModel->findAll();
				$data3['role'] = $this->roleModel->findAll();
				$data4 = [
								'role' => [
										'role_id'     => $role_id,
										'role_name'     => $role_id,


								],
				 ];

				$data = array_merge($data1, $data2, $data3, $data4);

				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saAddStudentUserV', $data);
				echo view('Modules\SuperAdmin\Views\templates\footer');
		}


}

<?php

namespace Modules\UserManagement\Controllers;

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

use Modules\Professor\Models\ProfessorModel;

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\TaskModel;
use Modules\SuperAdmin\Models\RoleModel;

use Modules\ResearchManagement\Models\UserResearchModel;


class UserAccounts extends BaseController{


	public function __construct(){
		$this->session = \Config\Services::session();

		$this->sModel =  new StudentModel();
	 	$this->data['author'] = $this->sModel->orderBy('id', 'DESC')->findAll();

    $this->courseModel =  new CourseModel();
	 	$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();


		$this->fModel =  new FacultyModel();
	 	$this->data['faculty'] = $this->fModel->orderBy('id', 'DESC')->findAll();

    $this->userModel = new UserModel();
    $this->data['user'] = $this->userModel->findAll();

    $this->roleModel = new RoleModel();
    $this->data['role'] = $this->roleModel->findAll();

    $this->urModel = new UserResearchModel();
    $this->data['user_research'] = $this->urModel->findAll();

    $this->pModel =  new ProfessorModel();
    $this->data['professor'] = $this->pModel->orderBy('id', 'DESC')->findAll();

    $this->scModel =  new StudentCourseModel();
    $this->data['student_course'] = $this->scModel->findAll();

		$this->fileUploading =  new FileUploading();
		$this->prModel =  new PanelResearchModel();
    $this->acModel =  new AdminConfigModel();
    $this->prModel =  new PanelResearchModel();

		helper(['form']);

    $uniid = session()->get('logged_user');
    $role = $this->userModel->getLoggedInUserRole($uniid);

    $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);
    $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 

	}
	public function index(){

		// print_r($this->data['allowed_task']);

    $data1['student'] = $this->sModel->findAll();
    $data2['professor'] = $this->pModel->findAll();

    $data3['other_role'] = $this->roleModel->findUser();

    $data = array_merge($data1, $data2, $data3);

    echo view('templates/user/header', $this->data);
    echo view('Modules\UserManagement\Views\PendingAccountsV', $data);
    echo view('templates/user/footer');

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


  //other user
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


    echo view('templates/user/header', $this->data);
    echo view('Modules\UserManagement\Views\userAccountV', $data);
    echo view('templates/user/footer');

  }

  public function user_activate_account($id){

		//4

		if($this->userModel->approve_user_account($id)){
			 $user = $this->userModel->find($id);

						$to = $user['email'];
						$subject = 'Account Activation Link - RAAAS';
						$message = 'Hi ' .$user['first_name'].'.<br><br>'
						. 'Thank you for your registration. Your account has been created successfully. <br>'
						. 'Your <b>email</b> is set as your default <b>username</b>. <br><br>'
						. 'Please click the link below to activate your account.<br>'
						. '<a href = "'. base_url().'/admin/activateConfirm/'
						. $user['uniid'].'" target="_blank">Activate Now</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('puptraaas@gmail.com', 'RAAAS');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Activation link sent successfully.', 3);
								return redirect()->to(base_url()."/userManagement");
		  				}else{

		  					$this->session->setTempdata('error','Unable to activate the account. Please try again', 3);
							return redirect()->to(base_url()."/userManagement");

		  				}
		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/userManagement");

		  }
	}

  public function user_deactivate_account($id){


    $user = $this->userModel->find($id);
    if($this->userModel->disapprove_user_account($id)){

            $to = $user['email'];
            $subject = 'Account Activation Link - RAAAS';
            $message = 'Hi ' .$user['first_name'].'.<br><br>'
            . 'Thank you for your registration. Sorry your account has been declined. <br>'
            . 'Reason: <b>'. $this->request->getVar('reason').'.</b><br><br>'
            . 'Please click the link below to register again to RAAAS '
            . 'provided that your reason for denial is cleared. <br>'
            . '<a href = "'. base_url().'/choose_role'.'">Register</a>'
            . '<br>Thanks!';

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('puptraaas@gmail.com', 'RAAAS');
            $email->setSubject($subject);
            $email->setMessage($message);
            if($email->send()){

                $this->session->setTempdata('success','Account has been disapproved.', 3);
                return redirect()->to(base_url()."/userManagement");
              }else{

                $this->session->setTempdata('error','Unable to disapprove the account. Please try again', 3);
                return redirect()->to(base_url()."/userManagement");

              }


      }else{

        $this->session->setTempdata('error','Unable to activate the account.',3);
      return redirect()->to(base_url()."/userManagement");

      }

  }

  ///////////////////////////////////////////////student

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

    echo view('templates/user/header', $this->data);
    echo view('Modules\UserManagement\Views\studAccountV', $data);
    echo view('templates/user/footer');

  }
  public function student_activate_account($id){
		//4
		if($this->sModel->approve_user_account($id)){
			$student = $this->sModel->getStudentData($id);

						$to = $student['email'];
						$subject = 'Account Activation Link - RAAAS';
						$message = 'Hi ' .$student['first_name'].'.<br><br>'
						. 'Thank you for your registration. Your account has been created successfully. <br>'
						. 'Your <b>student number</b> is set as your default <b>username</b>. <br><br>'
						. 'Please click the link below to activate your account.<br>'
						. '<br>(This link is valid for 3 days from the time this '
						. 'account was created) <br>'
						. '<a href = "'. base_url().'/admin/activateConfirm/'
						. $student['uniid'].'" target="_blank">Activate Now</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('puptraaas@gmail.com', 'RAAAS');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Activation link sent successfully.', 3);
								return redirect()->to(base_url()."/userManagement");
		  				}else{

		  					$this->session->setTempdata('error','Unable to activate the account. Please try again', 3);
							return redirect()->to(base_url()."/userManagement");

		  				}
		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/userManagement");

		  }
	}

  public function student_deactivate_account($id){

		$student = $this->sModel->getStudentData($id);
		if($this->sModel->disapprove_user_account($id)){

			if($this->scModel->deleteStudentCourse($id)){

						$to = $student['email'];
						$subject = 'Account Activation Link - RAAAS';
						$message = 'Hi ' .$student['first_name'].'<br><br>'
						. 'Thank you for your registration. Sorry your account has been declined. <br>'
						. 'Reason: <b>'. $this->request->getVar('reason').'.</b><br><br>'
						. 'Please click the link below to register again to RAAAS '
						. 'provided that your reason for denial is cleared. <br>'
						. '<a href = "'. base_url().'/choose_role'.'">Register</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('puptraaas@gmail.com', 'RAAAS');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Account has been disapproved.', 3);
								return redirect()->to(base_url()."/userManagement");
		  				}else{

		  					$this->session->setTempdata('error','Unable to disapprove the account. Please try again', 3);
								return redirect()->to(base_url()."/userManagement");

		  				}

		  		}


		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/userManagement");

		  }

	}

  /////////////////////////////////////////////professor
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


    echo view('templates/user/header', $this->data);
    echo view('Modules\UserManagement\Views\profAccountV', $data);
    echo view('templates/user/footer');

	}

  public function professor_activate_account($id){

		//4

		if($this->pModel->approve_user_account($id)){
			 $professor = $this->pModel->find($id);

						$to = $professor['email'];
						$subject = 'Account Activation Link - RAAAS';
						$message = 'Hi ' .$professor['f_firstname'].'.<br><br>'
						. 'Thank you for your registration. Your account has been created successfully. <br>'
						. 'Your <b>faculty code</b> is set as your default <b>username</b>. <br><br>'
						. 'Please click the link below to activate your account.<br>'
						. '<a href = "'. base_url().'/admin/activateConfirm/'
						. $professor['uniid'].'" target="_blank">Activate Now</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('puptraaas@gmail.com', 'RAAAS');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Activation link sent successfully.', 3);
								return redirect()->to(base_url()."/userManagement");
		  				}else{

		  					$this->session->setTempdata('error','Unable to activate the account. Please try again', 3);
							return redirect()->to(base_url()."/userManagement");

		  				}
		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/userManagement");

		  }
	}

  public function professor_deactivate_account($id){


		$prof = $this->pModel->find($id);
		if($this->pModel->disapprove_user_account($id)){

						$to = $prof['email'];
						$subject = 'Account Activation Link - RAAAS';
						$message = 'Hi ' .$prof['f_firstname'].'.<br><br>'
						. 'Thank you for your registration. Sorry your account has been declined. <br>'
						. 'Reason: <b>'. $this->request->getVar('reason').'.</b><br><br>'
						. 'Please click the link below to register again to RAAAS '
						. 'provided that your reason for denial is cleared. <br>'
						. '<a href = "'. base_url().'/choose_role'.'">Register</a>'
						. '<br>Thanks!';

						$email = \Config\Services::email();
						$email->setTo($to);
						$email->setFrom('puptraaas@gmail.com', 'RAAAS');
						$email->setSubject($subject);
						$email->setMessage($message);
						if($email->send()){

								$this->session->setTempdata('success','Account has been disapproved.', 3);
								return redirect()->to(base_url()."/userManagement");
		  				}else{

		  					$this->session->setTempdata('error','Unable to disapprove the account. Please try again', 3);
								return redirect()->to(base_url()."/userManagement");

		  				}


		  }else{

		  	$this->session->setTempdata('error','Unable to activate the account.',3);
			return redirect()->to(base_url()."/userManagement");

		  }

	}

}//end class

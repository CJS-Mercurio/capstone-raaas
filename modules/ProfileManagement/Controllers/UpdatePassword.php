<?php

namespace Modules\ProfileManagement\Controllers;

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

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\TaskModel;

use Modules\ResearchManagement\Models\UserResearchModel;



class UpdatePassword extends BaseController{


	public function __construct(){
		$this->session = \Config\Services::session();

		$this->sModel =  new StudentModel();
	 	$this->data['author'] = $this->sModel->orderBy('id', 'DESC')->findAll();

		$this->fModel =  new FacultyModel();
	 	$this->data['faculty'] = $this->fModel->orderBy('id', 'DESC')->findAll();

	 	$this->panelModel =  new PanelModel();
	 	$this->data['panel'] = $this->panelModel->orderBy('id', 'DESC')->findAll();

		$this->scModel =  new StudentCourseModel();
	 	$this->data['student_course'] = $this->scModel->findAll();

		$this->srModel =  new StudentResearchModel();
	 	$this->data['student_research'] = $this->srModel->findAll();

    $this->userModel = new UserModel();
    $this->data['user'] = $this->userModel->findAll();

    $this->urModel = new UserResearchModel();
    $this->data['user_research'] = $this->urModel->findAll();

		$this->fileUploading =  new FileUploading();
		$this->prModel =  new PanelResearchModel();
    $this->acModel =  new AdminConfigModel();
    $this->prModel =  new PanelResearchModel();

		helper(['form']);

    $uniid = session()->get('logged_user');
    $role = $this->userModel->getLoggedInUserRole($uniid);

    $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 
    $this->data['loggedIn'] = $this->userModel->getLoggedInUserRole($uniid);
    $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);


	}
	public function index(){

		// print_r($this->data['allowed_task']);
    echo view('templates/user/header', $this->data);
    echo view('Modules\ProfileManagement\Views\EditPasswordV');
    echo view('templates/user/footer');

	}

  public function change_password(){
    $data = [];

    $uniid = session()->get('logged_user');

    $data['userdata'] = $this->userModel->getLoggedInUserData($uniid);

    if($this->request->getMethod() == 'post'){
      $rules =[
        'opwd' => 'required',
        'npwd' => 'required|min_length[8]|max_length[16]',
        'cnpwd' => 'required|matches[npwd]',

        'opwd' => [
          'rules' => 'required',
          'errors' =>[
            'required' => 'Old Password is required',
            'min_length' => 'First name must be atleast {param} characters in length',
          ],
        ],

        'npwd' => [
          'rules' => 'required|min_length[8]|max_length[16]',
          'errors' =>[
            'required' => 'New Password is required',
            'min_length' => 'New Password must be atleast {param} characters in length',
          ],
        ],

        'cnpwd' => [
          'rules' => 'required|matches[npwd]',
          'errors' =>[
            'required' => 'Confirm Password is required',
            'matches' => 'Password entered do not match',
          ],
        ],


      ];

      if($this->validate($rules)){

        $opwd = $this->request->getVar('opwd');
        $npwd = password_hash($this->request->getVar('npwd'), PASSWORD_DEFAULT);

        if(password_verify($opwd, $data['userdata']->password)){

          if($this->userModel->updatePassword($npwd, session()->get('logged_user'))){

            session()->setTempdata('success', 'Password Updated successfully', 3);
            return redirect()->to(base_url('/profile'));

          }else{
            session()->setTempdata('error', 'Unable to update the password. Try again!', 3);
            return redirect()->to(base_url('/profile'));

          }

        }else{
          session()->setTempdata('error', 'Old Password does not matched', 3);
          return redirect()->to(base_url('/profile'));
        }

      }else{
        $data['validation'] = $this->validator;
      }
    }

    echo view('templates/user/header', $this->data);
    echo view('Modules\ProfileManagement\Views\EditPasswordV', $data);
    echo view('templates/user/footer');

  }


}

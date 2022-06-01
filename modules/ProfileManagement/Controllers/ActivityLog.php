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
use Modules\ProfileManagement\Models\ActivityLogModel;

class ActivityLog extends BaseController{


	public function __construct(){
		$this->session = \Config\Services::session();


    $this->userModel = new UserModel();
    $this->data['user'] = $this->userModel->findAll();

		$this->alModel =  new ActivityLogModel();
		$this->data['act_log'] = $this->alModel->findAll();

		helper(['form']);

   
	}

	public function index(){
		$uniid = session()->get('logged_user');
		$user = $this->userModel->getLoggedInUserRole($uniid);

		$data['activity'] = $this->alModel->activityLog();

		// print_r($data['activity']);
		// die();

		echo view('Modules\SuperAdmin\Views\templates\header');
    echo view('Modules\ProfileManagement\Views\activityLogV', $data);
		echo view('Modules\SuperAdmin\Views\templates\footer');


	}

	public function activity_log_detail($id=null){

		$data['activity'] = $this->alModel->activityLogDetail($id);

		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\ProfileManagement\Views\activityLogDetail', $data);
		echo view('Modules\SuperAdmin\Views\templates\footer');


	}


}

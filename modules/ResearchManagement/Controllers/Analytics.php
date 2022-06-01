<?php

namespace Modules\ResearchManagement\Controllers;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\PanelModel;

use Modules\Admin\Models\AdminConfigModel;
use Modules\Student\Models\StudentModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\ResearchModel;

use Modules\Professor\Models\ProfessorModel;

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\RoleModel;

use TablesIgniter\Src\TablesIgniter;

use App\Controllers\BaseController;


class Analytics extends BaseController{

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
      $this->rModel = new ResearchModel();

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

		$this->adminConfigModel = new AdminConfigModel();
		$this->data['ad_config'] = $this->adminConfigModel->findAll();

		$sy_cd =  $this->adminConfigModel->getsy_cd();

		$data1['views'] = $this->rModel->countView($sy_cd['archive_year']);
		$data2['downloads'] = $this->rModel->countCite($sy_cd['archive_year']);
		$data3['category'] = $this->rModel->countCategory($sy_cd['archive_year']);

		$data = array_merge($data1, $data2, $data3);

		echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Analytics\AnalyticsV', $data);
    echo view('templates/user/footer2');

	}
}

<?php

namespace Modules\Admin\Controllers;
use App\Controllers\BaseController;

use Modules\Professor\Models\ProfessorModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\PanelModel;
use Modules\Admin\Models\PaperTypeModel;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\PanelResearchModel;
use Modules\Student\Controllers\FileUploading;

use Modules\Professor\Models\ProfessorResearchModel;

use Modules\SuperAdmin\Models\UserModel;


class AdminHome extends BaseController{

	public $data = [];
	public function __construct(){

		$this->session = \Config\Services::session();
		$this->adminConfigModel = new AdminConfigModel();
		$this->data['ad_config'] = $this->adminConfigModel->findAll();

		$sy_cd =  $this->adminConfigModel->getsy_cd();

		$this->rModel =  new ResearchModel();
		$this->data['research'] = $this->rModel->getLatestResearch($sy_cd['archive_year']);

		$this->pModel =  new ProfessorModel();
		$this->data['author'] = $this->pModel->orderBy('id', 'DESC')->findAll();

		$this->userModel =  new UserModel();
		$this->data['user'] = $this->userModel->orderBy('id', 'DESC')->findAll();

		$this->fModel =  new FacultyModel();
	 	$this->data['faculty'] = $this->fModel->orderBy('id', 'DESC')->findAll();

	 	$this->panelModel =  new PanelModel();
	 	$this->data['panel'] = $this->panelModel->orderBy('id', 'DESC')->findAll();

		$this->scModel =  new StudentCourseModel();
	 	$this->data['student_course'] = $this->scModel->findAll();

		$this->srModel =  new StudentResearchModel();
	 	$this->data['student_research'] = $this->srModel->findAll();

	 	$this->paperTypeModel = new PaperTypeModel();
	 	$this->data['paper_type'] = $this->paperTypeModel->findAll();

		$this->cModel =  new CourseModel();
		$this->fileUploading =  new FileUploading();
		$this->prModel =  new PanelResearchModel();
		$this->rpModel =  new ProfessorResearchModel();

		$uniid = session()->get('logged_user');
		$role = $this->userModel->getLoggedInUserRole($uniid);
		$this->data['allowed_task'] = $this->userModel->getUserPermission($role['role_id']);

	}

	public function index(){
		// print_r($this->data['allowed_task']);

		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\adminHomeV', $this->data);
		echo view('Modules\Admin\Views\templates\footer');

	}

	public function pending_researches(){
		$data = [];

		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\adminPendingV', $this->data);
		echo view('Modules\Admin\Views\templates\footer');

	}

	public function get_student_research(){

		$data['stud_research'] = $this->srModel->getResearchOfStudent();

		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\studentResearchV', $data);
		echo view('Modules\Admin\Views\templates\footer');
	}

	public function get_professor_research(){

		$data['prof_research'] = $this->rpModel->getResearchOfProf();

		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\professorResearchV', $data);
		echo view('Modules\Admin\Views\templates\footer');
	}


}

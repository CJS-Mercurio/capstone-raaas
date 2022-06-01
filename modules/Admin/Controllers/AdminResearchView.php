<?php

namespace Modules\Admin\Controllers;

use App\Controllers\BaseController;
use Modules\Student\Models\StudentModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\CourseModel;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\PanelResearchModel;

use Modules\Professor\Models\ProfessorResearchModel;

use Modules\SuperAdmin\Models\UserModel;




class AdminResearchView extends BaseController{


	// public $rid = [];
	public $data = [];
	public $rModel;
	public $response;

	function __construct()
	{


		helper(['form']);
		$this->data['validation'] = null;


		$this->session = \Config\Services::session();

		$this->rModel =  new ResearchModel();
	 	$this->data['research'] = $this->rModel->orderBy('id', 'DESC')->findAll();

		$this->userModel =  new UserModel();
		$this->data['user'] = $this->userModel->orderBy('id', 'DESC')->findAll();

		$this->sModel =  new StudentModel();
	 	$this->data['author'] = $this->sModel->orderBy('id', 'DESC')->findAll();

		$this->fModel =  new FacultyModel();
	 	$this->data['panel'] = $this->fModel->orderBy('id', 'DESC')->findAll();

		$this->scModel =  new StudentCourseModel();
	 	$this->data['student_course'] = $this->scModel->findAll();

		$this->srModel =  new StudentResearchModel();
	 	$this->data['student_research'] = $this->srModel->findAll();

		$this->acModel =  new AdminConfigModel();
		$this->cModel =  new CourseModel();
		$this->prModel =  new PanelResearchModel();
		$this->rpModel =  new ProfessorResearchModel();

		$this->data['allowed_task'] = $this->userModel->getUserPermission(1);


	}


	public function view_research($id=null){

		$data['panels'] = $this->prModel->getResearchPanelist($id);
		$data1['students'] = $this->srModel->getResearchAuthors($id);
		$data2['profs'] = $this->rpModel->getResearchAuthors($id);
		$data3['research'] = $this->rModel->find($id);

		$research = array_merge($data, $data1, $data2, $data3);

		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\adminResearchV', $research);
		echo view('Modules\Admin\Views\templates\footer');

	}


	public function approve_research($id=null){

		if($this->rModel->approveResearch($id)){

			session()->setTempdata('approved','Research is approved.', 3);
			return redirect()->to(base_url()."/admin/pending");
		}
	}

	public function disapprove_research($id=null){


		if($this->request->getMethod() == 'post'){

				$reason = $this->request->getVar('reason');
				echo $reason;
		}


		// $this->data['validation'] = null;

		// $rules = [

		// 	'reason' => [
		// 			'rules' => 'required',
		// 			'errors' =>[
		// 				'required' => 'Reason for denial is required',
		// 			],
		// 		],
		// 	];

		// if($this->validate($rules)){
		// 	if($this->request->getMethod() == 'post'){

		// 		$reason = $this->request->getVar('reason');
		// 		if($this->rModel->disapproveResearch($id, $reason)){
		// 			session()->setTempdata('disapproved','Research is disapproved.', 3);
		// 			return redirect()->to(base_url()."/admin/pending");


		// 		}else{
		// 			session()->setTempdata('notDisapproved','Research status is not disapproved.', 3);
		// 			return redirect()->to(base_url()."/admin/pending");


		// 		}

		// 	}
		// }else{

		// 	$this->data['validation'] = $this->validator;
		// }


		// $data['panels'] = $this->prModel->getResearchPanelist($id);
		// $data1['authors'] = $this->srModel->getResearchAuthors($id);
		// $data2['research'] = $this->rModel->find($id);

		// $research = array_merge($data, $data1, $data2);

		// echo view('Modules\Admin\Views\templates\header');
		// echo view('Modules\Admin\Views\adminResearchV', $research, $this->data);
		// echo view('Modules\Admin\Views\templates\footer');
	}



	public function download_research_softcopy($file){
			helper(['download']);
			$name = $file;
			$research = $this->rModel->find($name);

			return $this->response->download('public/researches/'. $research['file'], null);
    		// redirect(base_url().'/student/editResearch','refresh');

	}

	public function submit_research_again($id=null){

			if($this->request->getMethod() == 'post'){

					if($this->rModel->updateResearchStatus($id)){

							$data['panels'] = $this->prModel->getResearchPanelist($id);
							$data1['authors'] = $this->srModel->getResearchAuthors($id);
							$data2['research'] = $this->rModel->find($id);
					}
			}

			$research = array_merge($data, $data1, $data2);

			echo view('Modules\Admin\Views\templates\header', $this->data);
			echo view('Modules\Admin\Views\adminResearchV', $research, $this->data);
			echo view('Modules\Admin\Views\templates\footer');


	}

}

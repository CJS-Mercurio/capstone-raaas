<?php

namespace Modules\Student\Controllers;

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

use Modules\Professor\Models\ProfessorResearchModel;

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\TaskModel;



class ResearchView extends BaseController{


	// public $rid = [];
	public $data = [];
	public $rModel;
	public $response;

	function __construct()
	{
		helper(['form']);
		$this->data['validation'] = null;


		$this->session = \Config\Services::session();

		$this->userModel =  new UserModel();
		$this->taskModel =  new TaskModel();

		$this->rModel =  new ResearchModel();
	 	$this->data['research'] = $this->rModel->orderBy('id', 'DESC')->findAll();


		$this->sModel =  new StudentModel();
	 	$this->data['author'] = $this->sModel->orderBy('id', 'DESC')->findAll();

		$this->fModel =  new FacultyModel();
	 	$this->data['panel'] = $this->fModel->orderBy('id', 'DESC')->findAll();

	 	$this->panelModel =  new PanelModel();

		$this->scModel =  new StudentCourseModel();
	 	$this->data['student_course'] = $this->scModel->findAll();

		$this->srModel =  new StudentResearchModel();
	 	$this->data['student_research'] = $this->srModel->findAll();

		$this->acModel =  new AdminConfigModel();
		$this->cModel =  new CourseModel();
		$this->fileUploading =  new FileUploading();
		$this->prModel =  new PanelResearchModel();
		$this->rpModel = new ProfessorResearchModel();

		$uniid = session()->get('logged_user');
		$role = $this->sModel->getLoggedInUserRole($uniid);

		$this->data['allowed_task'] = $this->taskModel->getUserPermission($role['role_id']);


	}


	public function view_research($id=null){

		$this->data['validation'] = null;

		 $data['panels'] = $this->prModel->getResearchPanelist($id);
		 $data1['authors'] = $this->srModel->getResearchAuthors($id);
		 $data2['research'] = $this->rModel->find($id);

		 $research = array_merge($data, $data1, $data2);

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentResearchV', $research);
		echo view('Modules\Student\Views\templates\student_footer');
	}


	public function edit_research($id=null){

		$this->data['validation'] = null;

		$rules = [

			'uploadFile' => 'ext_in[uploadFile,zip,pdf]',

			'uploadFile' => [
					'rules' => 'uploaded[uploadFile]|ext_in[uploadFile,zip,pdf]',
					'errors' =>[
						'ext_in' => 'Invalid file extension. Try again.',
					],
				],
		];

		 $data['panel'] = $this->panelModel->orderBy('id', 'DESC')->findAll();
		 $data1['authors'] = $this->srModel->getResearchAuthors($id);
		 $data2['research'] = $this->rModel->find($id);

		 $data3['author'] = $this->sModel->orderBy('id', 'DESC')->findAll();
	 	 $data4['adviser'] = $this->fModel->orderBy('id', 'DESC')->findAll();

	 	 if($this->request->getMethod() == 'post'){
	 	 	$newdata = [
	 	 			'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
					'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
					'keywords' => $this->request->getVar('keyword', FILTER_SANITIZE_STRING),
					'adviser' => $this->request->getVar('adviser'),
					'defense_date' => $this->request->getVar('defense_date'),
					'date_submitted' => $this->request->getVar('date_submitted'),
	 	 	];

	 	 		$selectedAuthors = $this->request->getVar('selectedAuthors');
				$selectedPanelist = $this->request->getVar('selectedPanelist');
				$file = $this->request->getFile('uploadFile');


	 	 		if($this->rModel->update($id, $newdata) ===  true){

	 	 			$student_id =  $this->sModel->getStudentId(session()->get('logged_user'));
					$course_id = $this->scModel->getStudentCourseId($student_id['id']);
					$courseId = $course_id['course_id'];

						if(!empty($selectedAuthors)){
						     if($this->srModel->deleteStudentResearch($id)){

						     	foreach ($selectedAuthors as $author){
									 	$student_research_data = [
											'research_id' =>$id,
											'author_id' => $author,
										];

							    $this->srModel->createStudentResearch($student_research_data);
										// if($this->srModel->createStudentResearch($student_research_data)){

										// echo "tama";

										// }else{
										// 	echo "mali";
										// }
						     	 }
						     }
						 }

						 if(!empty($selectedPanelist)){

						    if($this->prModel->deleteResearchPanelist($id)){
						     	 foreach ($selectedPanelist as $panel){
						         	$research_panel_data = [
									'research_id' =>$id,
									'panel_id' => $panel,
								];

						         $this->prModel->createResearchPanelist($research_panel_data);
						     	 }
						     }
						}

					if($this->validate($rules)){
						if($file->isValid() && !$file->hasMoved()){

							if($file->move(FCPATH.'public/researches', $file->getName())){

								$path = base_url().'/public/researches/' .$file->getName();
								$filename = $file->getName();


								$status = $this->rModel->updateFile($filename, $id);

								if($status == true){

									$this->session->setTempdata('tama','Research File uploaded successfully.', 3);

								}//status
								else{
									$this->session->setTempdata('mali','Research File not uploaded. Try again.', 3);
								}

							}//fcpath
							else{
								$this->session->setTempdata('mali', 'You have uploaded an invalid file', 3);
							}

						}//isValid
					}


						session()->setTempdata('success','Research updated successfully.', 3);
						return redirect()->to(base_url()."/student/view_research/".$id);
	 	 		}//rModel
	 	 		else{

						session()->setTempdata('error','Research not updated. Try again.', 3);

	 	 		}



	 	 }//post



		$research = array_merge($data, $data1, $data2, $data3, $data4);

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentEditResearchV', $research);
		echo view('Modules\Student\Views\templates\student_footer');

}

	public function edit_add_panelist($id=null){

		$this->data['validation'] = null;

		if($this->request->getMethod() == 'post'){
				$rules = [

				'firstname' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'Firstname is required',
						'min_length' => 'Firstname should atleast have {param} characters',

					],
				],


				'lastname' => [
					'rules' => 'required|min_length[2]',
					'errors' =>[
						'required' => 'Abstract is required',
						'min_length' => 'Lastname should atleast have {param} characters',
					],
				],


			];


				if($this->validate($rules)){
					$panelData = [
						'f_firstname' => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
						'f_lastname' => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),
						'occupation' => $this->request->getVar('company', FILTER_SANITIZE_STRING),
						'position' => $this->request->getVar('position', FILTER_SANITIZE_STRING),

					];

					if($this->panelModel->save($panelData) === true) {
						session()->setTempdata('successPanel', 'Panel added successfully', 2);
						return redirect()->to(base_url('/student/editResearch'. $id));

					}
					else{
						session()->setTempdata('successPanel', 'Panel added successfully', 2);


					}


				}//validation
				else{

					  $this->data['validation'] = $this->validator;

					}


			}//post

		// $this->upload_reseach_view();

	}


	public function delete_research($id=null){

		if($this->request->getMethod() == 'post'){

			if($this->rModel->where('id', $id)->delete()){

				if($this->srModel->where('research_id', $id)->delete()){

					$this->session->setTempdata('deleted', 'Research deleted successfully', 3);
					return redirect()->to(base_url()."/student/manage");
				}
			}

		}
		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentResearchV', ['research' => $this->rModel->find($id)]);
		echo view('Modules\Student\Views\templates\student_footer');
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

					$this->rModel->updateResearchStatus($id);

			}

			$data['panels'] = $this->prModel->getResearchPanelist($id);
			$data1['authors'] = $this->srModel->getResearchAuthors($id);
			$data2['research'] = $this->rModel->find($id);


			$research = array_merge($data, $data1, $data2);

			echo view('Modules\Student\Views\templates\student_header', $this->data);
			echo view('Modules\Student\Views\studentResearchV', $research);
			echo view('Modules\Student\Views\templates\student_footer');


	}

	public function get_student_research(){

		$data['stud_research'] = $this->srModel->getResearchOfStudent();

		// $data['stud_research'] = $this->rModel->find($id);

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\sResearchV', $data);
		echo view('Modules\Student\Views\templates\student_footer');
	}

	public function get_professor_research(){

		$data['prof_research'] = $this->rpModel->getResearchOfProf();

		// $data['stud_research'] = $this->rModel->find($id);

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\professorResearchV', $data);
		echo view('Modules\Student\Views\templates\student_footer');
	}

}

<?php

namespace Modules\Professor\Controllers;

use App\Controllers\BaseController;
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
use Modules\Professor\Models\ProfessorModel;



class ProfessorHome extends BaseController{

	public $pModel;
	public function __construct(){

		$this->session = \Config\Services::session();

		$this->pModel =  new ProfessorModel();
		$this->data['author'] = $this->pModel->orderBy('id', 'DESC')->findAll();

    $this->acModel = new AdminConfigModel();
    $this->data['ad_config'] = $this->acModel->findAll();

    $sy_cd =  $this->acModel->getsy_cd();

    $this->rModel =  new ResearchModel();
    $this->data['research'] = $this->rModel->getLatestResearch($sy_cd['archive_year']);

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


	}

	public function index(){

		$uniid = session()->get('logged_user');
		$data['userdata'] = $this->pModel->getLoggedInUserData($uniid);

		echo view('Modules\Professor\Views\templates\professor_header', $data);
		echo view('Modules\Professor\Views\professorHomeV', $this->data);
		echo view('Modules\Professor\Views\templates\professor_footer');

	}

	public function professor_profile(){

		$data = [];

		$uniid = session()->get('logged_user');

		$data['userdata'] = $this->pModel->getLoggedInUserData($uniid);

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

					if($this->pModel->updatePassword($npwd, session()->get('logged_user'))){

						session()->setTempdata('success', 'Password Updated successfully', 3);
						return redirect()->to(base_url('/professor/profile'));

					}else{
						session()->setTempdata('error', 'Unable to update the password. Try again!', 3);
						return redirect()->to(base_url('/professor/profile'));

					}

				}else{
					session()->setTempdata('error', 'Old Password does not matched', 3);
					return redirect()->to(base_url('/professor/profile'));
				}



			}else{
				$data['validation'] = $this->validator;
			}
		}

		echo view('Modules\Professor\Views\templates\professor_header', $data);
		echo view('Modules\Professor\Views\professorProfileV', $data);
		echo view('Modules\Professor\Views\templates\professor_footer');
	}


	public function view_research($id=null){


		$data['panels'] = $this->prModel->getResearchPanelist($id);
		$data1['authors'] = $this->rpModel->getResearchAuthors($id);
		$data2['research'] = $this->rModel->find($id);

		$research = array_merge($data, $data1, $data2);
		session()->setTempdata('success','Research updated successfully.', 3);

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\researchV', $research);
		echo view('Modules\Professor\Views\templates\professor_footer');
	}

		public function view_research2($id=null){


			$data['panels'] = $this->prModel->getResearchPanelist($id);
	  		$data1['students'] = $this->srModel->getResearchAuthors($id);
	  		$data2['profs'] = $this->rpModel->getResearchAuthors($id);
	  		$data4['user'] = $this->urModel->getResearchAuthors($id);
	  		$data3['research'] = $this->rModel->find($id);

	  		$research = array_merge($data, $data1, $data2, $data3, $data4);

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\researchV2', $research);
		echo view('Modules\Professor\Views\templates\professor_footer');
	}


	public function manage_research(){

		$prof_id = $this->pModel->getProfId(session()->get('logged_user'));
		$data['prof_research'] = $this->rpModel->getResearchDetails($prof_id['id']);

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorManageV', $data);
		echo view('Modules\Professor\Views\templates\professor_footer');
	}


	public function upload_research(){

		$this->data['validation'] = null;

		if($this->request->getMethod() == 'post'){
			$rules = [

				'title' => [
					'rules' => 'required|is_unique[research.title]',
					'errors' =>[
						'required' => 'Title is required',
						'is_unique' => 'Research Title already in the Database',
					],
				],


				'paper_type' => [
				'rules' => 'required',
				'errors' =>[
						'required' => 'Paper type required',

					],

				],


				'abstract' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Abstract is required',
					],
				],

				'keyword' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Keyword is required',
					],
				],

				'selectedAuthors' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Authors is required',
					],
				],

				'date_submitted' => [
					'rules' => 'required|regex_match[^(19|20)\d\d[-.](0[1-9]|1[012])[-.](0[1-9]|[12][0-9]|3[01])$]',
					'errors' => [
						'required' => 'Date submitted is required',
						'regex_match' => 'Date submitted field format is incorrect',
						// 'is_unique' => 'Student number already exist',
					],
				],

				'uploadFile' => [
					'rules' => 'uploaded[uploadFile]|ext_in[uploadFile,zip,wpd,pdf]',
					'errors' =>[
						'uploaded' => 'Upload a file (.zip, .wpd, .pdf).',
						'ext_in' => 'Invalid file extension. Try again.',
					],
				],

			];

			$abstract = $this->request->getVar('abstract', FILTER_SANITIZE_STRING);
			$count = str_word_count($abstract);

			if($this->validate($rules)){

				$sy_cd =  $this->acModel->getsy_cd();
				$uniid = session()->get('logged_user');

				if($count >= 300 && $count <= 350){

					$file = $this->request->getFile('uploadFile');
					if($file->isValid() && !$file->hasMoved()){

						if($file->move(FCPATH.'public/researches', $file->getName())){
							$filename = $file->getName();


							$research_status = 0;
							$research_data = [
								'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
								'paper_type' => $this->request->getVar('paper_type'),
								'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
								'keywords' => $this->request->getVar('keyword', FILTER_SANITIZE_STRING),
								'school_year' => $sy_cd['school_year'],
								'file' => $filename,
								'adviser' => $this->request->getVar('adviser'),
								'research_status' => $research_status,
								'defense_date' => $this->request->getVar('defense_date'),
								'date_submitted' => $this->request->getVar('date_submitted'),
								'course_id' => 0,

							];
						}//move
						else{
							$this->session->setTempdata('mali', 'You have uploaded an invalid file', 3);
						}
					}//isValid

				$selectedAuthors = $this->request->getVar('selectedAuthors');
			    $selectedPanelist = $this->request->getVar('selectedPanelist');
				$title = $research_data['title'];

			    if($this->rModel->save($research_data)){


			    	$research_id = $this->rModel->getResearchId($title);

			    	foreach($selectedAuthors as $author){

			    		$author_research_data = [

			    			'research_id' => $research_id['id'],
			    			'author_id' => $author,
			    		];

			    		$this->rpModel->createProfessorResearch($author_research_data);

			    	}

			    	if($selectedPanelist != null){

			    		foreach($selectedPanelist as $panel){

				    		$research_panel_data = [
				    			'research_id' => $research_id['id'],
				    			'panel_id' => $panel,
				    		];

				    		$this->prModel->createResearchPanelist($research_panel_data);
			    		}
			    	}



			    	return redirect()->to(base_url('/professor/after_upload'));


				    }else{

				    	$this->session->setTempdata('error','Sorry! Unable to upload research. Try again', 3);
						return redirect()->to(base_url('/professor/upload'));
				    }

				}//count
				else{
					$this->session->setTempdata('errorAbs','Number of words in Abstract does not meet it\'s requirement. Minimum word is 300, maximum is 350', 3);

				}




			}else{
				$this->data['validation'] = $this->validator;
			}

		}//post

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorUploadV', $this->data);
		echo view('Modules\Professor\Views\templates\professor_footer');

	}


	public function addPanelist(){

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
						return redirect()->to(base_url('/professor/upload'));

					}
					else{
						session()->setTempdata('errorPanel', 'Panel not added', 2);

					}


				}//validation
				else{

					  $this->data['validation'] = $this->validator;

					}


			}//post

		$this->upload_research_view();

	}

	public function addPanelistEdit($id=null){

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
						return redirect()->to(base_url('/professor/edit_prof_res/'.$id));

					}
					else{
						session()->setTempdata('errorPanel', 'Panel not added', 2);

					}


				}//validation
				else{

					  $this->data['validation'] = $this->validator;

					}


			}//post

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorEditResearchV', $research);
		echo view('Modules\Professor\Views\templates\professor_footer');

	}

	public function after_upload() {
		$prof_id = $this->pModel->getProfId(session()->get('logged_user'));
		$data['prof_research'] = $this->rpModel->getResearchDetails($prof_id['id']);

		$this->session->setTempdata('success', 'Research created Successfully.', 3);

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorManageV', $data);
		echo view('Modules\Professor\Views\templates\professor_footer');
	}


	public function upload_research_view(){

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorUploadV', $this->data);
		echo view('Modules\Professor\Views\templates\professor_footer');
	}



	public function delete_research($id=null){

		if($this->request->getMethod() == 'post'){

			if($this->rModel->where('id', $id)->delete()){

				if($this->rpModel->where('research_id', $id)->delete()){

					$this->session->setTempdata('deleted', 'Research deleted successfully', 3);
					return redirect()->to(base_url()."/professor/manage");

				}

			}

		}
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
		 $data1['authors'] = $this->rpModel->getResearchAuthors($id);
		 $data2['research'] = $this->rModel->find($id);

		 $data3['author'] = $this->pModel->orderBy('id', 'DESC')->findAll();
	 	 $data4['adviser'] = $this->fModel->orderBy('id', 'DESC')->findAll();


	 	 if($this->request->getMethod() == 'post'){
	 	 	$newdata = [
	 	 			'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
					'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
					'keywords' => $this->request->getVar('keyword', FILTER_SANITIZE_STRING),
					'defense_date' => $this->request->getVar('defense_date'),
					'adviser' => $this->request->getVar('adviser'),
					'date_submitted' => $this->request->getVar('date_submitted'),
	 	 	];

	 	 	$selectedAuthors = $this->request->getVar('selectedAuthors');
			$selectedPanelist = $this->request->getVar('selectedPanelist');
			$file = $this->request->getFile('uploadFile');



	 	 		if($this->rModel->update($id, $newdata) ===  true){

	 	 			$prof_id =  $this->pModel->getProfId(session()->get('logged_user'));

						if(!empty($selectedAuthors)){
						     if($this->rpModel->deleteStudentResearch($id)){

						     	foreach ($selectedAuthors as $author){
							 	$professor_research_data = [
									'research_id' =>$id,
									'author_id' => $author,
								];

							    $this->rpModel->createProfessorResearch($author_research_data);
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
						}else{
							session()->setTempdata('success','Research 	updated successfully.', 3);
							$this->data['validation'] = $this->validator;
						}

						return redirect()->to(base_url()."/professor/view_research/".$id);

	 	 		}//rModel
	 	 		else{

						session()->setTempdata('error','Research not updated. Try again.', 3);

	 	 		}

	 	 }//post



		 $research = array_merge($data, $data1, $data2, $data3, $data4);


		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorEditResearchV', $research);
		echo view('Modules\Professor\Views\templates\professor_footer');
	}


}

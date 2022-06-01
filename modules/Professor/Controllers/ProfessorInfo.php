<?php

namespace Modules\Professor\Controllers;

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

use Modules\Professor\Models\ProfessorSeminarModel;
use Modules\Professor\Models\ProfessorModel;
use Modules\Professor\Models\PublishedResearchModel;


use Modules\Student\Controllers\FileUploading;



class ProfessorInfo extends BaseController{


	public $data = [], $session, $pResearch;

	public function __construct(){

		helper("form");

		$this->data['validation'] = null;
		$this->session = \Config\Services::session();

		$this->pModel =  new ProfessorModel();
	 	$this->psModel = new ProfessorSeminarModel();
	 	$this->pResearch = new PublishedResearchModel();

	 	$professor = $this->pModel->getProfId(session()->get('logged_user'));
		$id = $professor['id'];

		$this->data['professor'] = $this->pModel->find($id);
		$this->data['p_seminar'] = $this->psModel->getProfSeminar($id);

	 

		
	 }


	public function index(){
		$professor = $this->pModel->getProfId(session()->get('logged_user'));
		$id = $professor['id'];

		$data1['professor'] = $this->pModel->find($id);
		$data2['p_seminar'] = $this->psModel->getProfSeminar($id);
		$data3['validation'] = null;
		$data4['p_research'] = $this->pResearch->getPubResearch($id);

		// print_r($data4['p_research']);

		$this->data = array_merge($data1, $data2, $data3, $data4);

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorInfoV', $this->data);
		echo view('Modules\Professor\Views\templates\professor_footer');

	}

	public function add_seminar($id=null){

		$this->data['validation'] = null;

		$rules = [

			'title' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Course Title is required',
					],
				],

			'venue' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Course Title is required',
					],
				],

			'date' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Course Title is required',
					],
				],

		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){
			
				$data = [

					'seminar_title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
					'sponsor' => $this->request->getVar('sponsor', FILTER_SANITIZE_STRING),
					'venue' => $this->request->getVar('venue'),
					'event_date' => $this->request->getVar('date'),
					'professor_id' => $id,

				];


				if($this->psModel->save($data) === true){

					session()->setTempdata('successSeminar', 'Seminar added successfully', 2);
						return redirect()->to(base_url('/professor/infoSheet'));
				
				}else{

					session()->setTempdata('errorSeminar', 'Seminar failed to add. Try again.', 2);
						return redirect()->to(base_url('/professor/infoSheet'));

				}

			}else{

				$data3['validation'] = $this->validator;

			}

		}

		$professor = $this->pModel->getProfId(session()->get('logged_user'));
		$id = $professor['id'];

		$data1['professor'] = $this->pModel->find($id);
		$data2['p_seminar'] = $this->psModel->getProfSeminar($id);
		$data4['p_research'] = $this->pResearch->getPubResearch($id);

		$this->data = array_merge($data1, $data2, $data3, $data4);

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorInfoV', $this->data);
		echo view('Modules\Professor\Views\templates\professor_footer');

	}//end func



	public function add_published_research($id=null){

		$this->data['validation'] = null;

		$rules = [

			'research_title' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Title is required',
					],
				],

			'publication' => [
				'rules' => 'required',
					'errors' =>[
						'required' => ' Title is required',
					],
				],

			'volume' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Course Title is required',
					],
				],


			'institute' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Course Title is required',
					],
				],

			'date_published' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Course Title is required',
					],
				],


		];


		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){
			
				
				$data = [

					'research_title' => $this->request->getVar('research_title', FILTER_SANITIZE_STRING),
					'publication' => $this->request->getVar('publication', FILTER_SANITIZE_STRING),
					'volume' => $this->request->getVar('volume'),
					'institute' => $this->request->getVar('institute'),
					'event_date' => $this->request->getVar('date_published'),
					'professor_id' => $id,

				];

				if($this->pResearch->save($data) === true){

					session()->setTempdata('successResearch', 'Research added successfully', 2);
					return redirect()->to(base_url('/professor/infoSheet'));

					
				
				}else{

					session()->setTempdata('errorResearch', 'Research failed to add. Try again.', 2);
					return redirect()->to(base_url('/professor/infoSheet'));
					
				}


			}else{

				$data3['validation'] = $this->validator;

			}

		}

		$professor = $this->pModel->getProfId(session()->get('logged_user'));
		$id = $professor['id'];

		$data1['professor'] = $this->pModel->find($id);
		$data2['p_seminar'] = $this->psModel->getProfSeminar($id);
		$data4['p_research'] = $this->pResearch->getPubResearch($id);

		$this->data = array_merge($data1, $data2, $data3, $data4);

		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorInfoV', $this->data);
		echo view('Modules\Professor\Views\templates\professor_footer');

		

	}

	

	public function delete_seminar($id){


			if($this->psModel->where('id', $id)->delete()){

					$this->session->setTempdata('deleted', 'Seminar deleted successfully', 3);
					return redirect()->to(base_url('/professor/infoSheet'));
		}

	}

	public function delete_pResearch($id){


			if($this->pResearch->where('id', $id)->delete()){

				$this->session->setTempdata('deletedPub', 'Research deleted successfully', 3);
				return redirect()->to(base_url('/professor/infoSheet'));
					
			}


	}



}




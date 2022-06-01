<?php 
 
namespace Modules\Professor\Controllers;

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


class ResearchFilter extends BaseController{


		public function __construct(){

		$this->session = \Config\Services::session();

		$this->pModel =  new ProfessorModel();
		$this->data['author'] = $this->pModel->orderBy('id', 'DESC')->findAll();

		$this->rModel =  new ResearchModel();
	 	$this->data['research'] = $this->rModel->orderBy('id', 'DESC')->findAll();

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

	 	$this->acModel =  new AdminConfigModel();
		$this->cModel =  new CourseModel();
		$this->fileUploading =  new FileUploading();
		$this->prModel =  new PanelResearchModel();
		$this->rpModel =  new ProfessorResearchModel();


	}


	public function get_student_research(){

		$data['stud_research'] = $this->srModel->getResearchOfStudent();


		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\studentResearchV', $data);
		echo view('Modules\Professor\Views\templates\professor_footer');
	}

	public function get_professor_research(){

		$data['prof_research'] = $this->rpModel->getResearchOfProf();


		echo view('Modules\Professor\Views\templates\professor_header');
		echo view('Modules\Professor\Views\professorResearchV', $data);
		echo view('Modules\Professor\Views\templates\professor_footer');
	}

	public function submit_research_again($id=null){

			if($this->request->getMethod() == 'post'){

					$this->rModel->updateResearchStatus($id);

			}

			$data['panels'] = $this->prModel->getResearchPanelist($id);
			$data1['authors'] = $this->rpModel->getResearchAuthors($id);
			$data2['research'] = $this->rModel->find($id);


			$research = array_merge($data, $data1, $data2);

			echo view('Modules\Professor\Views\templates\professor_header');
			echo view('Modules\Professor\Views\researchV', $research);
			echo view('Modules\Professor\Views\templates\professor_footer');


	}

}
<?php

namespace App\Controllers;
use \CodeIgniter\Controller;
use App\Models\RegisterStudentModel;
use App\Models\RegisterProfessorModel;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\StudentModel;

use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\PanelResearchModel;
use Modules\Student\Models\ResearchModel;



/**
 * 
 */
class Guest extends controller
{
	
	
	public $srModel, $prModel, $rModel;

	function __construct()
	{
		$this->srModel =  new StudentResearchModel();
		$this->prModel =  new PanelResearchModel();
		$this->rModel =  new ResearchModel();

	}

	public function guest_view($id=null){

		$this->data['validation'] = null;


		$data['panels'] = $this->prModel->getResearchPanelist($id);
		$data1['authors'] = $this->srModel->getResearchAuthors($id);
		$data3['research'] = $this->rModel->find($id);

		$research = array_merge($data, $data1, $data3);


		echo view('templates\header');
		echo view('research_guest_view', $research);
		echo view('templates\footer');
	}
}
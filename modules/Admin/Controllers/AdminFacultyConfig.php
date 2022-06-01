<?php

namespace Modules\Admin\Controllers;

use App\Controllers\BaseController;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\CourseModel;



class AdminFacultyConfig extends BaseController{

	public $facultyModel;
	public $courseModel;

	public function __construct(){

			helper("form");
			$this->facultyModel = new FacultyModel();

		}


	public function addFaculty(){


	}

	public function viewFaculty(){


	}

	public function editFaculty($id=null){


	}
	public function delete_faculty($id=null){

		if($this->request->getMethod() == 'post'){

			if($this->facultyModel->where('id', $id)->delete()){
				return redirect()->to(base_url()."/admin/config");

			}else{
				echo "malli";
			}

		}

	}

}

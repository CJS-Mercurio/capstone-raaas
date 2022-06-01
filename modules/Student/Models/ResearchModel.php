<?php

namespace Modules\Student\Models;
// use Modules\Student\Models\StudentResearchModel;


/**
 *
 */
class ResearchModel extends \CodeIgniter\Model{


	protected $table = 'document';
	protected $primaryKey = 'id';
	protected $allowedFields = ['title', 'file', 'full_paper', 'copyright', 'privacy', 'abstract', 'keywords', 'school_year', 'adviser', 'defense_date', 'date_submitted', 'director', 'reason_for_denial', 'research_status', 'course_id', 'category id', 'document_type_id', 'category_id', 'views', 'slugs' ,'downloads'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

	public function createResearch($data){

		$builder = $this->db->table('document');
		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}
	}


	public function getResearch($id){
		//
		// 		SELECT
		//     document.title,
		//     faculty_adviser.first_name,
		//     course.course_name
		// FROM
		//     `document`
		// INNER JOIN faculty_adviser ON faculty_adviser.id = document.adviser
		// INNER JOIN course ON document.course_id = course.id
		// WHERE
		//     document.id = 16

		$builder = $this->db->table('document');
		$builder->select("document.category_id, document.id as did, document.views, document.privacy, document.copyright, document.title, document.keywords, document.school_year, document.adviser, document.defense_date, document.full_paper, document.date_submitted, document.director, document.abstract, document.reason_for_denial, document.research_status, document.file, document.full_paper, document.deleted_at, course.course_name, course.id, faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name");
		$builder->join('course', 'document.course_id = course.id');
		$builder->join('faculty_adviser', 'faculty_adviser.id = document.adviser');
		$builder->where('document.id', $id);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			$builder = $this->db->table('document');
			$builder->select("document.category_id, document.id as did, document.views, document.privacy, document.copyright, document.title, document.keywords, document.school_year, document.adviser, document.defense_date, document.full_paper, document.date_submitted, document.director, document.abstract, document.reason_for_denial, document.research_status, document.file, document.full_paper, document.deleted_at, course.course_name, course.id");
			$builder->join('course', 'document.course_id = course.id');
			$builder->where('document.id', $id);

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{
				$builder = $this->db->table('document');
				$builder->select("id as did, title, privacy, copyright, keywords, school_year, adviser, defense_date, date_submitted, director, abstract, reason_for_denial, research_status, file, category_id, deleted_at");
				$builder->where('id', $id);

				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{
					return false;
				}
			}

		}

	}

	public function getResearchId($ref){


		$builder = $this->db->table('document');
		$builder->select("id, slugs");
		$builder->where('title', $ref);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}


	public function updateFile($path, $id){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['file'=>$path]);

		if($this->db->affectedRows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function updateFull($path, $id){

	$builder = $this->db->table('document');
	$builder->where('id', $id);
	$builder->update(['full_paper'=>$path]);

	if($this->db->affectedRows() > 0){
		return true;
	}else{
		return false;
	}

}

	public function addCountView($id, $count){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['views'=> $count]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}


	}

	public function countView($year){

		// SELECT * FROM `document` ORDER BY views DESC LIMIT 10
		[$year_start, $year_end] = explode( '-', $year );

		$builder = $this->db->table('document');
		$builder->select("id, views, title, research_status");
		$builder->orderBy('views', 'DESC');
		$builder->where('views !=', 0);
		$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
		$builder->limit(10);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{
			return false;
		}
	}

	public function addCountCite($id, $count){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['downloads'=> $count]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}


	}

	public function countCite($year){

		// SELECT * FROM `document` ORDER BY views DESC LIMIT 10

		[$year_start, $year_end] = explode( '-', $year );

		$builder = $this->db->table('document');
		$builder->select("id, downloads, title, research_status");
		$builder->orderBy('downloads', 'DESC');
		$builder->where('downloads !=', 0);
		$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
		$builder->limit(10);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{
			return false;
		}
	}

	public function countCategory($year){


	[$year_start, $year_end] = explode( '-', $year );


	$builder = $this->db->table('document');
	$builder->select("document_category.id, COUNT(category_id) as number, category_id, document_category.category");
	$builder->join('document_category', 'document_category.category = document.category_id');
	$builder->groupBy('category_id');
	$builder->where('research_status', 3);
	$builder->orderBy('COUNT(category_id)', 'DESC');
	$builder->where('category_id !=', NULL);
	$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
	$builder->limit(10);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{
			return 1;
	}
}



	public function updateDeleteStatus($id){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}


	}

	public function updateDeleteStatusRestore($id){

	$builder = $this->db->table('document');
	$builder->where('id', $id);
	$builder->update(['deleted_at'=>NULL]);

	if($this->db->affectedRows()>0){

		return true;
	}else{
		return false;
	}


}


	public function disapproveResearch($id, $reason){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['research_status'=> 4, 'reason_for_denial' => $reason]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}


	}

	public function approveResearch($id){
		//adviser approval
		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['research_status'=> 1]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function adviserApproval($id){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['approval_sheet'=> (new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function adminApproveResearch($id){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['research_status'=> 3]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function adminDisapproveResearch($id, $reason){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['research_status'=> 2, 'reason_for_denial' => $reason]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}


	}

	public function updateDocumentStatus($id, $num){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		if($num == 2){
			$builder->update(['research_status'=> 1]);
		}else {
			$builder->update(['research_status'=> 0]);
		}

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function updateAdviser($id, $adviser){

		$builder = $this->db->table('research');
		$builder->where('id', $id);
		$builder->update(['adviser'=> $adviser]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}


	public function getResearchAllCourse($year_start, $year_end){

		// SELECT
		//     research.title
		// FROM
		//     research
		// INNER JOIN course ON course.id = research.course_id
		// WHERE
		//     research.school_year BETWEEN 2019 AND 2020

		$builder = $this->db->table('document');
		$builder->select("document.course_id, document.id AS did, document.title, document.keywords, document.school_year, document.defense_date, document.date_submitted, document.director, document.abstract, document.research_status, document.deleted_at, course.course_name, course.id");
		$builder->join('course', 'document.course_id = course.id');
		$builder->where("document.school_year BETWEEN '$year_start' AND '$year_end'");
		$builder->orderBy('course.id', 'ASC');


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}



	}

	public function getResearchAllCourseCsv($year_start, $year_end){

		// SELECT
		//     research.title
		// FROM
		//     research
		// INNER JOIN course ON course.id = research.course_id
		// WHERE
		//     research.school_year BETWEEN 2019 AND 2020

		$builder = $this->db->table('document');
		$builder->select("course.course_name, document.id AS did, document.title, document.abstract, document.school_year");
		$builder->join('course', 'course.id = document.course_id');
		$builder->where("document.school_year BETWEEN '$year_start' AND '$year_end'");


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}


	}

	public function getResearchPerCourse($year_start, $year_end, $id){

		// SELECT
		//     research.title, course.course_name
		// FROM
		//     research
		// INNER JOIN course ON course.id = research.course_id
		// WHERE
		//     course.id = 5 AND research.school_year BETWEEN 2017 AND 2020

		$builder = $this->db->table('document');
		$builder->select("document.course_id, document.id AS did, document.title, document.keywords, document.school_year, document.defense_date, document.date_submitted, document.director, document.abstract, document.research_status, document.deleted_at, course.course_name, course.id");
		$builder->join('course', 'document.course_id = course.id');
		$builder->where("document.school_year BETWEEN '$year_start' AND '$year_end'");
		$builder->where('course.id', $id);
		$builder->orderBy('document.school_year', 'DESC'); 


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}
	}

	public function getLatestResearch($year){

			[$year_start, $year_end] = explode( '-', $year );

			$builder = $this->db->table('document');
			$builder->select("document.category_id, document_type.type, document.document_type_id, document.id as did, document.abstract, document.views, document.title, document.keywords, document.school_year, document.adviser, document.defense_date, document.full_paper, document.date_submitted, document.director, document.reason_for_denial, document.research_status, document.file, document.deleted_at, course.course_name, course.id");
			$builder->join('course', 'document.course_id = course.id');
			$builder->join('document_type', 'document_type.id = document.document_type_id');
			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->orderBy('views', 'DESC');

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();

				// $rows = $this->paginate(3);
				// print_r($rows);
				// die();
				return $rows;

			}else{

				return false;
			}
	}

	public function getLatestResearchHome($year){

		[$year_start, $year_end] = explode( '-', $year );

		$builder = $this->db->table('document');
		$builder->select("document.category_id, document_type.id, document_type.type, document.document_type_id, document.id as did, document.views, document.title, document.keywords, document.school_year, document.adviser, document.defense_date, document.date_submitted, document.director, document.abstract, document.reason_for_denial, document.research_status, document.file, document.deleted_at, course.course_name, course.id");
		$builder->join('course', 'document.course_id = course.id');
		$builder->join('document_type', 'document_type.id = document.document_type_id');
		$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}
	}

	public function getResearchPerCourseCsv($year_start, $year_end, $id){

		// SELECT
		//     research.title, course.course_name
		// FROM
		//     research
		// INNER JOIN course ON course.id = research.course_id
		// WHERE
		//     course.id = 5 AND research.school_year BETWEEN 2017 AND 2020


		$builder = $this->db->table('document');
		$builder->select("document.id, document.title, document.abstract, document.school_year");
		$builder->join('course', 'document.course_id = course.id');
		$builder->where("document.school_year BETWEEN '$year_start' AND '$year_end'");
		$builder->where('course.id', $id);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}


	}


	public function researchPerCourseTb(){

		// SELECT course.course_name,
		//     COUNT(research.id) AS researchpercourse
		// FROM
		//     research
		// INNER JOIN course ON research.course_id = course.id
		// GROUP BY
		//     course.course_name

		$builder = $this->db->table('research');

		  $builder->select('course.id, course.course_name COUNT(research.id) as researchPerCourse');
    	$builder->join('course',' research.course_id  = course.id');
    	$builder->groupBy('course.course_name');


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}

	}


	public function researchPerYearTb(){

		// SELECT
		//     `school_year`,
		//     COUNT(`id`)
		// FROM
		//     `research`
		// GROUP BY
		//     `school_year`

		$builder = $this->db->table('research');

		$builder->select('school_year, COUNT(research.id) as researchPerYear');
    	$builder->groupBy('school_year');


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}
	}

	public function getReseachByYear(){
		$this->select('COUNT(id) as count, school_year');
		// $this->join('tbl_departments', 'tbl_researchfiles.DepartmentID = tbl_departments.DepartmentID');
		$this->where('research_status', 1);
		$this->groupBy('school_year');
		// echo JSON_encode($this->findAll());

		return JSON_encode($this->findAll());
	}
	public function getReseachByCourse(){
		$this->select('COUNT(research.id) as count, course.course_name as course');
		$this->join('course', 'course.id = research.course_id');
		// $this->join('tbl_departments', 'tbl_researchfiles.DepartmentID = tbl_departments.DepartmentID');
		$this->where('research_status', 1);
		$this->groupBy('research.course_id');

		return JSON_encode($this->findAll());
	}
	public function getReseachByAdviser(){
		$this->select('COUNT(research.id) as count, adviser');
		// $this->join('course', 'course.id = research.course_id');
		// $this->join('tbl_departments', 'tbl_researchfiles.DepartmentID = tbl_departments.DepartmentID');
		$this->where('research_status', 1);
		$this->groupBy('adviser');

		return JSON_encode($this->findAll());
	}

	public function getToApproveResearch($id, $year){

// 		SELECT
// faculty_adviser.first_name,
// document.adviser,
// document.title,
// document_type.type
// FROM
// `document`
// INNER JOIN faculty_adviser ON faculty_adviser.id = document.adviser
// INNER JOIN document_type ON document.document_type_id = document_type.id
// INNER JOIN user ON faculty_adviser.f_code = user.faculty_code
// WHERE
// document.adviser = 1
        [$year_start, $year_end] = explode( '-', $year );


				$builder = $this->db->table('document');
				$builder->select("user.faculty_code, faculty_adviser.f_code, faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name, document_type.id, document_type.type, document.document_type_id, document.id AS did, document.file, document.title, document.keywords, document.school_year, document.defense_date, document.date_submitted, document.director, document.abstract, document.adviser, document.research_status, document.deleted_at, document_type.type");
				$builder->join('faculty_adviser', 'faculty_adviser.id = document.adviser');
				$builder->join('document_type', 'document.document_type_id = document_type.id');
				$builder->join('user', 'faculty_adviser.f_code = user.faculty_code');
				$builder->where('faculty_adviser.f_code', $id);
				$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");



				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

					return false;
				}
	}

	public function filterResearch($year, $t, $d, $c){

		// 		SELECT
		//     document.title,
		//     document_type.type
		// FROM
		//     `document`
		// INNER JOIN document_type ON document.document_type_id = document_type.id
		// WHERE document.document_type_id = 3

		[$year_start, $year_end] = explode( '-', $year );

		$builder = $this->db->table('document');
		$builder->select("document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id, document_type.id, document_type.type");
		$builder->join('course', 'document.course_id = course.id');
		$builder->join('document_type', 'document_type.id = document.document_type_id');

		$builder->like("title", $t);

		$builder->where("document_type_id", $d);
		$builder->where("course_id", $c);
		$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");

		$builder->orderBy('school_year', 'ASC');

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			$builder = $this->db->table('document');
			$builder->select("document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id, document_type.id, document_type.type");
			$builder->join('course', 'document.course_id = course.id');
			$builder->join('document_type', 'document_type.id = document.document_type_id');

			$builder->like("keywords", $t);

			$builder->where("document_type_id", $d);
			$builder->where("course_id", $c);
			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->orderBy('school_year', 'ASC');


			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{


				$builder = $this->db->table('document');
				$builder->select("faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name, document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id, document_type.id, document_type.type");
				$builder->join('course', 'document.course_id = course.id');
				$builder->join('document_type', 'document_type.id = document.document_type_id');
				$builder->join('faculty_adviser', 'document.adviser = faculty_adviser.id');

				$builder->like("faculty_adviser.last_name", $t);

				$builder->where("document_type_id", $d);
				$builder->where("course_id", $c);
				$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
				$builder->orderBy('school_year', 'ASC');


				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

					$builder = $this->db->table('document');
					$builder->select("faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name, document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id, document_type.id, document_type.type");
					$builder->join('course', 'document.course_id = course.id');
					$builder->join('document_type', 'document_type.id = document.document_type_id');
					$builder->join('faculty_adviser', 'document.adviser = faculty_adviser.id');

					$builder->like("faculty_adviser.first_name", $t);

					$builder->where("document_type_id", $d);
					$builder->where("course_id", $c);
					$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
					$builder->orderBy('school_year', 'ASC');


					$result = $builder->get();
					if(count($result->getResultArray()) > 0){

						$rows = $result->getResultArray();
						return $rows;

					}else{

						return false;
					}
				}
			}
		}

	}

	public function filterResearchTD($year, $t, $d){

		[$year_start, $year_end] = explode( '-', $year );

		$builder = $this->db->table('document');
		$builder->select("document_type.id, document.document_type_id, document.id as did, document.course_id, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.deleted_at, course.course_name, course.id");
		$builder->join('document_type', 'document_type.id = document.document_type_id');
		$builder->join('course', 'document.course_id = course.id');

		$builder->like("title", $t);
		$builder->where("document_type_id", $d);
		$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
		$builder->orderBy('school_year', 'ASC');


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			$builder = $this->db->table('document');
			$builder->select("document_type.id, document.document_type_id, document.id as did, document.course_id, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.deleted_at, course.course_name, course.id");
			$builder->join('document_type', 'document_type.id = document.document_type_id');
			$builder->join('course', 'document.course_id = course.id');

			$builder->like("keywords", $t);

			$builder->where("document_type_id", $d);
			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->orderBy('school_year', 'ASC');


			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{


				$builder = $this->db->table('document');
				$builder->select("faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name, document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id, document_type.id, document_type.type");
				$builder->join('course', 'document.course_id = course.id');
				$builder->join('document_type', 'document_type.id = document.document_type_id');
				$builder->join('faculty_adviser', 'document.adviser = faculty_adviser.id');

				$builder->like("faculty_adviser.first_name", $t);

				$builder->where("document_type_id", $d);
				$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
				$builder->orderBy('school_year', 'ASC');

				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

					$builder = $this->db->table('document');
					$builder->select("faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name, document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id, document_type.id, document_type.type");
					$builder->join('course', 'document.course_id = course.id');
					$builder->join('document_type', 'document_type.id = document.document_type_id');
					$builder->join('faculty_adviser', 'document.adviser = faculty_adviser.id');

					$builder->like("faculty_adviser.last_name", $t);

					$builder->where("document_type_id", $d);
					$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
					$builder->orderBy('school_year', 'ASC');


					$result = $builder->get();
					if(count($result->getResultArray()) > 0){

						$rows = $result->getResultArray();
						return $rows;

					}else{

						return false;
					}
				}
			}
		}


	}

		public function filterResearchTC($year, $t, $c){

	// 			SELECT
	//     document.title,
	//     faculty_adviser.first_name,
	//     course.course_name
	// FROM
	//     document
	// INNER JOIN faculty_adviser ON faculty_adviser.id = document.adviser
	// INNER JOIN course ON course.id = document.course_id
	// WHERE
	//     faculty_adviser.first_name LIKE '%hel%' AND document.course_id = 1

			[$year_start, $year_end] = explode( '-', $year );

			$builder = $this->db->table('document');
			$builder->select("document.id as did, document.course_id, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id");
			$builder->join('course', 'document.course_id = course.id');

			$builder->like("title", $t);
			$builder->where("course_id", $c);
			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->orderBy('school_year', 'ASC');


			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				$builder = $this->db->table('document');
				$builder->select("document.id as did, document.course_id, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id");
				$builder->join('course', 'document.course_id = course.id');

				$builder->like("keywords", $t);
				$builder->where("course_id", $c);
				$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
				$builder->orderBy('school_year', 'ASC');

				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

					$builder = $this->db->table('document');
					$builder->select("faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name, document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id");
					$builder->join('course', 'document.course_id = course.id');
					$builder->join('faculty_adviser', 'document.adviser = faculty_adviser.id');

					$builder->like("faculty_adviser.first_name", $t);

					$builder->where("course_id", $c);
					$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
					$builder->orderBy('school_year', 'ASC');


					$result = $builder->get();
					if(count($result->getResultArray()) > 0){

						$rows = $result->getResultArray();
						return $rows;

					}else{

						$builder = $this->db->table('document');
						$builder->select("faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name, document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id");
						$builder->join('course', 'document.course_id = course.id');
						$builder->join('faculty_adviser', 'document.adviser = faculty_adviser.id');

						$builder->like("faculty_adviser.last_name", $t);

						$builder->where("course_id", $c);
						$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
						$builder->orderBy('school_year', 'ASC');


						$result = $builder->get();
						if(count($result->getResultArray()) > 0){

							$rows = $result->getResultArray();
							return $rows;

						}else{

							return false;
						}
					}
				}
			}


		}

		public function filterResearchDC($year, $d, $c){

	// 		SELECT
	// 		document.title,
	// 		document_type.type
	// FROM
	// 		`document`
	// INNER JOIN document_type ON document.document_type_id = document_type.id
	// 		INNER JOIN course ON document.course_id = course.id
	// WHERE document.document_type_id = 2 AND course.id = 2
	   [$year_start, $year_end] = explode( '-', $year );


			$builder = $this->db->table('document');
			$builder->select("document_type.id, faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.first_name, document.id as did, document.course_id, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id");
			$builder->join('course', 'document.course_id = course.id');
			$builder->join('faculty_adviser', 'faculty_adviser.id = document.adviser');
			$builder->join('document_type', 'document_type.id = document.document_type_id');

			$builder->where("course_id", $c);
			$builder->where("document_type_id", $d);
			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->orderBy('school_year', 'ASC');

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				return false;
			}
		}

		public function filterResearchT($year, $t){

			[$year_start, $year_end] = explode( '-', $year );

			$builder = $this->db->table('document');
			$builder->select("document_type.id, document.document_type_id, document.id as did, document.course_id, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.deleted_at, course.course_name, course.id");
			$builder->join('document_type', 'document_type.id = document.document_type_id');
			$builder->join('course', 'document.course_id = course.id');

			$builder->like("title", $t);

			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->orderBy('school_year', 'ASC');

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				$builder = $this->db->table('document');
				$builder->select("document_type.id, document.document_type_id, document.id as did, document.course_id, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.deleted_at, course.course_name, course.id");
				$builder->join('document_type', 'document_type.id = document.document_type_id');
				$builder->join('course', 'document.course_id = course.id');

				$builder->like("keywords", $t);

				$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
				$builder->orderBy('school_year', 'ASC');

				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

					$builder = $this->db->table('document');
					$builder->select("faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name, document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id");
					$builder->join('course', 'document.course_id = course.id');
					$builder->join('faculty_adviser', 'document.adviser = faculty_adviser.id');

					$builder->like("faculty_adviser.first_name", $t);

					$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
					$builder->orderBy('school_year', 'ASC');


					$result = $builder->get();
					if(count($result->getResultArray()) > 0){

						$rows = $result->getResultArray();
						return $rows;

					}else{

						$builder = $this->db->table('document');
						$builder->select("faculty_adviser.id, faculty_adviser.first_name, faculty_adviser.last_name, document.id as did, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id");
						$builder->join('course', 'document.course_id = course.id');
						$builder->join('faculty_adviser', 'document.adviser = faculty_adviser.id');

						$builder->like("faculty_adviser.last_name", $t);

						$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
						$builder->orderBy('school_year', 'ASC');


						$result = $builder->get();
						if(count($result->getResultArray()) > 0){

							$rows = $result->getResultArray();
							return $rows;

						}else{

							return false;
						}
					}
				}
			}
		}

		public function filterResearchC($year, $c){


	// 		SELECT
	// 		document.title,
	// 		document_type.type
	// FROM
	// 		`document`
	// INNER JOIN document_type ON document.document_type_id = document_type.id
	// 		INNER JOIN course ON document.course_id = course.id
	// WHERE document.document_type_id = 2 AND course.id = 2
	   [$year_start, $year_end] = explode( '-', $year );

			$builder = $this->db->table('document');
			$builder->select("document.id as did, document.course_id, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id");
			$builder->join('course', 'document.course_id = course.id');

			$builder->where("course_id", $c);
			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->orderBy('school_year', 'ASC');

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				return false;
			}
		}

		public function filterResearchD($year, $d){

	// 		SELECT
	// 		document.title,
	// 		document_type.type
	// FROM
	// 		`document`
	// INNER JOIN document_type ON document.document_type_id = document_type.id
	// 		INNER JOIN course ON document.course_id = course.id
	// WHERE document.document_type_id = 2 AND course.id = 2
	   [$year_start, $year_end] = explode( '-', $year );


			$builder = $this->db->table('document');
			$builder->select("document_type.id, document.id as did, document.course_id, document.title, document.keywords, document.school_year, document.adviser, document.abstract, document.research_status, document.file, document.document_type_id, document.deleted_at, course.course_name, course.id");
			$builder->join('course', 'document.course_id = course.id');
			$builder->join('document_type', 'document_type.id = document.document_type_id');

			$builder->where("document_type_id", $d);
			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->orderBy('school_year', 'ASC');

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				return false;
			}
		}

		public function getBySlug($slug){

			$this->select('document.slugs, document.title, document.created_at, course.course_name, document.id' );
			$this->join('course', 'document.course_id = course.id');
			$this-> where("slugs", $slug);

			return $this->findAll();
	}

	public function addCopyright($path, $id){

		$builder = $this->db->table('document');
		$builder->where('id', $id);
		$builder->update(['copyright'=>$path]);

		if($this->db->affectedRows() > 0){
			return true;
		}else{
			return false;
		}

	}
	public function getCourse($year_start, $year_end){

	       $this->select('course_id');
	       $this->groupBy('course_id');
	       $this->orderBy('school_year', 'DESC'); 
		   $this->where("school_year BETWEEN '$year_start' AND '$year_end'");
	       return $this->findAll();

			 }


}

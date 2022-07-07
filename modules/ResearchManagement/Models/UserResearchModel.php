<?php
namespace Modules\ResearchManagement\Models;

/**
 *
 */
class UserResearchModel extends \CodeIgniter\Model{


	protected $table = 'document_author';
	protected $primaryKey = 'id';
	protected $allowedFields = ['document_id', 'author_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

 	public function createUserResearch($data){

		$builder = $this->db->table('document_author');
		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}
	}

	public function getResearchDetails($id){

		//SELECT research.id, research.title FROM research INNER JOIN student_research ON student_research.research_id = research.id AND student_research.author_id

		$builder = $this->db->table('document');
		$builder->select('document.id, document.title, document.research_status, document.deleted_at');
		$builder->join('document_author', 'document_author.document_id = document.id AND document_author.author_id ='. $id);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}

	}


	public function tempGetResearch($uniid){

		$builder = $this->db->table('research');
		$builder->select('research.id, research.title, research.research_status, research.deleted_at');
		$builder->join('student_research', 'student_research.research_id = research.id AND student_research.course_id=' . $uniid);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){
			 $row = $result->getResultArray();
			 return $uniid;
		}else{
			return 8;
		}
	}



	public function deleteStudentResearch($id){

		$builder = $this->db->table('student_research');
		$builder->where('research_id', $id);
		$builder->delete();

		if($this->db->affectedRows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function getResearchAuthors($id){

		// SELECT
		// user.student_number
		// FROM
		// user
		// INNER JOIN document_author ON document_author.author_id = user.id AND document_author.document_id = 6

		$builder = $this->db->table('document_author');
		$builder->select('user.first_name, user.last_name, user.id, user.email, document_author.author_id, document_author.document_id');
		$builder->join('user', 'document_author.author_id = user.id AND document_author.document_id =' .$id);
		$result = $builder->get();

		if(count($result->getResultArray()) > 0){
			
			return $result->getResultArray();

		}else{
			return false;
		}

	}

	public function getResearchOfStudent(){

		// SELECT
		//     research.title, course.course_name
		// FROM
		//     research
		// INNER JOIN student_research ON student_research.research_id = research.id
		// INNER JOIN course ON course.id = research.course_id
		// GROUP BY
		//     research.id

		$builder = $this->db->table('research');
		$builder->select('research.id, research.title, research.keywords, research.school_year, research.paper_type, research.research_status, course.course_name');
		$builder->join('student_research', 'student_research.research_id = research.id');
		$builder->join('course', 'course.id = research.course_id');
		$builder->groupby('research.id');

		$result = $builder->get();

		if(count($result->getResultArray()) > 0){
			$row = $result->getResultArray();
			return $row;

		}else{
			return false;

		}

	}


		public function getPendingStudentRes(){

			// 			SELECT
			//     document.title,
			//     user.role_id
			// FROM
			// 	document
			// INNER JOIN
			// 	document_author ON document_author.document_id = document.id
			// INNER JOIN user ON document_author.author_id = user.id
			// WHERE user.role_id = 2

			$builder = $this->db->table('document');
			$builder->select("document_author.author_id, document_author.document_id, user.id, user.role_id, document.id as did, document.title, document.keywords, document.school_year, document.research_status, document.deleted_at");
			$builder->join('document_author', 'document_author.document_id = document.id');
			$builder->join('user', 'document_author.author_id = user.id');
			$builder->where('user.role_id', 2);

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{
				return false;
			}

		}

		public function getPendingProfRes(){

						$builder = $this->db->table('document');
						$builder->select("document_author.author_id, document_author.document_id, user.id, user.role_id, document.id as did, document.title, document.keywords, document.school_year, document.research_status, document.deleted_at");
						$builder->join('document_author', 'document_author.document_id = document.id');
						$builder->join('user', 'document_author.author_id = user.id');
						$builder->where('user.role_id', 3);

						$result = $builder->get();
						if(count($result->getResultArray()) > 0){

							$rows = $result->getResultArray();
							return $rows;

						}else{
							return false;
						}

		}

}

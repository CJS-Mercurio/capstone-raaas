<?php
namespace Modules\Student\Models;

/**
 *
 */
class StudentResearchModel extends \CodeIgniter\Model{


	protected $table = 'student_research';
	protected $primaryKey = 'id';
	protected $allowedFields = ['student_id', 'research_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

 	public function createAuthorResearch($data){

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

		$builder = $this->db->table('research');
		$builder->select('research.id, research.title, research.research_status, research.deleted_at');
		$builder->join('student_research', 'student_research.research_id = research.id AND student_research.student_id ='. $id);

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

		$builder = $this->db->table('document_author');
		$builder->where('document_id', $id);
		$builder->delete();

		if($this->db->affectedRows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function getResearchAuthors($id){

		// SELECT
		// student.first_name
		// FROM
		// student
		// INNER JOIN student_research ON student_research.student_id = student.id AND student_research.research_id = 39

		$builder = $this->db->table('user');
		$builder->select('user.first_name, user.last_name');
		$builder->join('document_author', 'document_author.author_id = user.id AND document_author.document_id =' .$id);
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

}

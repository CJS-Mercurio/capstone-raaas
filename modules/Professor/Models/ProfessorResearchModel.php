<?php
namespace Modules\Professor\Models;

/**
 * 
 */
class ProfessorResearchModel extends \CodeIgniter\Model{

	protected $table = 'professor_research';
	protected $primaryKey = 'id';
	protected $allowedFields = ['author_id', 'research_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

 	public function createProfessorResearch($data){

		$builder = $this->db->table('professor_research');
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
		$builder->join('professor_research', 'professor_research.research_id = research.id AND professor_research.author_id ='. $id);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}

	}


	public function deleteProfessorResearch($id){

		$builder = $this->db->table('professor_research');
		$builder->where('research_id', $id);
		$builder->delete();

		if($this->db->affectedRows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function getResearchAuthors($id){

		//SELECT
		//student.first_name
		//FROM
		//student
		//INNER JOIN student_research ON student_research.student_id = student.id AND student_research.research_id = 39

		$builder = $this->db->table('professor');
		$builder->select('professor.f_firstname, professor.f_lastname');
		$builder->join('professor_research', 'professor_research.author_id = professor.id AND professor_research.research_id =' .$id);
		$result = $builder->get();

		if(count($result->getResultArray()) > 0){
			return $result->getResultArray();
		
		}else{
			return false;
		}

	}


	public function getResearchOfProf(){

		// SELECT * FROM research INNER JOIN student_research ON student_research.research_id = research.id GROUP BY research.id

		$builder = $this->db->table('research');
		$builder->select('research.id, research.title, research.keywords, research.school_year, research.paper_type, research.research_status');
		$builder->join('professor_research', 'professor_research.research_id = research.id');
		$builder->groupby('research.id');

		$result = $builder->get();

		if(count($result->getResultArray()) > 0){
			return $result->getResultArray();
				
		}else{
			return false;
			
		}
	}

}
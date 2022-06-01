<?php
namespace Modules\Professor\Models;

/**
 *
 */
class PublishedResearchModel extends \CodeIgniter\Model{


	protected $table = 'published_research';
	protected $primaryKey = 'id';
	protected $allowedFields = ['research_title', 'publication', 'volume', 'institute', 'event_date', 'professor_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

 	public function createPubResearch($data){

		$builder = $this->db->table('published_research');

		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}


	}


	public function getPubResearch($id){

 		$builder = $this->db->table('published_research');
		$builder->select("id, research_title, publication, volume, institute, event_date, professor_id");
		$builder->where('professor_id', $id);


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}
 	}

 	public function pResearch_report(){

 		// SELECT published_research.research_title, published_research.publication, published_research.volume, published_research.institute, published_research.event_date, published_research.professor_id, professor.f_firstname FROM published_research INNER JOIN professor ON professor.id = published_research.professor_id ORDER BY published_research.professor_id

 		$builder = $this->db->table('published_research');
		$builder->select("published_research.research_title, published_research.publication, published_research.volume, published_research.institute, published_research.event_date, published_research.professor_id, professor.f_firstname, professor.f_lastname ");
		$builder->join('professor', 'professor.id = published_research.professor_id');
		$builder->orderBy('published_research.professor_id', 'ASC');



		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}
		
 	}


	public function pResearch_report2(){

 		// SELECT published_research.research_title, published_research.publication, published_research.volume, published_research.institute, published_research.event_date, published_research.professor_id, professor.f_firstname FROM published_research INNER JOIN professor ON professor.id = published_research.professor_id ORDER BY published_research.professor_id

 		$builder = $this->db->table('published_research');
		$builder->select("professor.f_firstname, professor.f_lastname, published_research.research_title, published_research.publication, published_research.volume, published_research.institute, published_research.event_date");
		$builder->join('professor', 'professor.id = published_research.professor_id');
		



		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}

 
 	}
 	


}

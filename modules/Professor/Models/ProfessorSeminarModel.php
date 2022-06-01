<?php
namespace Modules\Professor\Models;

/**
 *
 */
class ProfessorSeminarModel extends \CodeIgniter\Model{


	protected $table = 'professor_seminar';
	protected $primaryKey = 'id';
	protected $allowedFields = ['seminar_title', 'sponsor', 'venue', 'event_date', 'professor_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

 	public function createProfSeminar($data){

		$builder = $this->db->table('professor_seminar');

		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}


	}

 
 	public function getProfSeminar($id){

 		$builder = $this->db->table('professor_seminar');
		$builder->select("id, seminar_title, sponsor, venue, event_date, professor_id");
		$builder->where('professor_id', $id);


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}
 	}



 	public function seminar_report(){

 		// SELECT * FROM `professor_seminar` ORDER BY `professor_id`ASC

 		// SELECT professor_seminar.seminar_title, professor_seminar.sponsor, professor_seminar.venue, professor_seminar.event_date, professor.f_firstname FROM professor_seminar INNER JOIN professor ON professor.id = professor_seminar.professor_id ORDER BY professor_seminar.professor_id

 		$builder = $this->db->table('professor_seminar');
		$builder->select("professor_seminar.id, professor_seminar.seminar_title, professor_seminar.sponsor, professor_seminar.venue, professor_seminar.event_date, professor_seminar.professor_id, professor.f_firstname, professor.f_lastname");
		$builder->join('professor', 'professor.id = professor_seminar.professor_id');
		$builder->orderBy('professor_id', 'ASC');



		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}
		
 	}

 	public function seminar_report2(){

 		// SELECT * FROM `professor_seminar` ORDER BY `professor_id`ASC

 		// SELECT professor_seminar.seminar_title, professor_seminar.sponsor, professor_seminar.venue, professor_seminar.event_date, professor.f_firstname FROM professor_seminar INNER JOIN professor ON professor.id = professor_seminar.professor_id ORDER BY professor_seminar.professor_id

 		$builder = $this->db->table('professor_seminar');
		$builder->select("professor.f_firstname, professor.f_lastname, professor_seminar.seminar_title, professor_seminar.sponsor, professor_seminar.venue, professor_seminar.event_date");
		$builder->join('professor', 'professor.id = professor_seminar.professor_id');
		



		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}
		
 	}

 	


}

<?php
namespace Modules\Student\Models;

/**
 *
 */
class StudentSeminarModel extends \CodeIgniter\Model{


	protected $table = 'student_seminar';
	protected $primaryKey = 'id';
	protected $allowedFields = ['seminar_title', 'sponsor', 'venue', 'event_date', 'student_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

 	public function createStudentSeminar($data){

		$builder = $this->db->table('student_seminar');

		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}


	}

 
 	public function getStudentSeminar($id){

 		$builder = $this->db->table('student_seminar');
		$builder->select("id, seminar_title, sponsor, venue, event_date, student_id");
		$builder->where('student_id', $id);


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}
 	}


 	public function seminar_report(){


 		// SELECT student_seminar.seminar_title, student_seminar.sponsor, student_seminar.venue, student_seminar.event_date, student.first_name FROM student_seminar INNER JOIN student ON student.id = student_seminar.student_id ORDER BY student_seminar.student_id

 		$builder = $this->db->table('student_seminar');
		$builder->select("student_seminar.seminar_title, student_seminar.sponsor, student_seminar.venue, student_seminar.event_date, student.first_name, student.last_name, student_seminar.student_id" );
		$builder->join('student', 'student.id = student_seminar.student_id');
		$builder->orderBy('student_id', 'ASC');


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}
 	}


}

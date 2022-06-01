<?php
namespace Modules\Student\Models;

/**
 *
 */
class StudentCourseModel extends \CodeIgniter\Model{


	protected $table = 'student_course';
	protected $primaryKey = 'id';
	protected $allowedFields = ['student_id', 'course_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

 	public function getStudentCourseId($id){

		$builder = $this->db->table('student_course');
		$builder->select("id, student_id, course_id");
		$builder->where('student_id',$id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function deleteStudentCourse($id){

		$builder = $this->db->table('student_course');
		$builder->where('student_id', $id);
		$builder->delete();
		
		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}



}

<?php

namespace App\Models;
use \CodeIgniter\Model;

/**
 *
 */
class RegisterStudentModel extends Model
{

	public function createStudentUser($data){

		$builder = $this->db->table('user');
		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}

	}

	function getStudentId($ref){

		$builder = $this->db->table('user');
		$builder->select("id, student_number");
		$builder->where('student_number', $ref);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}


	public function createStudentCourseTable($data){

		$builder = $this->db->table('student_course');
		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}

	}

}

<?php

namespace Modules\Student\Models;

/**
 *
 */
class StudentModel extends \CodeIgniter\Model{


	protected $table = 'student';
	protected $primaryKey = 'id';

	protected $allowedFields = ['first_name', 'last_name', 'student_number','status', 'uniid', 'activation_date'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $returnType = 'array';

	public function getLoggedInUserData($id){

		$builder = $this->db->table('student');
		$builder->where('uniid',$id);
		$result = $builder->get();

		if(count($result->getResultArray())==1){

			return $result->getRow();
		}else{
			return false;
		}
	}

	public function getLoggedInUserRole($id){

		$builder = $this->db->table('student');
		$builder->where('uniid',$id);
		$result = $builder->get();

		if(count($result->getResultArray())==1){

			return $result->getRowArray();
		}else{
			return false;
		}
	}

	public function updatePassword($npwd, $id){

		$builder = $this->db->table('student');
		$builder->where('uniid',$id);
		$builder->update(['password'=>$npwd]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function updateUserInfo($data, $id){

		$builder = $this->db->table('student');
		$builder->where('uniid',$id);
		$builder->update($data);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function getStudentId($id){

		$builder = $this->db->table('student');
		$builder->select("id, student_number, uniid");
		$builder->where('uniid',$id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function getStudentData($id){
		$builder = $this->db->table('student');
		$builder->select("id, student_number, uniid, email, first_name");
		$builder->where('id',$id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}

	}

	public function getStudentRequest(){


		$builder = $this->db->table('student');
		$builder->select("id, student_number, first_name, last_name, middle_name, year, status");
		$builder->where('status', "inactive");

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function approve_user_account($id){

		$status = 2;
		$builder = $this->db->table('student');
		$builder->where('id',$id);
		$builder->update(['status'=> $status, 'activation_date' => (new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function disapprove_user_account($id){

		$builder = $this->db->table('student');
		$builder->where('id', $id);
		$builder->delete();

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function verifyUniid($id){

		$builder = $this->db->table('student');
		$builder->select("activation_date, uniid, status");
		$builder->where('uniid', $id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function updateStatus($uniid){

		$status = 1;
		$builder = $this->db->table('student');
		$builder->where('uniid',$uniid);
		$builder->update(['status'=> $status]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}

	}

	public function getUserPermission($id){

		// SELECT
		// task.task_name
		// FROM
		//     task
		// INNER JOIN permission ON task.id = permission.task_id
		// WHERE permission.role_id = 1
		$builder = $this->db->table('task');
		$builder->select("task.task_name, task.id AS tid");
		$builder->join('permission', 'task.id = permission.task_id');
		$builder->where('permission.role_id', $id);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			print_r($row);

		}else{

			return 8;
		}
	}

}

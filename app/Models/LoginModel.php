<?php

namespace App\Models;
use \CodeIgniter\Model;

class LoginModel extends Model{

	public $userCounter;

	public function setUserCount($userCounter){

		$this->userCounter = $userCounter;

	}

	public function getUserCount(){

		return $this->userCounter;
	}

	public function verifyUsername($username){


		$builder = $this->db->table('user');
		$builder->select("email,faculty_code,student_number,password,role_id,uniid,status");
		$builder->where('student_number', $username);
		$builder->orWhere('faculty_code', $username);
		$builder->orWhere('email', $username);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){
			$this->setUserCount(1);
			return $result->getRowArray();

		}else{
			$builder = $this->db->table('superadmin');
			$builder->select("id,username,password");
			$builder->where('username', $username);

			$result = $builder->get();
			if(count($result->getResultArray()) == 1){

				return $result->getRowArray();

			}else{

				return false;
			}
		}//first else

	}


	public function verifyEmail($email){

		$builder = $this->db->table('user');
		$builder->select("email,first_name,password,uniid");
		$builder->where('email', $email);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{
				return false;
		}

	}

	public function updatedAt($id){

		$builder = $this->db->table('user');
		$builder->where('uniid', $id);
		$builder->update(['updated_at'=>date('Y-m-d h:i:s')]);

		if($this->db->affectedRows() == 1){
			return true;

		}else{

			$builder = $this->db->table('user');
			$builder->where('uniid', $id);
			$builder->update(['updated_at'=>date('Y-m-d h:i:s')]);

			if($this->db->affectedRows() == 1){
				return true;

			}else{

				return false;
			}

		}
	}

	public function verifyToken($token){

			$builder = $this->db->table('user');
			$builder->select("uniid, first_name, updated_at");
			$builder->where('uniid', $token);
			$result = $builder->get();

			if(count($result->getResultArray())==1){

				return $result->getRowArray();
			}else{
					return false;
			}
	}

	public function updatePassword($id, $pwd){

		$builder = $this->db->table('user');
		$builder->where('uniid', $id);
		$builder->update(['password' => $pwd]);

		if($this->db->affectedRows() == 1){

			return true;
		}else{

				return false;
		}
	}

}//end class

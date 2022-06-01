<?php

namespace App\Models;
use \CodeIgniter\Model;

/**
 *
 */
class UserModel extends Model
{

	public function createUser($data){

		$builder = $this->db->table('user');
		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}

	}

}

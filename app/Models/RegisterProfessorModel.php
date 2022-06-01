<?php

namespace App\Models;
use \CodeIgniter\Model;

/**
 *
 */
class RegisterProfessorModel extends Model
{

	protected $table = 'user';
	protected $primaryKey = 'id';
	protected $allowedFields = ['faculty_code',	'email',	'password',	'first_name',	'middle_name',	'last_name',	'birthdate',	'faculty_position',	'faculty_status',	'gender',	'valid_id',	'role_id',	'uniid', 'status', 'activation_date'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

	public function createProfessorUser($data){

			$builder = $this->db->table('user');
			$res = $builder->insert($data);
			if($this->db->affectedRows() ==  1){

				return true;
			}else{

				return false;
			}
		}

}

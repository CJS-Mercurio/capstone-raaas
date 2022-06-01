<?php
namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;

class RoleModel extends Model{

	protected $table = 'role';
	protected $primaryKey = 'id';

	protected $allowedFields = ['role_name'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';


	public function deactivate($id){

	    $builder = $this->db->table('role');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('role');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function findRoleID($role_name){

		$builder = $this->db->table('role');
		$builder->select("id");
		$builder->where('role_name', $role_name);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function findUser(){

			// SELECT
			//     role.role_name,
			//     user.first_name
			// FROM
			//     role
			// INNER JOIN user ON user.role_id = role.id
			$builder = $this->db->table('role');
			$builder->select("user.id, role.role_name, user.first_name, user.middle_name, user.last_name, user.valid_id, role.id AS rid, user.birthdate, user.status");
			$builder->join('user', 'user.role_id = role.id');

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				return false;
			}

	}

}

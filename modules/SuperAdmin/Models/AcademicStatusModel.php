<?php
namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;

class AcademicStatusModel extends Model{

	protected $table = 'academic_status';
	protected $primaryKey = 'id';

	protected $allowedFields = ['academic_status'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';


	public function deactivate($id){

	    $builder = $this->db->table('academic_status');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('academic_status');
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

}

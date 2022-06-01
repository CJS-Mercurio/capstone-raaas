<?php
namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;

class PermissionModel extends Model{

	protected $table = 'permission';
	protected $primaryKey = 'id';

	protected $allowedFields = ['role_id, task_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';


	public function deactivate($id){

	  $builder = $this->db->table('permission');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('permission');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function insertPermission($data){

    $builder = $this->db->table('permission');
    $res = $builder->insert($data);
    if($this->db->affectedRows() ==  1){

      return true;
    }else{

      return false;
    }

	}

  public function getPermission(){

  //     SELECT
  //     role.role_name,
  //     module.module_name
  // FROM
  //     `role`
  // INNER JOIN permission ON permission.role_id = role.id
  // INNER JOIN module ON module.id = permission.module_id

  $builder = $this->db->table('permission');
  $builder->select("role.id AS rid, task.id AS tid, role.role_name, task.task_name, role.deleted_at");
  $builder->join('role', 'permission.role_id = role.id');
  $builder->join('task', 'permission.task_id = task.id');
  // $builder->groupBy('module.id');


  $result = $builder->get();
  if(count($result->getResultArray()) > 0){

    $rows = $result->getResultArray();
    return $rows;

  }else{

    return false;
  }

  }

  public function deletePermission($id){

    $builder = $this->db->table('permission');
    $builder->where('task_id', $id);
    $builder->delete();

    if($this->db->affectedRows() > 0){
      return true;
    }else{
      return false;
    }

  }



}

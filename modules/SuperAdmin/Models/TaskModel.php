<?php
namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;

class TaskModel extends Model{

	protected $table = 'task';
	protected $primaryKey = 'id';

	protected $allowedFields = ['task_name, module_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';


	public function deactivate($id){

	    $builder = $this->db->table('task');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('task');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function deactivate1($id){

	  $builder = $this->db->table('task');
		$builder->where('module_id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function activate1($id){

		$builder = $this->db->table('task');
		$builder->where('module_id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function getFunction($id){
		// SELECT
    // task.task_name, task.module_id, module.deleted_at
		// FROM
		//     `task`
		// INNER JOIN module ON module.id = task.module_id

		$builder = $this->db->table('task');
		$builder->select("id, task_name, module_id, deleted_at");
		$builder->where('module_id', $id);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}

	}

	public function getActiveTask(){
		// SELECT
		// task.task_name, task.module_id, module.deleted_at
		// FROM
		//     `task`
		// INNER JOIN module ON module.id = task.module_id

		$builder = $this->db->table('task');
		$builder->select("task.id, task.task_name, task.module_id, module.deleted_at AS mda, task.deleted_at AS tda");
		$builder->join('module', 'module.id = task.module_id');

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}
	}


	public function createTask($data){

		$builder = $this->db->table('task');
		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

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
			return $rows;

		}else{

			return false;
		}
	}


}

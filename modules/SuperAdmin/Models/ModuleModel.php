<?php
namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;

class ModuleModel extends Model{

	protected $table = 'module';
	protected $primaryKey = 'id';

	protected $allowedFields = ['module_name'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';


	public function deactivate($id){

	    $builder = $this->db->table('module');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('module');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function getModule($id){

		$builder = $this->db->table('module');
		$builder->select("id, module_name");
		$builder->where('id',$id);
		$result = $builder->get();

		if(count($result->getResultArray())==1){

			return $result->getRow();
		}else{
			return false;
		}
	}

}


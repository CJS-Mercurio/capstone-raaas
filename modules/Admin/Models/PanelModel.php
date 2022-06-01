<?php
namespace Modules\Admin\Models;
use \CodeIgniter\Model;

class PanelModel extends Model{

	protected $table = 'panel';
	protected $primaryKey = 'id';

	protected $allowedFields = ['first_name', 'last_name', 'occupation', 'company', 'deleted_at'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

	public function createPanel($data){

		$builder = $this->db->table('panel');
		$res = $builder->insert($data);

		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}

	}

	public function deactivate($id){

	  $builder = $this->db->table('panel');
		$builder->like('first_name', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('panel');
		$builder->like('first_name', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}


}

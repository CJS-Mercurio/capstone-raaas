<?php
namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;

class EventTypeModel extends Model{

	protected $table = 'event_type';
	protected $primaryKey = 'id';

	protected $allowedFields = ['type'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';


	public function deactivate($id){

	  $builder = $this->db->table('event_type');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('event_type');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}



}

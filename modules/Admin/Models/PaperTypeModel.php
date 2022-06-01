<?php
namespace Modules\Admin\Models;
use \CodeIgniter\Model;

class PaperTypeModel extends Model{

	protected $table = 'paper_type';
	protected $primaryKey = 'id';

	protected $allowedFields = ['type_of_final_paper'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

	function getPaperTypeId($ref){


		$builder = $this->db->table('paper_type');
		$builder->select("id, type_of_final_paper");
		$builder->where('id', $ref);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function findPaperType($id){

		$builder = $this->db->table('paper_type');
		$builder->select("id, type_of_final_paper");
		$builder->where('id', $id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}

	}

	public function deactivate($id){

		$builder = $this->db->table('paper_type');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('paper_type');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}


}

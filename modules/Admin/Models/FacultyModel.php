<?php
namespace Modules\Admin\Models;
use \CodeIgniter\Model;

class FacultyModel extends Model{

	protected $table = 'faculty_adviser';
	protected $primaryKey = 'id';

	protected $allowedFields = ['f_code', 'first_name', 'last_name', 'deleted_at'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

	public function deactivate($id){

	  $builder = $this->db->table('faculty_adviser');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('faculty_adviser');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}


}

<?php
namespace Modules\Admin\Models;
use \CodeIgniter\Model;

class AdminConfigModel extends Model{

	protected $table = 'admin_config';
	protected $primaryKey = 'id';

	protected $allowedFields = ['school_year', 'current_director', 'archive_year'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';


	public function updateSY($data){

		$builder = $this->db->table('admin_config');
		$builder->update(['school_year'=> $data]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function updateAY($data){

		$builder = $this->db->table('admin_config');
		$builder->update(['archive_year'=> $data]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}


	public function updateCD($data){

		$builder = $this->db->table('admin_config');
		$builder->update(['current_director'=> $data['current_director']]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function getsy_cd(){

		$builder = $this->db->table('admin_config');
		$builder->select("school_year, current_director, archive_year");

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}
}

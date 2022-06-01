<?php
namespace Modules\Admin\Models;
use \CodeIgniter\Model;

class CourseModel extends Model{

	protected $table = 'course';
	protected $primaryKey = 'id';

	protected $allowedFields = ['course_name', 'abbreviate', 'paper_type'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

	public function getCourseData($id){

		$builder = $this->db->table('course');
		$builder->select("id, paper_type");
		$builder->where('id',$id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function noticeTable()
	{
		$builder = $this->db->table('course');

		return $builder;
	}

	public function findCourse($id){

		$builder = $this->db->table('course');
		$builder->select("id, course_name, abbreviate, deleted_at");
		$builder->where('id',$id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function deactivate($id){

	    $builder = $this->db->table('course');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('course');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

}

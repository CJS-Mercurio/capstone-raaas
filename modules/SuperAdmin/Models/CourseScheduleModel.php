<?php
namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;

class CourseScheduleModel extends Model{

	protected $table = 'course_schedule';
	protected $primaryKey = 'id';

	protected $allowedFields = ['course_id', 'dateFrom', 'dateTo'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';


	public function deactivate($id){

	  $builder = $this->db->table('course_schedule');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

		$builder = $this->db->table('course_schedule');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function getSchedule(){

			$builder = $this->db->table('course_schedule');
			$builder->select("course_schedule.course_id, course_schedule.dateFrom, course_schedule.dateTo, course.course_name, course.id");
			$builder->join('course', 'course_schedule.course_id = course.id');
			// $builder->groupBy('module.id');


			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				return false;
			}

	}

	public function findCourseId($id){

		$builder = $this->db->table('course_schedule');
		$builder->select("id, course_id");
		$builder->where('course_id', $id);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}

	}

	public function empty(){

			$builder = $this->db->table('course_schedule');

			if(	$builder->truncate()){
				return true;

			}else{
				return false;
			}
	}

	public function deleteSched($id){

			$builder = $this->db->table('course_schedule');
			$builder->where('course_id', $id);
			$builder->delete();

			if($this->db->affectedRows() > 0){
				return true;
			}else{
				return false;
			}

	}

}

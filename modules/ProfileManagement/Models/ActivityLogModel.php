<?php
namespace Modules\ProfileManagement\Models;

/**
 *
 */
class ActivityLogModel extends \CodeIgniter\Model{


	protected $table = 'activity_log';
	protected $primaryKey = 'id';
	protected $allowedFields = ['user_id', 'task_name', 'detail_id', 'deleted_at'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

  public function activityLog(){
		// WHERE pdate BETWEEN datetime('now', '-30 days') AND datetime('now', 'localtime')

    $builder = $this->db->table('activity_log');
		$builder->select('user.first_name, user.last_name, user.id, activity_log.id AS aid,  activity_log.detail_id, activity_log.user_id, activity_log.task_name, activity_log.created_at');
		$builder->join('user', 'activity_log.user_id = user.id');
		// $builder->where("activity.created_at BETWEEN 'datetime('now', '30 days')' AND 'datetime('now', 'localtime')'");
		$builder->orderBy('activity_log.id', 'DESC');
		$result = $builder->get();

		if(count($result->getResultArray()) > 0){
			return $result->getResultArray();

		}else{
			return false;
		}
  }

  public function activityLogDetail($id){

    //user name, user id, student_number, faculty code, activity, reference

    		$builder = $this->db->table('activity_log');
        // $builder->select('id, detail_id');
        $builder->select('user.first_name, user.last_name, user.id, activity_log.id AS aid, activity_log.user_id, activity_log.task_name, activity_log.detail_id, activity_log.created_at, forum.id, forum.title');
        $builder->join('user', 'activity_log.user_id = user.id');
        $builder->join('forum', 'forum.id = activity_log.detail_id');
        $builder->where('activity_log.id', $id);

    		$result = $builder->get();
    		if(count($result->getResultArray()) == 1){

    			return $result->getRowArray();

    		}else{

          $builder = $this->db->table('activity_log');
          $builder->select('user.first_name, user.last_name, user.id, activity_log.id AS aid, activity_log.user_id, activity_log.task_name, activity_log.detail_id, activity_log.created_at, document.slugs, document.title');
          $builder->join('user', 'activity_log.user_id = user.id');
          $builder->join('document', 'document.slugs = activity_log.detail_id');
          $builder->where('activity_log.id', $id);

          $result = $builder->get();
          if(count($result->getResultArray()) == 1){

            return $result->getRowArray();

          }else{

            return false;
          }
    		}
  }

	public function activityLogged($id){
		//for user
		// 		SELECT
		//     activity_log.user_id,
		//     USER.first_name
		// FROM
		//     activity_log
		// INNER JOIN USER ON activity_log.user_id = USER.id
		// WHERE activity_log.user_id = 8
		$builder = $this->db->table('activity_log');
		$builder->select('user.first_name, user.last_name, user.id, activity_log.id AS aid, activity_log.user_id, activity_log.task_name, activity_log.detail_id, activity_log.created_at');
		$builder->join('user', 'activity_log.user_id = user.id');
		$builder->where('activity_log.user_id', $id);


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			return $result->getResultArray();


		}else{
			return false;

		}
  }

}//end class

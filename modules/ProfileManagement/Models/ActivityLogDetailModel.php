<?php
namespace Modules\ProfileManagement\Models;

/**
 *
 */
class ActivityLogDetailModel extends \CodeIgniter\Model{


	protected $table = 'activity_log_detail';
	protected $primaryKey = 'id';
	protected $allowedFields = ['reference'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

  public function activityLogDetail(){


  }

}//end class

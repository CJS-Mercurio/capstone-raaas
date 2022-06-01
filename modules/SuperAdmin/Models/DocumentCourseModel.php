<?php
namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;

class DocumentCourseModel extends Model{

	protected $table = 'course_document';
	protected $primaryKey = 'id';

	protected $allowedFields = ['course_id', 'document_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

}

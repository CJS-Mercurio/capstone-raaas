<?php
namespace Modules\Admin\Models;
use \CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'id';
    protected $allowedFields = ['course_name', 'abbreviate'];
}

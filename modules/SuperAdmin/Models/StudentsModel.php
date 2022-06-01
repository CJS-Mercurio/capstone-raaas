<?php

namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;
use Modules\SuperAdmin\Controllers\Students;
use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\GenderModel;
use Modules\SuperAdmin\Models\AcademicStatusModel;
/**
 *
 */
class StudentsModel extends Model
{

  protected $table = 'students';

  protected $allowedFields = ['id', 'student_number', 'firstname', 'lastname', 'middlename', 'birthdate', 'birthdate', 'contact', 'academic_status', 'course_id', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

  function __construct(){
    parent::__construct();
  }


  public function insertStudent($data)
  {
    $this->transStart();

      $user = new UserModel();
      $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
      $password = $data['student_number'];
      $userData = [
        'student_number' => $data['student_number'],
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'email' => $data['email'],
        'uniid' => $uniid,
        'first_name' => $data['firstname'],
        'middle_name' => $data['middlename'],
        'last_name' => $data['lastname'],
        'status' => 1,
        'role_id' => 2
      ];

      $user->insert($userData);
      $id = $user->getInsertID();

      $data['user_id'] = $id;

      $this->insert($data);
      $this->transComplete();
      return $this->transStatus();

      // $student = new Students();
      // if($student->sendPassword($password, $data['email']))
      // {
      //   $this->transCommit();
      //   return true;
      // }
      // else
      // {
      //   $this->transRollback();
      //   return false;
      // }

  }

  public function getStudentByStatus($status, $role){
    $this->select('students.id, students.firstname, students.lastname, students.middlename, students.student_number, students.user_id, students.contact, students.birthdate, user.username,user.email, role.role_name');
    $this->join('user', 'user.id = students.user_id');
    $this->join('role', 'user.role_id = role.id');
    $this->where('user.status', $status);
    if ($role != null) {
      $this->where('role.id', $role);
    }
    return $this->findAll();
  }

  public function getDetail($condition = []){

    $this->select('students.*, course.course_name, academic_status.academic_status');
    $this->join('course', 'students.course_id = course.id');
    $this->join('academic_status', 'students.academic_status = academic_status.id');
    foreach ($condition as $condition => $value) {
      $this->where($condition, $value);
    }
    return $this->findAll();

  }
  //
  // public function softDeleteByUserId($id){
  //   return $this->delete(['user_id' => $id]);
  // }
  //
  // public function getStudentByUserId($id){
  //   $this->where('user_id', $id);
  //   return $this->findAll();
  // }

}

<?php

namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;
use Modules\SuperAdmin\Controllers\Professors;
use Modules\SuperAdmin\Models\UserModel;
/**
 *
 */
class ProfessorsModel extends Model
{

  protected $table = 'professors';

  protected $allowedFields = ['id', 'facultycode', 'firstname', 'middlename', 'lastname', 'birthdate', 'position', 'status', 'user_id', 'created_at', 'updated_at'];

  function __construct(){
    parent::__construct();
  }


  public function insertProfessor($data)
  {
    $this->transStart();

      $user = new UserModel();
      $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
      $password = $data['facultycode'];
      $userData = [
        'faculty_code' => $data['facultycode'],
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'uniid' => $uniid,
        'email' => $data['email'],
        'first_name' => $data['firstname'],
        'middle_name' => $data['middlename'],
        'last_name' => $data['lastname'],
        'status' => 1,
        'role_id' => 3
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

  public function getProfessorByStatus($status, $role){
    $this->select('professors.id, professors.firstname, professors.lastname, professors.middlename, professors.facultycode, professors.user_id, user.username,user.email, role.role_name');
    $this->join('user', 'user.id = professors.user_id');
    $this->join('role', 'user.role_id = role.id');
    $this->where('user.status', $status);
    if ($role != null) {
      $this->where('role.id', $role);
    }
    return $this->findAll();
  }

  public function getDetail($condition = []){

    $this->select('professors.*');
    // $this->join('gender', 'professors.gender = gender.id');
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

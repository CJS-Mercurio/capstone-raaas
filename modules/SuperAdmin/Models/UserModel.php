<?php
namespace Modules\SuperAdmin\Models;
use \CodeIgniter\Model;

class UserModel extends Model{

	protected $table = 'user';
	protected $primaryKey = 'id';

	protected $allowedFields = ['username', 'email', 'password', 'first_name', 'middle_name', 'last_name', 'birthdate', 'gender', 'valid_id', 'academic_status', 'academic_year', 'batch_year', 'student_number', 'faculty_code', 'faculty_status', 'faculty_position', 'role_id', 'uniid', 'status', 'activation_date', 'deleted_at'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

	public function deactivate($id){

    $status = 2;

	  $builder = $this->db->table('user');
		$builder->where('id', $id);
		$builder->update(['status' => $status]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function activate($id){

    $status = 1;

		$builder = $this->db->table('user');
		$builder->where('id', $id);
		$builder->update(['status'=> $status]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

  public function getLoggedInUserRole($id){

    $builder = $this->db->table('user');
    $builder->where('uniid',$id);
    $result = $builder->get();

    if(count($result->getResultArray())==1){

      return $result->getRowArray();
      // return 8;
    }else{
      // return false;
      // return 9;
    }
  }

  public function getLoggedInUserData($id){

		$builder = $this->db->table('user');
		$builder->where('uniid',$id);
		$result = $builder->get();

		if(count($result->getResultArray())==1){

			return $result->getRow();
		}else{
			return false;
		}
	}

	public function findRoleID(){

    // SELECT
    //  user.first_name,
    //  user.last_name,
    //  role.role_name
    // FROM
    //      user
    // INNER JOIN role ON user.role_id = role.id
    // WHERE
    //     role.role_name LIKE '%admin%'

		$builder = $this->db->table('user');
		$builder->select("user.id AS uid, user.first_name, user.middle_name, user.last_name, user.role_id, role.id, role.role_name, user.status, user.deleted_at");
    $builder->join('role', 'user.role_id = role.id');
    $builder->where('user.first_name !=', NULL);

    $result = $builder->get();
    if(count($result->getResultArray()) > 0){

      $rows = $result->getResultArray();
      return $rows;

    }else{

      return false;
    }
	}


  public function getUserPermission($id){

    // SELECT
    // task.task_name
    // FROM
    //     task
    // INNER JOIN permission ON task.id = permission.task_id
    // WHERE permission.role_id = 1

    $builder = $this->db->table('task');
		$builder->select("task.task_name, task.id AS tid, task.deleted_at");
    $builder->join('permission', 'task.id = permission.task_id');
    $builder->where('permission.role_id', $id);

    $result = $builder->get();
    if(count($result->getResultArray()) > 0){

      $rows = $result->getResultArray();
      return $rows;

    }else{

      return false;
    }


  }

  public function approve_user_account($id){

    $status = 2;
    $builder = $this->db->table('user');
    $builder->where('id',$id);
    $builder->update(['status'=> $status, 'activation_date' => (new \DateTime())->format('Y-m-d H:i:s')]);

    if($this->db->affectedRows()>0){

      return true;
    }else{
      return false;
    }
  }

  public function disapprove_user_account($id){

    $builder = $this->db->table('user');
    $builder->where('id', $id);
    $builder->delete();

    if($this->db->affectedRows()>0){

      return true;
    }else{
      return false;
    }
  }

  public function verifyUniid($id){

		$builder = $this->db->table('user');
		$builder->select("activation_date, uniid, status");
		$builder->where('uniid', $id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function updateStatus($uniid){

		$status = 1;
		$builder = $this->db->table('user');
		$builder->where('uniid',$uniid);
		$builder->update(['status'=> $status]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}

	}

  public function getUserId($id){

    $builder = $this->db->table('user');
    $builder->select("id, uniid");
    $builder->where('uniid',$id);

    $result = $builder->get();
    if(count($result->getResultArray()) == 1){

      return $result->getRowArray();

    }else{

      return false;
    }
  }

  public function updatePassword($npwd, $id){

		$builder = $this->db->table('user');
		$builder->where('uniid',$id);
		$builder->update(['password'=>$npwd]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function getFacultyId($id){

		$builder = $this->db->table('user');
		$builder->select("id, first_name, last_name");
		$builder->where('id',$id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

}

<?php

namespace Modules\ForumManagement\Models;

/**
 *
 */
class ForumModel extends \CodeIgniter\Model{

	protected $table = 'forum';
	protected $primaryKey = 'id';

	protected $allowedFields = ['title', 'dateFrom', 'dateTo', 'location', 'parameter', 'start_posting', 'time', 'event_type', 'details', 'forum_image', 'reason_for_disapproval', 'status', 'submitted_name', 'submitted_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $returnType = 'array';


	public function getLoggedInUserData($id){

		$builder = $this->db->table('forum');
		$builder->where('uniid',$id);
		$result = $builder->get();

		if(count($result->getResultArray())==1){

			return $result->getRow();
		}else{
			return false;
		}
	}

	public function getUserForum($id){

		$builder = $this->db->table('forum');
		$builder->select('id, title, submitted_id, deleted_at');
		$builder->where('submitted_id',$id);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}
	}

	public function saveForum($data){

		$builder = $this->db->table('forum');
		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}

	}

	public function deactivate($id){

	  $builder = $this->db->table('forum');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function post($id){

	  $builder = $this->db->table('forum');
		$builder->where('id', $id);
		$builder->update(['status'=> 3]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function unpost($id){

		$builder = $this->db->table('forum');
		$builder->where('id', $id);
		$builder->update(['status'=> 4]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function approve($id){

				$builder = $this->db->table('forum');
				$builder->where('id', $id);
				$builder->update(['status'=> 1]);

				if($this->db->affectedRows()>0){

					return true;
				}else{
					return false;
				}
	}

	public function disapprove($id, $reason){

				$builder = $this->db->table('forum');
				$builder->where('id', $id);
				$builder->update(['status'=> 2, 'reason_for_disapproval' => $reason]);

				if($this->db->affectedRows()>0){

					return true;
				}else{
					return false;
				}

	}

	public function updateForumStatus($id){

		$builder = $this->db->table('forum');
		$builder->where('id', $id);
		$builder->update(['status'=> 0]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function updateDeleteStatusRestore($id){

		$builder = $this->db->table('forum');
		$builder->where('id', $id);
		$builder->update(['deleted_at'=>NULL]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}

	}

	public function getForum($title){

		$builder = $this->db->table('forum');
		$builder->select("id");
		$builder->where('title', $title);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}


}

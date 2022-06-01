<?php

namespace Modules\Professor\Models;

/**
 * 
 */
class ProfessorModel extends \CodeIgniter\Model{

	protected $table = 'professor';
	protected $primaryKey = 'id';

	protected $allowedFields = ['f_firstname', 'f_middlename','f_last_name', 'f_code', 'uniid', 'status'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $returnType = 'array';
	

	public function getLoggedInUserData($id){

		$builder = $this->db->table('professor');
		$builder->where('uniid',$id);
		$result = $builder->get();

		if(count($result->getResultArray())==1){

			return $result->getRow();
		}else{
			return false;
		}
	}

	public function updatePassword($npwd, $id){

		$builder = $this->db->table('professor');
		$builder->where('uniid',$id);
		$builder->update(['password'=>$npwd]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}


	public function getProfId($id){

		$builder = $this->db->table('professor');
		$builder->select("id, f_code, uniid");
		$builder->where('uniid',$id);

		$result = $builder->get();
		if(count($result->getResultArray()) == 1){

			return $result->getRowArray();

		}else{

			return false;
		}
	}

	public function approve_user_account($id){

		$status = 2;
		$builder = $this->db->table('professor');
		$builder->where('id',$id);
		$builder->update(['status'=> $status, 'activation_date' => (new \DateTime())->format('Y-m-d H:i:s')]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function disapprove_user_account($id){

		$builder = $this->db->table('professor');
		$builder->where('id', $id);
		$builder->delete();
		
		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}
	}

	public function verifyUniid($id){

		$builder = $this->db->table('professor');
		$builder->select("activation_date, uniid, status");
		$builder->where('uniid', $id);

		$result = $builder->get();
		
		if($builder->countAll() == 1){

			return $result->getRow();

		}else{

			return false;
		}
	}

	public function updateStatus($uniid){

		$status = 1;
		$builder = $this->db->table('professor');
		$builder->where('uniid',$uniid);
		$builder->update(['status'=> $status]);

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}

	}


	 public function search_prof($search){

		// SELECT
		//     *
		// FROM
		//     `professor`

		// INNER JOIN professor_seminar ON professor.id = professor_seminar.professor_id
		// WHERE
		//     `f_firstname` LIKE '%Anlas%' OR `f_lastname` LIKE '%Anlas%'


 		$builder = $this->db->table('professor');
		$builder->select("professor.id, professor.f_firstname, professor.f_lastname, professor_seminar.seminar_title, professor_seminar.sponsor, professor_seminar.venue, professor_seminar.event_date, professor_seminar.professor_id");
		$builder->join('professor_seminar', 'professor.id = professor_seminar.professor_id');
		$builder->like('f_firstname', $search); $builder->orLike('f_lastname', $search);


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}
 		
 	}

 	 public function search_pub($search){

		// SELECT
		//     *
		// FROM
		//     `professor`

		// INNER JOIN professor_seminar ON professor.id = professor_seminar.professor_id
		// WHERE
		//     `f_firstname` LIKE '%Anlas%' OR `f_lastname` LIKE '%Anlas%'


 		$builder = $this->db->table('professor');
		$builder->select("professor.id, professor.f_firstname, professor.f_lastname, published_research.research_title, published_research.publication, published_research.volume, published_research.institute, published_research.event_date, published_research.professor_id");
		$builder->join('published_research', 'professor.id = published_research.professor_id');
		$builder->like('f_firstname', $search); 
		$builder->orLike('f_lastname', $search);


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;
		
		}else{

			return false;
		}
 		
 	}
}
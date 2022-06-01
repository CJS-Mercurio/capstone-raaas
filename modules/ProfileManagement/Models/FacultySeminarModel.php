<?php
namespace Modules\ProfileManagement\Models;

/**
 *
 */
class FacultySeminarModel extends \CodeIgniter\Model{


	protected $table = 'faculty_seminar';
	protected $primaryKey = 'id';
	protected $allowedFields = ['faculty_id', 'event_title', 'sponsor', 'venue', 'date_attended'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

  public function getSeminar($id){

    $builder = $this->db->table('faculty_seminar');
    $builder->select('id, faculty_id, event_title, sponsor, venue, date_attended, deleted_at');
    $builder->where('faculty_id', $id);

    $result = $builder->get();
    if(count($result->getResultArray()) > 0){

      $rows = $result->getResultArray();
      return $rows;

    }else{

      return false;
    }
  }

  public function updateDeleteStatus($id){

    $builder = $this->db->table('faculty_seminar');
    $builder->where('id', $id);
    $builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

    if($this->db->affectedRows()>0){

      return true;
    }else{
      return false;
    }

  }

  public function seminar_report(){

    //     SELECT
    //     professors.firstname,
    //     faculty_seminar.event_title
    // FROM
    //     `professors`
    // INNER JOIN faculty_seminar ON faculty_seminar.faculty_id = professors.user_id
		$builder = $this->db->table('faculty_seminar');
    $builder->select("professors.user_id, professors.firstname, professors.lastname, faculty_seminar.id, faculty_seminar.event_title, faculty_seminar.sponsor, faculty_seminar.venue, faculty_seminar.date_attended, faculty_seminar.faculty_id, faculty_seminar.deleted_at");
    $builder->join('professors', 'professors.user_id = faculty_seminar.faculty_id');
		$builder->where("faculty_seminar.deleted_at", NULL);
		$builder->orderBy('faculty_seminar.faculty_id', 'ASC');



    $result = $builder->get();
    if(count($result->getResultArray()) > 0){

      $rows = $result->getResultArray();
      return $rows;

    }else{

      return false;
    }

  }

	public function per_seminar_report($id){
		//     SELECT
		//     professors.firstname,
		//     faculty_seminar.event_title
		// FROM
		//     `professors`
		// INNER JOIN faculty_seminar ON faculty_seminar.faculty_id = professors.user_id

		$builder = $this->db->table('faculty_seminar');
		$builder->select("professors.user_id, professors.firstname, professors.lastname, faculty_seminar.id, faculty_seminar.event_title, faculty_seminar.sponsor, faculty_seminar.venue, faculty_seminar.date_attended, faculty_seminar.faculty_id, faculty_seminar.deleted_at");
		$builder->join('professors', 'professors.user_id = faculty_seminar.faculty_id');
		$builder->where("faculty_seminar.deleted_at", NULL);
		$builder->where("faculty_seminar.faculty_id", $id);


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}
	}

  public function seminar_reportCSV(){

        $builder = $this->db->table('faculty_seminar');
        $builder->select("professors.firstname, professors.lastname, faculty_seminar.event_title, faculty_seminar.sponsor, faculty_seminar.venue, faculty_seminar.date_attended, faculty_seminar.deleted_at");
        $builder->join('professors', 'professors.user_id = faculty_seminar.faculty_id');
				$builder->where("faculty_seminar.deleted_at", NULL);

        $result = $builder->get();
        if(count($result->getResultArray()) > 0){

          $rows = $result->getResultArray();
          return $rows;

        }else{

          return false;
        }
  }

	public function per_seminar_reportCSV($id){

				$builder = $this->db->table('faculty_seminar');
				$builder->select("professors.firstname, professors.lastname, faculty_seminar.event_title, faculty_seminar.sponsor, faculty_seminar.venue, faculty_seminar.date_attended, faculty_seminar.deleted_at, professors.user_id");
				$builder->join('professors', 'professors.user_id = faculty_seminar.faculty_id');
				$builder->where("faculty_seminar.deleted_at", NULL);
				$builder->where("faculty_seminar.faculty_id", $id);


				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

					return false;
				}
	}

}//end class

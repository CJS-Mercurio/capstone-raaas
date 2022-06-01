<?php
namespace Modules\ProfileManagement\Models;

/**
 *
 */
class FacultyPublicationModel extends \CodeIgniter\Model{


	protected $table = 'faculty_publication';
	protected $primaryKey = 'id';
	protected $allowedFields = ['faculty_id', 'research_title', 'abstract', 'date_published', 'institute', 'volume', 'school_year', 'proof_publication', 'publication', 'deleted_at'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

  public function getPublication($id){

    $builder = $this->db->table('faculty_publication');
    $builder->select('id, faculty_id, research_title, abstract, school_year, volume, institute, proof_publication, publication, deleted_at');
    $builder->where('faculty_id', $id);

    $result = $builder->get();
    if(count($result->getResultArray()) > 0){

      $rows = $result->getResultArray();
      return $rows;

    }else{

      return false;
    }
  }

	public function getResearchDetails($id){
		$builder = $this->db->table('faculty_publication');
		$builder->select('id, faculty_id, research_title, abstract, date_published, publication, volume, institute, proof_publication, school_year');
		$builder->where('id', $id);

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			return $result->getRowArray();


		}else{

			return false;
		}

	}

  public function updateDeleteStatus($id){

    $builder = $this->db->table('faculty_publication');
    $builder->where('id', $id);
    $builder->update(['deleted_at'=>(new \DateTime())->format('Y-m-d H:i:s')]);

    if($this->db->affectedRows()>0){

      return true;
    }else{
      return false;
    }



  }

	public function completed_report($query){
		//for Completed

		$year_start = $query['year_start'];
		$year_end = $query['year_end'];

		$builder = $this->db->table('faculty_publication');
		$builder->select("faculty_publication.research_title, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute,  faculty_publication.abstract, faculty_publication.date_published, faculty_publication.school_year, faculty_publication.faculty_id, faculty_publication.deleted_at, user.id, user.first_name, user.last_name");
		$builder->join('user', 'user.id = faculty_publication.faculty_id');
		$builder->where("faculty_publication.deleted_at", NULL);
		$builder->where("faculty_publication.date_published", NULL);
		$builder->where("faculty_publication.school_year BETWEEN '$year_start' AND '$year_end'");

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;

		}

	}

	public function completed_reportPDF($start, $end){
		//for Completed

		$year_start = $start;
		$year_end = $end;

		$builder = $this->db->table('faculty_publication');
		$builder->select("faculty_publication.research_title, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute,  faculty_publication.abstract, faculty_publication.date_published, faculty_publication.school_year, faculty_publication.faculty_id, faculty_publication.deleted_at, user.id, user.first_name, user.last_name");
		$builder->join('user', 'user.id = faculty_publication.faculty_id');
		$builder->where("faculty_publication.deleted_at", NULL);
		$builder->where("faculty_publication.date_published", NULL);
		$builder->where("faculty_publication.school_year BETWEEN '$year_start' AND '$year_end'");


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{
				return false;

		}

	}


	public function per_completed_report($query){
		//for Completed

		$year_start = $query['year_start'];
		$year_end = $query['year_end'];

		$builder = $this->db->table('faculty_publication');
		$builder->select("faculty_publication.research_title, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute,  faculty_publication.abstract, faculty_publication.date_published, faculty_publication.school_year, faculty_publication.faculty_id, faculty_publication.deleted_at, user.id, user.first_name, user.last_name ");
		$builder->join('user', 'user.id = faculty_publication.faculty_id');
		$builder->where("faculty_publication.deleted_at", NULL);
		$builder->where("faculty_publication.date_published", NULL);
		$builder->where("faculty_publication.school_year BETWEEN '$year_start' AND '$year_end'");
		$builder->where('faculty_publication.faculty_id', $query['faculty']);


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			$builder = $this->db->table('faculty_publication');
			$builder->select("research_title, publication, volume, institute,  abstract, date_published, school_year, faculty_id, deleted_at");
			$builder->where("deleted_at", NULL);
			$builder->where("date_published", NULL);
			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->where('faculty_id', $query['faculty']);


			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				return false;
			}
		}
	}

	public function per_completed_reportPDF($start, $end, $id){
		//for Completed

		$year_start = $start;
		$year_end = $end;

		$builder = $this->db->table('faculty_publication');
		$builder->select("faculty_publication.research_title, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute,  faculty_publication.abstract, faculty_publication.date_published, faculty_publication.school_year, faculty_publication.faculty_id, faculty_publication.deleted_at, user.id, user.first_name, user.last_name ");
		$builder->join('user', 'user.id = faculty_publication.faculty_id');
		$builder->where("faculty_publication.deleted_at", NULL);
		$builder->where("faculty_publication.date_published", NULL);
		$builder->where("faculty_publication.school_year BETWEEN '$year_start' AND '$year_end'");
		$builder->where('faculty_publication.faculty_id', $id);


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			$year_start = $start;
			$year_end = $end;

			$builder = $this->db->table('faculty_publication');
			$builder->select("research_title, publication, volume, institute, abstract, date_published, school_year, faculty_id, deleted_at");
			$builder->where("deleted_at", NULL);
			$builder->where("date_published", NULL);
			$builder->where("school_year BETWEEN '$year_start' AND '$year_end'");
			$builder->where('faculty_id', $id);


			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				return false;
			}
		}
	}

	public function published_report($query){
		//for published

		$year_start = $query['year_start'];
		$year_end = $query['year_end'];

		$builder = $this->db->table('faculty_publication');
		$builder->select("faculty_publication.research_title, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute,  faculty_publication.abstract, faculty_publication.date_published, faculty_publication.school_year, faculty_publication.faculty_id, faculty_publication.deleted_at, user.id, user.first_name, user.last_name");
		$builder->join('user', 'user.id = faculty_publication.faculty_id');
		$builder->where("faculty_publication.deleted_at", NULL);
		$builder->where("faculty_publication.date_published !=", NULL);
		$builder->where("YEAR(faculty_publication.date_published) BETWEEN '$year_start' AND '$year_end'");
// 		$builder->orderBy('YEAR(date_published)', 'DESC'); 


		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{
				return false;

		}
	}

	public function published_reportPDF($start, $end){
		//for published
		$year_start = $start;
		$year_end = $end;

		$builder = $this->db->table('faculty_publication');
			$builder->select("faculty_publication.research_title, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute,  faculty_publication.abstract, faculty_publication.date_published, faculty_publication.school_year, faculty_publication.faculty_id, faculty_publication.deleted_at, user.id, user.first_name, user.last_name");
		$builder->join('user', 'user.id = faculty_publication.faculty_id');
		$builder->where("faculty_publication.deleted_at", NULL);
		$builder->where("faculty_publication.date_published !=", NULL);
		$builder->where("YEAR(faculty_publication.date_published) BETWEEN '$year_start' AND '$year_end'");
		$builder->orderBy('YEAR(faculty_publication.date_published)', 'DESC'); 

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{
				return false;

		}
	}


	public function per_published_report($query){
		//for published

		$year_start = $query['year_start'];
		$year_end = $query['year_end'];

		$builder = $this->db->table('faculty_publication');
		$builder->select("faculty_publication.research_title, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute,  faculty_publication.abstract, faculty_publication.date_published, faculty_publication.school_year, faculty_publication.faculty_id, faculty_publication.deleted_at, user.id, user.first_name, user.last_name ");
		$builder->join('user', 'user.id = faculty_publication.faculty_id');
		$builder->where("faculty_publication.deleted_at", NULL);
		$builder->where("faculty_publication.date_published !=", NULL);
    	$builder->where("YEAR(faculty_publication.date_published) BETWEEN '$year_start' AND '$year_end'");
		$builder->where('faculty_publication.faculty_id', $query['faculty']);
		$builder->orderBy('YEAR(faculty_publication.date_published)', 'DESC'); 
		

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}
	}

	public function per_published_reportPDF($start, $end, $id){
		//for published

		$year_start = $start;
		$year_end = $end;

		$builder = $this->db->table('faculty_publication');
		$builder->select("faculty_publication.research_title, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute,  faculty_publication.abstract, faculty_publication.date_published, faculty_publication.school_year, faculty_publication.faculty_id, faculty_publication.deleted_at, user.id, user.first_name, user.last_name ");
		$builder->join('user', 'user.id = faculty_publication.faculty_id');
		$builder->where("faculty_publication.deleted_at", NULL);
		$builder->where("faculty_publication.date_published !=", NULL);
		$builder->where("YEAR(date_published) BETWEEN '$year_start' AND '$year_end'");
		$builder->where('faculty_publication.faculty_id', $id);
		$builder->orderBy('YEAR(date_published)', 'DESC'); 

		$result = $builder->get();
		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			$builder = $this->db->table('faculty_publication');
			$builder->select("research_title, publication, volume, institute,  abstract, date_published, school_year, faculty_id, deleted_at");
			$builder->join('user', 'user.id = faculty_publication.faculty_id');
			$builder->where("deleted_at", NULL);
			$builder->where("date_published !=", NULL);
			$builder->where("YEAR(date_published) BETWEEN '$year_start' AND '$year_end'");
			$builder->where('faculty_id', $id);
			$builder->orderBy('YEAR(date_published)', 'DESC'); 

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				return false;
			}
		}
	}
	//printing CSVVVVVV
	public function completed_reportCSV($start, $end){

		$builder = $this->db->table('faculty_publication');
		$builder->select("research_title, abstract, school_year, deleted_at, faculty_id");
		$builder->where("school_year BETWEEN '$start' AND '$end'");
		$builder->where("date_published", NULL);
		$builder->where("deleted_at", NULL);

				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

						return false;
				}
	}

	public function published_reportCSV($start, $end){



				$builder = $this->db->table('faculty_publication');
				$builder->select("user.first_name, user.last_name, faculty_publication.research_title, faculty_publication.abstract, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute, faculty_publication.school_year, faculty_publication.date_published, faculty_publication.deleted_at");
				$builder->join('user', 'user.id = faculty_publication.faculty_id');
				$builder->where("faculty_publication.date_published !=", NULL);
				$builder->where("YEAR(faculty_publication.date_published) BETWEEN '$start' AND '$end'");
				$builder->where("faculty_publication.deleted_at", NULL);

				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

						return false;

				}
	}

	public function per_completed_reportCSV($start, $end, $id){


				$builder = $this->db->table('faculty_publication');
				$builder->select("professors.firstname, professors.lastname, faculty_publication.research_title, faculty_publication.abstract, faculty_publication.school_year, faculty_publication.deleted_at, faculty_publication.faculty_id, professors.user_id");
				$builder->join('professors', 'professors.user_id = faculty_publication.faculty_id');
				$builder->where("faculty_publication.school_year BETWEEN '$start' AND '$end'");
				$builder->where("faculty_publication.date_published", NULL);
				$builder->where("faculty_publication.deleted_at", NULL);
				$builder->where('faculty_publication.faculty_id', $id);


				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

					$builder = $this->db->table('faculty_publication');
					$builder->select("research_title, abstract, school_year, deleted_at, faculty_id");
					$builder->where("school_year BETWEEN '$start' AND '$end'");
					$builder->where("date_published", NULL);
					$builder->where("deleted_at", NULL);
					$builder->where('faculty_id', $id);


					$result = $builder->get();
					if(count($result->getResultArray()) > 0){

						$rows = $result->getResultArray();
						return $rows;

					}else{

						return false;
					}
				}
	}

	public function per_published_reportCSV($start, $end, $id){


				$builder = $this->db->table('faculty_publication');
				$builder->select("professors.firstname, professors.lastname, faculty_publication.research_title, faculty_publication.abstract, faculty_publication.publication, faculty_publication.volume, faculty_publication.institute, faculty_publication.school_year, faculty_publication.date_published, faculty_publication.deleted_at, professors.user_id,faculty_publication.faculty_id ");
				$builder->join('professors', 'professors.user_id = faculty_publication.faculty_id');
				$builder->where("YEAR(faculty_publication.date_published) BETWEEN '$start' AND '$end'");
				$builder->where("faculty_publication.date_published !=", NULL);
				$builder->where("faculty_publication.deleted_at", NULL);
				$builder->where('faculty_publication.faculty_id', $id);


				$result = $builder->get();
				if(count($result->getResultArray()) > 0){

					$rows = $result->getResultArray();
					return $rows;

				}else{

					$builder = $this->db->table('faculty_publication');
					$builder->select("research_title, abstract, school_year, date_published, deleted_at, faculty_id ");
			  	$builder->where("school_year BETWEEN '$start' AND '$end'");
					$builder->where("date_published !=", NULL);
					$builder->where("deleted_at", NULL);
					$builder->where('faculty_id', $id);


					$result = $builder->get();
					if(count($result->getResultArray()) > 0){

						$rows = $result->getResultArray();
						return $rows;

					}else{

						return false;
					}
				}
	}



}//end class

<?php
namespace Modules\ResearchManagement\Models;

/**
 *
 */
class UserFavoriteModel extends \CodeIgniter\Model{


	protected $table = 'user_favorite';
	protected $primaryKey = 'id';
	protected $allowedFields = ['document_id', 'user_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

 	public function check_favorite($did, $uid){

			// 		SELECT
			//     *
			// FROM
			//     `user_favorite`
			// INNER JOIN USER ON user_favorite.user_id = user.id
			// WHERE user_favorite.document_id = 18

			$builder = $this->db->table('user_favorite');
			$builder->select('user_favorite.user_id, user_favorite.document_id');
			$builder->join('user', 'user_favorite.user_id = user.id');
			$builder->where('user_favorite.document_id', $did);
			$builder->where('user_favorite.user_id', $uid);

			$result = $builder->get();
			if(count($result->getResultArray()) > 0){

				$rows = $result->getResultArray();
				return $rows;

			}else{

				return false;
			}
	}

	public function deleteFavorite($did, $uid){

		$builder = $this->db->table('user_favorite');
		$builder->where('user_id', $uid);
		$builder->where('document_id', $did);
		$builder->delete();

		if($this->db->affectedRows()>0){

			return true;
		}else{
			return false;
		}

	}

	public function my_library($id){


						// 		SELECT
					//     document.id,
					//     document.title
					// FROM
					//     document
					// INNER JOIN user_favorite ON user_favorite.document_id = document.id AND user_favorite.user_id = 1

					$builder = $this->db->table('document');
					$builder->select('course.course_name, course.id AS cid, document.course_id, document.category_id, document.id, document.abstract, document.title, document.research_status, document.school_year, document.deleted_at');
					$builder->join('course', 'document.course_id = course.id');
					$builder->join('document_type', 'document_type.id = document.document_type_id');
					$builder->join('user_favorite', 'user_favorite.document_id = document.id AND user_favorite.user_id ='. $id);

					$result = $builder->get();
					if(count($result->getResultArray()) > 0){

						$rows = $result->getResultArray();
						return $rows;

					}else{

						return false;
					}
				}

		}//end class

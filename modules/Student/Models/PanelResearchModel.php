<?php
namespace Modules\Student\Models;

/**
 *
 */
class PanelResearchModel extends \CodeIgniter\Model{


	protected $table = 'panel_research';
	protected $primaryKey = 'id';
	protected $allowedFields = ['student_id', 'research_id'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $returnType = 'array';

 	public function createResearchPanelist($data){

		$builder = $this->db->table('research_panel');
		$res = $builder->insert($data);
		if($this->db->affectedRows() ==  1){

			return true;
		}else{

			return false;
		}


	}

	public function getResearchPanelist($id){


		// SELECT faculty.f_firstname FROM faculty INNER JOIN research_panel ON research_panel.panel_id = faculty.id AND research_panel.research_id = 44

		$builder = $this->db->table('panel');
		$builder->select('panel.first_name, panel.last_name');
		$builder->join('research_panel', 'research_panel.panel_id = panel.id AND research_panel.research_id =' .$id);
		$result = $builder->get();

		if(count($result->getResultArray()) > 0){

			$rows = $result->getResultArray();
			return $rows;

		}else{

			return false;
		}


	}

	public function deleteResearchPanelist($id){

		$builder = $this->db->table('research_panel');
		$builder->where('research_id', $id);
		$builder->delete();

		if($this->db->affectedRows() > 0){
			return true;
		}else{
			return false;
		}

	}


}

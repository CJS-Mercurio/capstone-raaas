<?php namespace Modules\Student\Models;

use CodeIgniter\Model;

class AuthorsResearchModel extends Model{

  protected $table ='document';

  public function getResearch($id){

    $this->select('title as rtitle, first_name as rfn, middle_name as rmn, last_name as rln, slugs, course_name, date_submitted, document.created_at');

    $this->join('document_author ', 'document.id=document_author.document_id');
    $this->join('user','user.id = document_author.author_id');
    $this->join('course','course.id = document.course_id');
    $this->where('document_author.document_id', $id);
    // echo JSON_encode($this->findAll());
    // die('berna');
      // $this->select('ResearchTitle, AuthorLastname, AuthorFirstname, AuthorMiddlename');
      // $this->join('tbl_authors','tbl_authors.AuthorID =tbl_authorsresearch.AuthorID ');
      // $this->join('tbl_researchfiles', 'tbl_researchfiles.ResearchID=tbl_authorsresearch.ResearchID');
      // $this->where('tbl_authorsresearch.ResearchID', $id);
    return $this->findAll();
  }
}

<?php

namespace App\Validation;

class SchoolYearRule 
{
	public function valid_SY($year_end=null, $year_start=null){

		if($year_end > $year_start){
			return true;
		}else{
			return false;
		}
	}
	
}
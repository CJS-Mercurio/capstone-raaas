<?php 
namespace App\Controllers;

//use App\Database\Seeds;

class Migrate extends \CodeIgniter\Controller
{
    public function index()
    {
        $migrate = \Config\Services::migrations();

        try
        {
          if($migrate->latest())
          {
            echo "Successfully migrated";
          }
        }
        catch (\Exception $e)
        {
          die("error in migrations");
        }
    }

        public function movedown($regressBatchLevel)
    {
        $migrate = \Config\Services::migrations();
        try
        {
          if($migrate->regress($regressBatchLevel))
          {
            echo "Successfully migrated down ".$version;
          }
        }
        catch (\Exception $e)
        {
          die("error in migrations");
        }
    }
    
}
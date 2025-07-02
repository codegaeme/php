<?php

namespace App\Controllers\Client;
use App\Models\Client\Custommer;
use App\Models\Auth\Authenication;
use App\Midderware\loginMidderware;

class CustommerController
{
   public $cus;
    public $check;
    

    public function __construct()
    {
        $this ->cus = new Custommer();
        $this->check =new loginMidderware();
        $this->check ->checklogin();
      
       
    }

   
 
    public function index(){
        $id=$_SESSION['user_id'];
        $listCus=$this->cus->getListCus($id);
        require_once __DIR__ . "/../../Views/client/cus.php";
    }
    public function store()
    {
     require_once __DIR__ . "/../../Views/client/cus/addCus.php";
    }

    public function edit()
    {
        $data=[];
    }

    public function update()
    {

    }
    public function delete()
    {

    }
}
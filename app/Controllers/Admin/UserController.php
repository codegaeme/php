<?php

namespace App\Controllers\Admin;
use App\Midderware\Midderware;
use App\Models\Auth\Authenication;
class UserController{
  public $midderlware;
  public $auth;

  public function __construct(){
   $this->auth =new Authenication();

  $this-> midderlware = new Midderware;
  $this-> midderlware->checkadmin();
  }
    public function index(){
       
        $listUser = $this->auth->listUser();
        require_once __DIR__ . "/../../Views/admin/list-user.php";
        
      }
    
     
}

<?php
namespace App\Midderware;
class loginMidderware{
    public function checklogin(){
        if(empty($_SESSION['user_id'])){
          $_SESSION['message_erorr']="Vui lòng đăng nhập để tiếp tục";
          header('location: ' . BASE_URL . 'login'); 
        }
      }
}
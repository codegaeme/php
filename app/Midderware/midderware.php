<?php
namespace App\Midderware;
class Midderware{
    public function checkadmin(){
        if(empty($_SESSION['user_id'])){
          $_SESSION['message_erorr']="Vui lòng đăng nhập để tiếp tục";
          header('location: ' . BASE_URL . 'login'); 
        }else{

            if ($_SESSION['user_role']!=1) {
                header('location: ' . BASE_URL . 'home'); 
            }
         
        
        }
      }
}
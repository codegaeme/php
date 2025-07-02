<?php

namespace App\Controllers\Admin;
use App\Midderware\Midderware;
use App\Models\Auth\Authenication;
use App\Models\Admin\OrderAdmin;

class OrderAdminController{
  public $midderlware;
  public $auth;
  public $order;

  public function __construct(){
  

  $this-> midderlware = new Midderware;
  $this-> midderlware->checkadmin();
  $this->order =new OrderAdmin();
  }
    public function index(){
       $status=1;
    $a=$this->order->getlistOrder($status);

        require_once __DIR__ . "/../../Views/admin/order/order-pending.php";
        
      }
      public function detail($id_oder){
        $detailOder=$this->order->detailListOrder($id_oder);
        require_once __DIR__ . "/../../Views/admin/order/detail-order.php";
      }
      public function confirm($id_oder){
        if(isset($id_oder)){
            
          $detailOder=$this->order->detailListOrder($id_oder);
          
                $detailOder['order_status']=2;
                $this->order->updateStatus($id_oder,$detailOder['order_status']);
               
            
            $_SESSION['message_success'] = " Đơn hàng đã được xác nhận!";
            header('Location: ' . BASE_URL . 'admins/order/');
            exit();
           
          
        }
    }
    public function ship(){
      $status=2;
   $a=$this->order->getlistOrder($status);

       require_once __DIR__ . "/../../Views/admin/order/order-ship.php";
       
     }
     public function confirmShip($id_oder){
      if(isset($id_oder)){
          
        $detailOder=$this->order->detailListOrder($id_oder);
        
              $detailOder['order_status']=3;
              $this->order->updateStatus($id_oder,$detailOder['order_status']);
             
          
          $_SESSION['message_success'] = " Đơn hàng được chuyển qua đơn vị vận chuyển!";
          header('Location: ' . BASE_URL . 'admins/order/ship');
          exit();
         
        
      }
  }
  public function confirmShipNow($id_oder){
    if(isset($id_oder)){
        
      $detailOder=$this->order->detailListOrder($id_oder);
      
            $detailOder['order_status']=4;
            $detailOder['order_payment_status']=2;
            $this->order->updateStatus($id_oder,$detailOder['order_status']);
            $this->order->updatePaymenStatus($id_oder,$detailOder['order_payment_status']);
           
        
        $_SESSION['message_success'] = " Đơn hàng đã được giao thành công!";
        header('Location: ' . BASE_URL . 'admins/order/shipnow');
        exit();
       
      
    }
}

  public function complate(){
    
    $status=4;
 $a=$this->order->getlistOrder($status);
 
count($a);
     require_once __DIR__ . "/../../Views/admin/order/order-complate.php";
     
   }
   
   public function fail(){
    $status=5;
 $a=$this->order->getlistOrder($status);
count($a);
     require_once __DIR__ . "/../../Views/admin/order/order-complate.php";
     
   }
   public function shipnow(){
    $status=3;
 $a=$this->order->getlistOrder($status);

     require_once __DIR__ . "/../../Views/admin/order/order-shipnow.php";
     
   }

    
     
}

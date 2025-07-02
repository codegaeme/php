<?php

namespace App\Controllers\Admin;
use App\Midderware\Midderware;
use App\Models\Admin\Thongke;
class DashboardController{
  public $midderlware;
  public $tk;

  public function __construct(){
   

  $this-> midderlware = new Midderware;
  $this-> midderlware->checkadmin();
  $this-> tk=new Thongke();
  }
    public function index(){
      // $total_orders=$this->tk->getTotalOrders();
      // $doanhthu =$this->tk->getTotalRevenue();
      $stats = $this->tk->getAllStatistics();

        require_once "app/Views/admin/main.php";
        
      }
  
     
    
     
}

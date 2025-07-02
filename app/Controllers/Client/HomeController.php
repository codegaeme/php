<?php

namespace App\Controllers\Client;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Auth\Authenication;
class HomeController{
  public $cate;
  public $products;


  public function __construct() {
     
      $this->cate = new Category();
      $this->products = new Product();
      
  }
  public function index(){
    $listPro=$this->products->listProduct();
    $listCate=$this->cate->listcate();
    require_once __DIR__ . "/../../Views/client/home.php";
  }
  public function probytype($id){
    $listCate=$this->cate->listcate();
    $listPro=$this->products->listProductbytype($id);
    $detailCate=$this->cate->detailCate($id);
    require_once __DIR__ . "/../../Views/client/probytype.php";
  }
  public function prodetail($id){
    $listCate=$this->cate->listcate();
    $detail=$this->products->detailProduct($id);
    
    require_once __DIR__ . "/../../Views/client/prodetail.php";
  }
  public function shop(){
    $listPro=$this->products->listProduct();
    $listCate=$this->cate->listcate();
    require_once __DIR__ . "/../../Views/client/shop.php";
  }
  public function search() {
    $listCate=$this->cate->listcate();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['q'])) {
        $keyword = trim($_POST['q']);
        $products = $this->products->searchProducts($keyword);
        require_once __DIR__ . "/../../Views/client/seach.php";
    } else {
      $_SESSION['message_err']="Không tìm thấy kết quả";
      header('Location: ' . BASE_URL );
        exit;
    }
}

}
<?php

namespace App\Controllers\Admin;
use App\Models\Admin\Category;
use App\Midderware\Midderware;

class CategoriesController {

    public $cate;
    public $midderlware;
    public function __construct() {
        $this-> midderlware = new Midderware;
        $this-> midderlware->checkadmin();
        $this->cate = new Category();

    }
    
    public function index() {
      $listCate=$this->cate->getList();
     
        require_once __DIR__ . "/../../Views/admin/danhmuc/list.php";
    }
    
    public function create() {
        require_once __DIR__ . "/../../Views/admin/danhmuc/add.php";
    }
    
    public function store() {
        $name = $_POST['name_categories'];
        $status=$_POST['status'];
        $messageError = $this->validate($name);
        if(count($messageError) == 0){
        
            
            
            $this->cate->addCate($name,$status);
            $_SESSION['message_success']="Thêm danh mục thành công";
            header('location: ' . BASE_URL . 'admins/categories'); 
            
        }else{
          
            require_once __DIR__ . "/../../Views/admin/danhmuc/add.php";
        }
    }
    
    public function edit($id) {
      $detailCate = $this->cate->detailCate($id);
      require_once __DIR__ . "/../../Views/admin/danhmuc/edit.php";
    }
    
    public function update($id) {
        $name = $_POST['name_categories'];
        $status= $_POST['status'];
        

        $messageError = $this->validate($name);

        if(count($messageError) == 0){
           
           
            

            $this->cate->updateCate($id,$name,$status);
            $_SESSION['message_success']="Sửa danh mục thành công";
            header('location: ' . BASE_URL . 'admins/categories'); 
        }else{
            $detailCate = $this->cate->detailCate($id);
              require_once __DIR__ . "/../../Views/admin/danhmuc/edit.php";
        }
    }
    
    public function delete($id) {
        $this->cate->deleteCate($id);
        $_SESSION['message_success']="Xóa danh mục thành công";
        header('location: ' . BASE_URL . 'admins/categories'); 
    }
    public function validate($name){
        $messageError = [];

        if (empty($name)) {
            $messageError['name'] = "Không được để trống tên sản phẩm.";
        }
       

        return $messageError;
    }
}

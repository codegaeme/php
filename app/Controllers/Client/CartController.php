<?php

namespace App\Controllers\Client;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Auth\Authenication;
use App\Midderware\loginMidderware;

class CartController
{
    public $products;
    public $check;
    public $cate;
    public function __construct()
    {
        $this->check =new loginMidderware();
        $this->check ->checklogin();
        $this->products = new Product();
        $this->cate = new Category();
    }

   
 

    public function addCart()
    {
        $id_user=$_POST['id_user'];
        $id_product = $_POST['id'];
        $soluongdat = $_POST['quantity'];
        $product = $this->products->detailProduct($id_product);

        if ($soluongdat < 1) {
            $_SESSION['message_error'] = "Số lượng không được bé hơn 1";
            header('Location: ' . BASE_URL .  $id_product.'/prodetail' );
            exit();
        } else if ($soluongdat > $product->quantity) {
            $_SESSION['message_error'] = "Số lượng không được nhiều hơn số lượng sản phẩm hiện có";
            header('Location: ' . BASE_URL .  $id_product.'/prodetail' );
            exit();
        }

        // Khởi tạo giỏ hàng nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Thêm hoặc cập nhật sản phẩm trong giỏ hàng
        if (isset($_SESSION['cart'][$id_product])) {
            $_SESSION['cart'][$id_product]['so_luong_dat'] += $soluongdat;
        } else {
            $_SESSION['cart'][$id_product] = [
                'product_id'=>$id_product,
                'id_user' =>$id_user,
                'name' => $product->name,
                'so_luong_con' => $product->quantity,
                'so_luong_dat' => $soluongdat,
                'price' => $product->price_sale ?? $product->price,
                'image' => $product->img_thumbnail,
            ];
        }

        $_SESSION['message_success'] = "Thêm giỏ hàng thành công";
        header('Location: ' . BASE_URL . $id_product . '/prodetail');
        exit();
    }

    public function listCart()
    {
        
        $cart = $_SESSION['cart'] ?? [];
  
      
        $listCate = $this->cate->listcate();
        require_once __DIR__ . "/../../Views/client/cart.php";
    }

    public function updateCart($id, $change)
    {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['so_luong_dat'] += $change;
            if ($_SESSION['cart'][$id]['so_luong_dat'] < 1) {
                unset($_SESSION['cart'][$id]);
            }
        }
        header('Location: ' . BASE_URL . 'cart');
        exit();
    }

    public function removeCart($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('Location: ' . BASE_URL . 'cart');
        exit();
    }


    

    
    
    





    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }
    public function delete()
    {

    }
}
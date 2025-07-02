<?php

namespace App\Controllers\Client;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Auth\Authenication;
use App\Midderware\loginMidderware;
use App\Models\Client\User;
use App\Models\Client\Order;
use App\Models\Client\Custommer;

class OrderController
{
    public $user;
    public $cus;
    public $products;
    public $check;
    public $cate;
    public $oder;

    public function __construct()
    {
        $this->check = new loginMidderware();
        $this->check->checklogin();
        $this->cus = new Custommer();
        $this->oder = new Order();
        $this->user = new User();
        $this->products = new Product();
        $this->cate = new Category();
    }

    public function order()
    {

        $cart = $_SESSION['cart'] ?? [];



        $id_user = $_SESSION['user_id'];
        $email = $this->user->detailUser($id_user);

        if (isset($_POST['id_cus'])) {
            $id_cus = $_POST['id_cus'];

            $user_information = $this->cus->getCusById($id_cus, $id_user);
        }

        $listCate = $this->cate->listcate();

        require_once __DIR__ . "/../../Views/client/order.php";
    }

    public function store()
    {
        $orderData = $_POST;
        $cart = $_SESSION['cart'] ?? [];




        $messageError = $this->validate($orderData);
        if (empty($messageError)) {

            $id_user = $_SESSION['user_id'];
            $id_cus = $this->cus->getOrAddCus($orderData['name'], $orderData['address'], $orderData['tel'], $id_user);
            $payment = $orderData['payment'];
            $total_price = $orderData['total'];

            $order_id = $this->oder->order($id_user, $id_cus, $total_price, $payment);

            if ($order_id) {
                $total_price = 0;
                foreach ($cart as $item) {
                    $stook = $item['so_luong_con'];
                    $quantity = $item['so_luong_dat'];
                    $total = $item['price'] * $quantity;
                    $total_price += $total;


                    if ($stook >= $quantity) {
                        $this->oder->addOrderDetail($order_id, $item['product_id'], $quantity, $item['price'], $total_price);


                        $this->products->reduceStock($item['product_id'], $quantity);
                    } else {
                        $_SESSION['message_error'] = "Số lượng trong kho không đủ vui lòng cập nhật lại giỏ hàng";
                        $cart = $_SESSION['cart'] ?? [];


                        $listCate = $this->cate->listcate();
                        require_once __DIR__ . "/../../Views/client/cart.php";
                  
                    }

                }

                unset($_SESSION['cart']);
                $_SESSION['message_success'] = "Đặt hàng thành công!";
                header('Location: ' . BASE_URL . 'order/list');
                exit();
            }
        } else {
            $cart = $_SESSION['cart'] ?? [];
            $id_user = $_SESSION['user_id'];
            $email = $this->user->detailUser($id_user);

            if (isset($_POST['id_cus'])) {
                $id_cus = $_POST['id_cus'];
                $user_information = $this->cus->getCusById($id_cus, $id_user);
            }
            $listCate = $this->cate->listcate();

            require_once __DIR__ . "/../../Views/client/order.php";
        }
    }

    public function list()
    {
        $listCate = $this->cate->listcate();
        $id_user = $_SESSION['user_id'];
        $listOrder = $this->oder->listOderByUser($id_user);
        require_once __DIR__ . "/../../Views/client/oderlist.php";
    }
    public function detail($id_oder){
        $id_user=$_SESSION['user_id']; 
    
        
        $detailOder=$this->oder->getOrderDetailByUser($id_user,$id_oder);
        require_once __DIR__ . "/../../Views/client/oderdetail.php";
    }
    public function huy($id_oder){
        if(isset($id_oder)){
            $id_user=$_SESSION['user_id']; 
            $detailOder=$this->oder->getOrderDetailByUser($id_user,$id_oder);
            if ($detailOder['order_status']==1 || $detailOder['order_status']==2) {
                $detailOder['order_status']=5;
                $this->oder->updateStatus($id_oder,$detailOder['order_status']);
                $quantity=-$detailOder['quantity'];
                
                $this->products->reduceStock($detailOder['product_id'], $quantity);
               
            }
            else {
                $_SESSION['message_error'] = " Không thể hủy đơn hàng lúc này !";
                header('Location: ' . BASE_URL . 'order/list');
                exit();
            }
            $_SESSION['message_success'] = " Đơn hàng đã được hủy !";
            header('Location: ' . BASE_URL . 'order/list');
            exit();
           
          
        }
    }

    // 🟢 Hàm kiểm tra dữ liệu trước khi đặt hàng
    public function validate($order)
    {
        $messageError = [];

        if (empty($order['name'])) {
            $messageError['name'] = "Tên người nhận không được để trống.";
        }
        if (empty($order['email']) || !filter_var($order['email'], FILTER_VALIDATE_EMAIL)) {
            $messageError['email'] = "Email không hợp lệ.";
        }
        if (empty($order['tel']) || !preg_match('/^[0-9]{10,11}$/', $order['tel'])) {
            $messageError['tel'] = "Số điện thoại không hợp lệ.";
        }
        if (empty($order['address'])) {
            $messageError['address'] = "Địa chỉ không được để trống.";
        }
        if (!isset($order['payment']) || !in_array($order['payment'], ['1', '2'])) {
            $messageError['payment'] = "Hình thức thanh toán không hợp lệ.";
        }

        return $messageError;
    }
}
?>
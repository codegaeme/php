<?php

namespace App\Controllers\Admin;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Midderware\Midderware;

class ProductController {
    public $cate;
    public $products;
    public $midderlware;

    public function __construct() {
        $this-> midderlware = new Midderware;
        $this-> midderlware->checkadmin();
        $this->cate = new Category();
        $this->products = new Product();
        
    }

    public function index() {
        $listPro = $this->products->listProduct();
        require_once __DIR__ . "/../../Views/admin/sanphams/list.php";
    }

    public function create() {
        $listCate = $this->cate->getList();
        require_once __DIR__ . "/../../Views/admin/sanphams/add.php";
    }

    public function store() {
        $data = $_POST;
        $data['image'] = $_FILES['image'];

        $messageError = $this->validate($data);
        
        if (empty($messageError)) {
            $linkImage = null;
            if (!empty($data['image']['name'])) {
                $uploadDir = __DIR__ . "/../../assets/image/uploads/products/";
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $photo = time() . "_" . preg_replace("/[^A-Za-z0-9.\-_]/", "", $data['image']['name']);
                $targetFilePath = $uploadDir . $photo;

                if (move_uploaded_file($data['image']['tmp_name'], $targetFilePath)) {
                    $linkImage = "assets/image/uploads/products/" . $photo;
                } else {
                    $messageError['image'] = "Không thể tải ảnh lên.";
                }
            }

            if (empty($messageError)) {
                $this->products->addProduct($data['name'], $data['category_id'], $data['product_code'], $linkImage, $data['quantity'], $data['description'], $data['content'], $data['status'], $data['price'], $data['price_sale']);
                $_SESSION['message_success'] = "Thêm sản phẩm thành công!";
                header('Location: ' . BASE_URL . '/admins/products');
                exit();
            }
        }

        $listCate = $this->cate->getList();
        require_once __DIR__ . "/../../Views/admin/sanphams/add.php";
    }
   
        public function edit($id) {
            // Lấy thông tin sản phẩm cần sửa
            $product = $this->products->detailProduct($id);
            if (!$product) {
                $_SESSION['error'] = "Sản phẩm không tồn tại!";
                header('Location: ' . BASE_URL . '/admins/products');
                exit();
            }
        
            // Lấy danh sách danh mục để hiển thị trong form
            $listCate = $this->cate->getList();
        
            // Load view hiển thị form sửa sản phẩm
            require_once __DIR__ . "/../../Views/admin/sanphams/edit.php";
        }
        
    
        public function update($id) {
            // Lấy sản phẩm từ database
            $product = $this->products->detailProduct($id);
            if (!$product) {
                $_SESSION['error'] = "Sản phẩm không tồn tại!";
                header('Location: ' . BASE_URL . '/admins/products');
                exit();
            }
        
            $data = $_POST;
            $data['image'] = $_FILES['image'];
        
            $messageError = $this->validate($data); // Không bắt buộc ảnh
        
            if (empty($messageError)) {
                $linkImage = $product->img_thumbnail; // Giữ nguyên ảnh cũ nếu không có ảnh mới
        
                if (!empty($data['image']['name'])) {
                    $uploadDir = __DIR__ . "/../../assets/image/uploads/products/";
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
        
                    $photo = time() . "_" . preg_replace("/[^A-Za-z0-9.\-_]/", "", $data['image']['name']);
                    $targetFilePath = $uploadDir . $photo;
        
                    if (move_uploaded_file($data['image']['tmp_name'], $targetFilePath)) {
                        // Xóa ảnh cũ nếu có
                        if (!empty($product->img_thumbnail) && file_exists(__DIR__ . "/../../" . $product->img_thumbnail)) {
                            unlink(__DIR__ . "/../../" . $product->img_thumbnail);
                        }
        
                        $linkImage = "assets/image/uploads/products/" . $photo;
                    } else {
                        $messageError['image'] = "Không thể tải ảnh lên.";
                    }
                }
        
                if (empty($messageError)) {
                    $now = date("Y-m-d H:i:s"); 
                    // Cập nhật sản phẩm vào database
                    $this->products->updateProduct($id, $data['name'], $data['category_id'], $data['product_code'], $linkImage, $data['quantity'], $data['description'], $data['content'], $data['status'], $data['price'], $data['price_sale'],$now);
        
                    $_SESSION['message_success'] = "Cập nhật sản phẩm thành công!";
                    header('Location: ' . BASE_URL . '/admins/products');
                    exit();
                }
            }
        
            $listCate = $this->cate->getList();
            require_once __DIR__ . "/../../Views/admin/sanphams/edit.php";
        }
        
    public function delete() {
        $id=$_POST['id'];
        $product = $this->products->detailProduct($id);
    
        if (!$product) {
            $_SESSION['error'] = "Sản phẩm không tồn tại!";
            header('Location: ' . BASE_URL . '/admins/products');
            exit();
        }
    
        // Xóa hình ảnh nếu có
        if (!empty($product->img_thumbnail)) {
            $imagePath = __DIR__ . "/../../".$product->img_thumbnail;
    
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file ảnh
            }
        }
    
        // Xóa sản phẩm trong database
        $this->products->deleteProduct($id);
    
        $_SESSION['message_success'] = "Xóa sản phẩm thành công!";
        header('Location: ' . BASE_URL . '/admins/products');
        exit();
    }
    

    public function validate($data) {
        $messageError = [];

        if (empty($data['name'])) {
            $messageError['name'] = "Không được để trống tên sản phẩm.";
        }
        if (empty($data['category_id']) || $data['category_id'] == 0) {
            $messageError['category_id'] = "Không được để trống danh mục sản phẩm.";
        }
        if (empty($data['description'])) {
            $messageError['description'] = "Mô tả sản phẩm không được để trống.";
        }
        if ($data['price'] == '' || $data['price'] < 0) {
            $messageError['price'] = "Giá sản phẩm không hợp lệ.";
        }
        if (!empty($data['price_sale']) && $data['price_sale'] > $data['price']) {
            $messageError['price_sale'] = "Giá khuyến mãi không được lớn hơn giá sản phẩm.";
        }
        if ($data['quantity'] == '' || $data['quantity'] <= 0) {
            $messageError['quantity'] = "Số lượng phải lớn hơn 0.";
        }
        if (empty($data['product_code'])) {
            $messageError['product_code'] = "Mã sản phẩm không được để trống.";
        }
        if (empty($data['content'])) {
            $messageError['content'] = "Mô tả dài không được để trống.";
        }

       
        if (!empty($data['image']['name'])) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($data['image']['name'], PATHINFO_EXTENSION));

            if (!in_array($fileExtension, $allowedExtensions)) {
                $messageError['image'] = "Chỉ cho phép tải lên các file JPG, JPEG, PNG, GIF.";
            }

            if ($data['image']['size'] > 2 * 1024 * 1024) { // 2MB
                $messageError['image'] = "Dung lượng ảnh không được vượt quá 2MB.";
            }
        } 

        return $messageError;
    }
}

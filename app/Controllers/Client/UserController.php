<?php

namespace App\Controllers\Client;

use App\Models\Admin\Category;
use App\Models\Client\User;
use App\Midderware\loginMidderware;

class UserController {
    public $user;
    public $cate;
    public $check;

    public function __construct() {
        $this->user = new User();
        $this->cate = new Category();
        $this->check = new loginMidderware();
        $this->check->checklogin();
    }

    // Hiển thị thông tin người dùng
    public function index() {
        $id = $_SESSION['user_id'];
        $detail = $this->user->detailUser($id);
        $listCate = $this->cate->listcate();
        require_once __DIR__ . "/../../Views/client/profile.php";
    }

    // Hiển thị form cập nhật thông tin người dùng
    public function edit($id) {
        $detail = $this->user->detailUser($id);
        $listCate = $this->cate->listcate();
        require_once __DIR__ . "/../../Views/client/update-profile.php";
    }

    // Cập nhật thông tin người dùng
    public function update() {
        $id = $_SESSION['user_id'];
        $detail = $this->user->detailUser($id);
        
        $data = $_POST;
        $data['image'] = $_FILES['image'];
        $messageError = $this->validate($data); 
        
        if (empty($messageError)) {
            $linkImage = $detail->image; // Giữ nguyên ảnh cũ nếu không có ảnh mới
    
            if (!empty($data['image']['name'])) {
                $uploadDir = __DIR__ . "/../../assets/image/uploads/users/";
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                $photo = time() . "_" . preg_replace("/[^A-Za-z0-9.\-_]/", "", $data['image']['name']);
                $targetFilePath = $uploadDir . $photo;
    
                if (move_uploaded_file($data['image']['tmp_name'], $targetFilePath)) {
                    // Xóa ảnh cũ nếu có
                    if (!empty($detail->image) && file_exists(__DIR__ . "/../../" . $detail->image)) {
                        unlink(__DIR__ . "/../../" . $detail->image);
                    }
    
                    $linkImage = "assets/image/uploads/users/" . $photo;
                } else {
                    $messageError['image'] = "Không thể tải ảnh lên.";
                }
            }
    
            if (empty($messageError)) {
                $now = date("Y-m-d H:i:s"); 
                // Cập nhật thông tin người dùng vào database
                $this->user->updateUser($id, $data['name'], $data['tel'], $data['address'], $linkImage, $now);
    
                $_SESSION['message_success'] = "Cập nhật thành công!";
                header('Location: ' . BASE_URL . '/profile');
                exit();
            }
        }
        
        $detail = $this->user->detailUser($id);
        $listCate = $this->cate->listcate();
        require_once __DIR__ . "/../../Views/client/update-profile.php";
    }

    // Hiển thị form cập nhật mật khẩu
    public function changePasswordForm() {
        require_once __DIR__ . "/../../Views/client/change-password.php";
    }

    // Cập nhật mật khẩu người dùng
    public function updatePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $newPassword = trim($_POST['new_password']);
            $confirmPassword = trim($_POST['confirm_password']);

            // Validate mật khẩu
            if (empty($newPassword)) {
                $_SESSION['message_error'] = "Mật khẩu không được để trống.";
                header("Location: " . BASE_URL . "change-password");
                exit();
            }
            if ($newPassword !== $confirmPassword) {
                $_SESSION['message_error'] = "Mật khẩu xác nhận không khớp.";
                header("Location: " . BASE_URL . "change-password");
                exit();
            }

            $now = date("Y-m-d H:i:s");

            // Gọi model để cập nhật mật khẩu (hàm updatePassword trong model User)
            $result = $this->user->updatePassword($userId, $newPassword, $now);

            if ($result) {
                $_SESSION['message_success'] = "Cập nhật mật khẩu thành công!";
            } else {
                $_SESSION['message_error'] = "Cập nhật mật khẩu thất bại!";
            }

            header("Location: " . BASE_URL . "profile");
            exit();
        }
        
        header("Location: " . BASE_URL . "change-password");
        exit();
    }

    // Hàm validate dữ liệu cập nhật thông tin người dùng
    public function validate($data) {
        $messageError = [];

        if (empty($data['name'])) {
            $messageError['name'] = "Không được để trống tên.";
        }
        if (empty($data['tel'])) {
            $messageError['tel'] = "Không được để trống số điện thoại.";
        }
        if (empty($data['address'])) {
            $messageError['address'] = "Địa chỉ không được để trống.";
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

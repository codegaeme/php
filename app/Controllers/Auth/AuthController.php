<?php

namespace App\Controllers\Auth;
use App\Models\Auth\Authenication;

class AuthController {
    private $auth;

    public function __construct() {
        $this->auth = new Authenication();
    }

    // Hiển thị form đăng ký
    public function registerForm() {
        require_once __DIR__ . "/../../Views/auth/register.php";
    }

    // Xử lý đăng ký (KHÔNG mã hóa mật khẩu)
    public function register() {
        $data = $_POST;
        $messageError = $this->validate($data);
    
        if (empty($messageError)) {
            $this->auth->register($data['email'], $data['pass'], $data['name']);
            $_SESSION['message_success'] = "Đăng ký thành công!";
            header('Location: ' . BASE_URL . 'login');
            exit();
        }
    
        // Gọi lại form register và truyền lỗi về view
        require_once 'app/Views/auth/register.php';
    }

    // Hiển thị form đăng nhập
    public function loginForm() {
        require_once __DIR__ . "/../../Views/auth/login.php";
    }

    // Xử lý đăng nhập (So sánh mật khẩu trực tiếp)
    public function login() {
        $data = $_POST;
        $messageError = $this->validateLogin($data);
    
        if (empty($messageError)) {
            $user = $this->auth->check($data['email']); // Lấy user theo email
 
       
        
            if ($user && $data['pass'] === $user->pass) { 
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->name;
                $_SESSION['user_role'] = $user->role;
                $_SESSION['message_success'] = "Đăng nhập thành công!";
                if($user->role==1){
                 header('Location: ' . BASE_URL . 'admins');
                }else{
                    header('Location: ' . BASE_URL . 'home');
                }
                
                exit();
            } else {
                $messageError['general'] = "Email hoặc mật khẩu không chính xác!";
            }
        }
    
        // Gọi lại form login và truyền lỗi về view
        require_once 'app/Views/auth/login.php';
    }

    // Xử lý đăng xuất
    public function logout() {
        $_SESSION['message_success'] = "Đăng xuất thành công!";
        session_destroy();
        
        header('Location: ' . BASE_URL . 'home');
        exit();
    }

    // Kiểm tra dữ liệu đăng nhập
    public function validateLogin($data) {
        $messageError = [];

        if (empty(trim($data['email']))) {
            $messageError['email'] = "Không được để trống email.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $messageError['email'] = "Email không hợp lệ.";
        }

        if (empty($data['pass'])) {
            $messageError['pass'] = "Không được để trống mật khẩu.";
        }

        return $messageError;
    }
    public function setrole($id) {
        // Lấy thông tin user từ auth
        $user = $this->auth->detailUser($id);
        
        // Đảo ngược giá trị role: nếu hiện tại là 1 thì chuyển thành 0, ngược lại.
        $newRole = ($user['role'] == 1) ? 0 : 1;
    
        // Gọi hàm updateRole và truyền vào một mảng chứa key 'role'
        $this->auth->updateRole($id, ['role' => $newRole]);
    
        $_SESSION['message_success'] = "Update thành công";
        header('Location: ' . BASE_URL . '/admins/listUser');
        exit();
    }
    

    // Kiểm tra dữ liệu đăng ký
    public function validate($data) {
        $messageError = [];

        if (empty(trim($data['name']))) {
            $messageError['name'] = "Không được để trống tên.";
        }

        if (empty(trim($data['email']))) {
            $messageError['email'] = "Không được để trống email.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $messageError['email'] = "Email không hợp lệ.";
        } elseif ($this->auth->isEmailExists($data['email'])) {
            $messageError['email'] = "Email đã tồn tại, vui lòng chọn email khác.";
        }

        if (empty($data['pass'])) {
            $messageError['pass'] = "Không được để trống mật khẩu.";
        }

        return $messageError;
    }
}

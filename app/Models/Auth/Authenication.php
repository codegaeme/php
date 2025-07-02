<?php
namespace App\Models\Auth;
use App\Commons\Database;
use PDO;

class Authenication {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

  
    public function register($email, $pass, $name) {
        $pdo = $this->db->pdo;
        $now = date("Y-m-d H:i:s"); 

        // Hash mật khẩu trước khi lưu vào database
        // $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (name, email, pass, created_at, updated_at) 
                VALUES (:name, :email, :password, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $pass,
            ':created_at' => $now,
            ':updated_at' => $now
        ]);

        return $stmt->rowCount() > 0; // Trả về true nếu đăng ký thành công
    }

    // Kiểm tra đăng nhập
    public function check($email) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    


    // Kiểm tra email đã tồn tại chưa
    public function isEmailExists($email) {
        $pdo = $this->db->pdo;
        $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }
    public function listUser() {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function detailUser($id) {
        $sql = "SELECT * FROM `users` WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    public function updateRole($id, $detail) {
        // Giả sử $detail chứa giá trị mới của role, ví dụ: $detail['role']
        $sql = "UPDATE `users` 
                SET `role` = :role, 
                    `updated_at` = :updated_at 
                WHERE `id` = :id";
    
        $stmt = $this->db->pdo->prepare($sql);
        $updated_at = date("Y-m-d H:i:s");
        $stmt->execute([
            'role'       => $detail['role'],
            'updated_at' => $updated_at,
            'id'         => $id
        ]);
    
        return $stmt;
    }
    
  
}

<?php 
namespace App\Models\Client;
use App\Commons\Database;
use PDO;
class User{
    public $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function detailUser($id) {
        $sql = "SELECT * FROM `users` WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    public function updateUser($id, $name, $tel, $address, $linkImage, $now) {
        $sql = "UPDATE `users` 
                SET `name` = :name, 
                    `tel` = :tel, 
                    `address` = :address, 
                    `image` = :image, 
                    `updated_at` = :updated_at 
                WHERE `id` = :id";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute([
            'name'       => $name,
            'tel'        => $tel,
            'address'    => $address,
            'image'      => $linkImage,
            'updated_at' => $now,
            'id'         => $id,
        ]);
        
        return $stmt;
    }
    public function updatePassword($id, $newPassword, $now) {
        // Băm mật khẩu mới
        // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
        $sql = "UPDATE `users` 
                SET `pass` = :pass, 
                    `updated_at` = :updated_at 
                WHERE `id` = :id";
    
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute([
            'pass'       => $newPassword,
            'updated_at' => $now,
            'id'         => $id
        ]);
    
        return $stmt;
    }
    
    
    
}
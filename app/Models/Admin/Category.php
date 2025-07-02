<?php
namespace App\Models\Admin;
use App\Commons\Database;

class Category {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Lấy danh sách danh mục
    public function getList() {
        $sql = "SELECT * FROM categories";
        $query = $this->db->pdo->query($sql);
        return $query->fetchAll();
    }

    // Thêm danh mục    
    public function addCate($name, $status) {
        $now = date("Y-m-d H:i:s");
        $sql = "INSERT INTO categories (category_name, status, created_at, updated_at) 
                VALUES (:name, :status, :created_at, :updated_at)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'status' => $status,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }

    // Lấy chi tiết danh mục theo ID
    public function detailCate($id) {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Cập nhật danh mục
    public function updateCate($id, $name, $status) {
        $now = date("Y-m-d H:i:s");
        $sql = "UPDATE categories 
                SET category_name = :name, status = :status, updated_at = :updated_at 
                WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'name' => $name,
            'status' => $status,
            'updated_at' => $now
        ]);
    }

    // Xóa danh mục
    public function deleteCate($id) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
    public function listcate() {
        $sql = "SELECT * FROM categories where status=1";
        $query = $this->db->pdo->query($sql);
        
        return $query->fetchAll();
    }
}

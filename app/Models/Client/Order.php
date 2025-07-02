<?php
namespace App\Models\Client;

use App\Commons\Database;
use PDO;
use PDOException;

class Order {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    // 🟢 Thêm đơn hàng vào CSDL
    public function order($id_user, $id_cus, $total_price, $payment) {
        $now = date("Y-m-d H:i:s");
        $status = '1'; 
    
        $sql = "INSERT INTO `orders` (`id_user`, `id_cus`, `total_price`, `payment`, `status`, `created_at`, `updated_at`) 
                VALUES (:id_user, :id_cus, :total_price, :payment, :status, :created_at, :updated_at)";
        
        $stmt = $this->db->pdo->prepare($sql);
        
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_cus', $id_cus);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':payment', $payment);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':created_at', $now);
        $stmt->bindParam(':updated_at', $now);
        
        if ($stmt->execute()) {
            return $this->db->pdo->lastInsertId();
        }
        return false;
    }
    

    // 🟢 Thêm chi tiết đơn hàng
    public function addOrderDetail($order_id, $product_id, $quantity, $price, $subtotal) {
        $now = date("Y-m-d H:i:s");
        
        $sql = "INSERT INTO `order_detail` (`id_order`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) 
                VALUES (:id_order, :product_id, :quantity, :price, :subtotal, :created_at, :updated_at)";
        
        $stmt = $this->db->pdo->prepare($sql);
        
        $stmt->bindParam(':id_order', $order_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':created_at', $now);
        $stmt->bindParam(':updated_at', $now);
        
        $stmt->execute();
    }
    public function listOderByUser($id_user) {
        $sql = "SELECT 
                    orders.id AS order_id,
                    orders.total_price AS total_price,
                    orders.payment AS payment_method,
                    orders.status AS order_status,
                    orders.created_at AS order_created_at,
                    cus.name AS customer_name,
                    cus.address AS customer_address,
                    cus.tel AS customer_telephone,
                    order_detail.product_id AS product_identifier,
                    order_detail.quantity AS product_quantity,
                    order_detail.price AS product_unit_price,
                    order_detail.subtotal AS product_subtotal,
                    products.name AS product_name,
                    products.img_thumbnail AS product_image
                FROM orders
                JOIN cus ON orders.id_cus = cus.id
                JOIN order_detail ON orders.id = order_detail.id_order
                JOIN products ON order_detail.product_id = products.id
                WHERE orders.id_user = :id_user
                ORDER BY orders.created_at DESC";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderDetailByUser($id_user, $order_id) {
        $sql = "SELECT 
            orders.id AS order_id,
            orders.total_price AS total_price,
            orders.payment AS payment_method,
            orders.status AS order_status,
            orders.created_at AS order_created_at,
            orders.payment_status AS order_payment_status,
            cus.name AS customer_name,
            cus.address AS customer_address,
            cus.tel AS customer_telephone,
            order_detail.id AS order_detail_id,
            order_detail.product_id AS product_identifier,
            order_detail.quantity AS product_quantity,
            order_detail.price AS product_unit_price,
            order_detail.subtotal AS product_subtotal,
            products.name AS product_name,
            products.img_thumbnail AS product_image
        FROM orders
        JOIN cus ON orders.id_cus = cus.id
        JOIN order_detail ON orders.id = order_detail.id_order
        JOIN products ON order_detail.product_id = products.id
        WHERE orders.id_user = :id_user 
          AND orders.id = :order_id
        ORDER BY orders.created_at DESC";
    
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateStatus($id_oder, $status) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id_oder";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id_oder', $id_oder, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    
    
    
    
}    
?>

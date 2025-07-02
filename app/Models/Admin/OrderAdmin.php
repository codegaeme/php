<?php

namespace App\Models\Admin;
use App\Commons\Database;
use PDO;
class OrderAdmin
{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getlistOrder($status)
{
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
        WHERE orders.status = :status
        ORDER BY orders.created_at DESC";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute(['status' => $status]); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function detailListOrder($id){
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
        WHERE orders.id = :order_id
        ORDER BY orders.created_at DESC";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute(['order_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateStatus($id_oder, $status) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id_oder";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id_oder', $id_oder, PDO::PARAM_INT);
        return $stmt->execute();
    }
public function updatePaymenStatus($id_oder,$a){
    $sql = "UPDATE orders SET payment_status = :status WHERE id = :id_oder";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindParam(':status', $a, PDO::PARAM_STR);
    $stmt->bindParam(':id_oder', $id_oder, PDO::PARAM_INT);
    return $stmt->execute();
}

}
<?php

namespace App\Models\Admin;

use App\Commons\Database;
use PDO;

class Thongke {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Lấy tổng số đơn hàng và tổng doanh thu
    public function getTotalOrdersAndRevenue() {
        $sql = "SELECT 
                    COUNT(id) AS total_orders, 
                    SUM(total_price) AS total_revenue 
                FROM orders";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thống kê doanh thu theo ngày
    public function getDailyRevenueStatistics() {
        $sql = "SELECT 
                    DATE(created_at) AS order_date, 
                    COUNT(id) AS orders_count, 
                    SUM(total_price) AS daily_revenue
                FROM orders
                GROUP BY DATE(created_at)
                ORDER BY order_date DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thống kê theo trạng thái thanh toán (payment_status)
    public function getPaymentStatusStatistics() {
        $sql = "SELECT 
                    payment_status, 
                    COUNT(id) AS orders_count, 
                    SUM(total_price) AS revenue
                FROM orders
                GROUP BY payment_status";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thống kê theo phương thức thanh toán (payment)
    public function getPaymentMethodStatistics() {
        $sql = "SELECT 
                    payment, 
                    COUNT(id) AS orders_count, 
                    SUM(total_price) AS revenue
                FROM orders
                GROUP BY payment";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm tổng hợp: lấy tất cả các thống kê
    public function getAllStatistics() {
        return [
            'totalStats'         => $this->getTotalOrdersAndRevenue(),
            'dailyStats'         => $this->getDailyRevenueStatistics(),
            'paymentStatusStats' => $this->getPaymentStatusStatistics(),
            'paymentMethodStats' => $this->getPaymentMethodStatistics(),
        ];
    }
}

<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
            <div class="container-fluid">
				
                <!-- row -->
              <div class="row">
              <style>
    .card-stats {
      margin-bottom: 20px;
    }
    .card-stats .card-body {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .stat-value {
      font-size: 1.8rem;
      font-weight: bold;
    }
    .table thead th {
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
  </nav>

  <div class="container mt-4">
    <h1 class="mb-4">Thống kê Đơn hàng</h1>

    <!-- Card thống kê tổng hợp -->
    <div class="row">
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body">
            <div>
              <h5>Tổng số đơn hàng</h5>
              <p class="stat-value">
                <?php echo isset($stats['totalStats']['total_orders']) ? $stats['totalStats']['total_orders'] : 0; ?>
              </p>
            </div>
            <div>
              <i class="fas fa-shopping-cart fa-3x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body">
            <div>
              <h5>Tổng doanh thu</h5>
              <p class="stat-value">
                <?php echo isset($stats['totalStats']['total_revenue']) ? number_format($stats['totalStats']['total_revenue'], 0, ',', '.') . " VNĐ" : "0 VNĐ"; ?>
              </p>
            </div>
            <div>
              <i class="fas fa-dollar-sign fa-3x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bảng doanh thu theo ngày -->
    <div class="card mb-4">
      <div class="card-header bg-info text-white">
        <h5 class="mb-0">Doanh thu theo ngày</h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead class="thead-light">
              <tr>
                <th>Ngày</th>
                <th>Số đơn hàng</th>
                <th>Doanh thu</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($stats['dailyStats'])): ?>
                <?php foreach ($stats['dailyStats'] as $daily): ?>
                  <tr>
                    <td><?php echo $daily['order_date']; ?></td>
                    <td><?php echo $daily['orders_count']; ?></td>
                    <td><?php echo number_format($daily['daily_revenue'], 0, ',', '.') . " VNĐ"; ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="text-center">Không có dữ liệu doanh thu theo ngày.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Bảng thống kê theo trạng thái thanh toán -->
    <div class="card mb-4">
      <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Thống kê theo trạng thái thanh toán</h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead class="thead-light">
              <tr>
                <th>Trạng thái thanh toán</th>
                <th>Số đơn hàng</th>
                <th>Doanh thu</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($stats['paymentStatusStats'])): ?>
                <?php foreach ($stats['paymentStatusStats'] as $status): ?>
                  <tr>
                    <td><?php echo $status['payment_status']; ?></td>
                    <td><?php echo $status['orders_count']; ?></td>
                    <td><?php echo number_format($status['revenue'], 0, ',', '.') . " VNĐ"; ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="text-center">Không có dữ liệu theo trạng thái thanh toán.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Bảng thống kê theo phương thức thanh toán -->
    <div class="card mb-4">
      <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Thống kê theo phương thức thanh toán</h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead class="thead-light">
              <tr>
                <th>Phương thức thanh toán</th>
                <th>Số đơn hàng</th>
                <th>Doanh thu</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($stats['paymentMethodStats'])): ?>
                <?php foreach ($stats['paymentMethodStats'] as $method): ?>
                  <tr>
                    <td><?php echo $method['payment']; ?></td>
                    <td><?php echo $method['orders_count']; ?></td>
                    <td><?php echo number_format($method['revenue'], 0, ',', '.') . " VNĐ"; ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="text-center">Không có dữ liệu theo phương thức thanh toán.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
  </div>

  <!-- FontAwesome cho icon -->
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <!-- jQuery và Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
              </div>
            </div>
        </div>


 <?php
require_once 'app/Views/layouts/admin/footer.php';

?>

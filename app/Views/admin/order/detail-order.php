<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
            <div class="container-fluid">
				
                <!-- row -->
              <div class="row">
              <div class="col-12">
            <?php if (isset($detailOder) && !empty($detailOder)): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Thông tin đơn hàng: #<?php echo $detailOder['order_id']; ?></h4>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-3 col-12 ">Thông tin khách hàng</h5>
                        <p class="col-12 "><strong>Tên khách hàng:</strong> <?php echo $detailOder['customer_name']; ?></p>
                        <p class="col-12 "><strong>Địa chỉ:</strong> <?php echo $detailOder['customer_address']; ?></p>
                        <p class="col-12 "><strong>Số điện thoại:</strong> <?php echo $detailOder['customer_telephone']; ?></p>
                        <hr>
                        <h5 class="mb-3 col-12">Chi tiết sản phẩm</h5>
                        <p class="col-12 "><strong>Tên sản phẩm:</strong> <?php echo $detailOder['product_name']; ?></p>
                        <p class="col-12 ">
                            <strong>Ảnh sản phẩm:</strong>
                            <img src="<?php echo BASE_URL.'app/'.$detailOder['product_image']; ?>" alt="<?php echo $detailOder['product_name']; ?>" width="100">
                        </p>
                        <p class="col-12 "><strong>Số lượng:</strong> <?php echo $detailOder['product_quantity']; ?></p>
                        <p class="col-12 "><strong>Đơn giá:</strong> <?php echo number_format($detailOder['product_unit_price'], 2, ',', '.'); ?></p>
                        <p class="col-12 "><strong>Thành tiền:</strong> <?php echo number_format($detailOder['product_subtotal'], 2, ',', '.'); ?></p>
                        <hr>

                        <h5 class="mb-3 col-12">Thông tin đơn hàng</h5>
                        <p class="col-12 "><strong>Tổng tiền:</strong> <?php echo number_format($detailOder['total_price'], 2, ',', '.'); ?></p>
                        <p class="col-12 "><strong>Phương thức thanh toán:</strong> <?php if($detailOder['payment_method']==1){
                            echo'Thanh toán khi nhận hàng';
                        } ?></p>
                        <p class="col-12 "><strong>Trạng thái đơn hàng:</strong> <?php  if ($detailOder['order_status']==1) {
                   echo" Chờ xác nhận ";
                }else if ($detailOder['order_status']==2) {
                    echo"Đang chuẩn bị hàng";
                 }else if ($detailOder['order_status']==3) {
                    echo" Đang vận chuyển ";
                 }else if ($detailOder['order_status']==4) {
                    echo" Giao hàng thành công ";}
                else {
                    echo "Đã hủy";
                } ?></p>
                        <p class="col-12 "><strong>Trạng thái thanh toán:</strong> <?php
                        
                        
                      if($detailOder['order_payment_status']==1){
                            echo'Chưa thanh toán';
                        } else echo 'Đã thanh toán';?></p>
                        <p class="col-12 "><strong>Ngày tạo:</strong> <?php echo date('d/m/Y H:i', strtotime($detailOder['order_created_at'])); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">
                    Không tìm thấy thông tin đơn hàng.
                </div>
            <?php endif; ?>
        </div>
              </div>
            </div>
        </div>


 <?php
require_once 'app/Views/layouts/admin/footer.php';

?>

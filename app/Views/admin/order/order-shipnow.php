<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
            <div class="container-fluid">
				
                <!-- row -->
              <div class="row">
              <div class="row mb-5">
                <div class="col-sm-3">
                    <a href="<?=BASE_URL?>admins/order" class="btn btn-primary">Đơn hàng chờ xác nhận</a>
                </div>
                <div class="col-sm-3">
                    <a href="<?=BASE_URL?>admins/order/ship" class="btn btn-primary">Đơn hàng đang chuẩn bị</a>
                </div>
                <div class="col-sm-3">
                    <a href="<?=BASE_URL?>admins/order/complate" class="btn btn-primary">Đơn hàng thành công</a>
                </div>
                <div class="col-sm-3">
                    <a href="<?=BASE_URL?>admins/order/fail" class="btn btn-primary">Đơn hàng chờ đã hủy</a>
                </div>
              </div>
                     <table class="table">
                     <h3 class="mt-3 mb-5">Đơn hàng đang vận chuyển:</h3>
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh sản phẩm</th>
                <th>Tên sản phẩm </th>
                <th>Giá sản phẩm</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>  

        <tbody>
<?php foreach ($a as $key => $value) :

    
    ?>
            <tr>
                <td><?=$key+1?></td>
                <td><img src="<?= BASE_URL ?>/app/<?= $value['product_image'] ?>" alt="" width="100"></td>
                <td><?= $value['product_name']?></td>
                <td><?= $value['product_unit_price'] ?></td>
                <td><?=$value['product_quantity']?></td>
                <td><?=$value['product_subtotal']?></td>
                <td>
                <?php
                
                if ($value['order_status']==1) {
                   echo" Chờ xác nhận ";
                }else if ($value['order_status']==2) {
                    echo"Đã xác nhận ";
                 }else if ($value['order_status']==3) {
                    echo" Đang vận chuyển ";
                 }else if ($value['order_status']==4) {
                    echo" Giao hàng thành công ";}
                   
                else {
                    echo "Đã hủy";
                }
                
                
                ?>    
                </td>
                <td><a href="<?=BASE_URL?>admins/order/<?=$value['order_id']?>/detail" class="btn btn-primary">Xem chi tiết</a>
                <a href="<?=BASE_URL?>admins/order/<?=$value['order_id']?>/confirm/shipnow" class="btn btn-danger" onclick="return confirm('Đơn hàng đã giao thành công')">Đã giao hàng</a></td>
             
                
            </tr>
    <?php endforeach ?>
        </tbody>     
        </table>
               
              </div>
            </div>
        </div>


 <?php
require_once 'app/Views/layouts/admin/footer.php';

?>

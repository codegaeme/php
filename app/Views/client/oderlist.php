<?php
require_once 'app/Views/layouts/client/header.php';
?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Đơn hàng của tôi</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
   
        <div class="row px-xl-5">
        <div class="col-12">
          <div class="breadcrumb bg-light mb-30">
            <table class="table">
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
<?php foreach ($listOrder as $key => $value) :

    
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
                    echo"Đang chuẩn bị hàng ";
                 }else if ($value['order_status']==3) {
                    echo" Đang vận chuyển ";
                 }else if ($value['order_status']==4) {
                    echo" Giao hàng thành công ";}
                else {
                    echo "Đã hủy";
                }
                
                
                ?>    
                </td>
                <td><a href="<?=BASE_URL.$value['order_id']?>/order/detail" class="btn btn-primary">Xem chi tiết</a>

                <?php if ($value['order_status']!=4) :?>
                <a href="<?=BASE_URL.$value['order_id']?>/order/huy" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không')">Hủy</a></td>
             <?php endif?>
                
            </tr>
    <?php endforeach ?>
        </tbody>     
        </table>
          </div>
        </div>
           
        </div>
 
</div>



<?php
require_once 'app/Views/layouts/client/footer.php';
?>

<?php
require_once 'app/Views/layouts/client/header.php';
?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php else: ?>
        <div class="row px-xl-5">
            <!-- Bảng giỏ hàng -->
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php 
                        $subtotal = 0;
                        foreach ($cart as $key => $value): 
                            $id_user=$value['id_user'];
                            $price = number_format($value['price'], 0, ',', '.');
                            $quantity = $value['so_luong_dat'];
                            $total = number_format($value['price'] * $quantity, 0, ',', '.');
                            $subtotal += $value['price'] * $quantity;
                         
                        ?>
                        <tr>
                            <td class="align-middle">
                         
                            <img src="<?= BASE_URL ?>/app/<?= $value['image']?>" alt="" width="100" class="mr-5">
                                <?= htmlspecialchars($value['name']) ?>
                            </td>
                            <td class="align-middle"><?= $price ?> đ</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" onclick="updateQuantity(<?= $key ?>, -1)">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?= $quantity ?>" readonly>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" onclick="updateQuantity(<?= $key ?>, 1)">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?= $total ?> đ</td>
                            <td class="align-middle">
                                <a href="<?= BASE_URL . 'cart/remove/' . $key ?>" class="btn btn-sm btn-danger" onclick ="return confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng không')">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <!-- Thông tin thanh toán -->
            <div class="col-lg-4">
                <form action="<?=BASE_URL?>order" method="post" enctype="multipart/form-data">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Cart Summary</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><?= number_format($subtotal, 0, ',', '.') ?> đ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">0</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?= number_format($subtotal + 0000, 0, ',', '.') ?> đ</h5>
                            <input type="hidden" name="user_id" value="<?=$id_user?>">
                            

                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">
                            Proceed To Checkout
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    function updateQuantity(productId, change) {
        // Chuyển hướng đến trang cập nhật giỏ hàng với số lượng mới
        window.location.href = '<?= BASE_URL ?>cart/update/' + productId + '/' + change;
    }
</script>

<?php
require_once 'app/Views/layouts/client/footer.php';
?>

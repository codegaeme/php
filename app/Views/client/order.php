<?php
require_once 'app/Views/layouts/client/header.php';
?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Start -->
<div class="container-fluid">
    <form action="<?= BASE_URL ?>order/add" method="post">
       
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Billing Address</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                    <div class="col-md-12 form-group">
                           <a href="<?=BASE_URL ?>custommer" class="btn btn-primary ">Chọn địa chỉ giao hàng</a>
                       
                       
                        </div>
                        
                      
                        <div class="col-md-12 form-group">
                            <label>Tên người nhận</label>
                            <input class="form-control" type="text" name="name" placeholder="Nhập họ tên" value="<?= $user_information['name'] ?? '' ?>">
                            <?php if (isset($messageError['name'])) : ?>
                                <span style="color: red;"><?= $messageError['name'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="email" name="email" placeholder="Nhập email" value="<?= $email['email'] ?? '' ?>">
                            <?php
                             
                            if (isset($messageError['email'])) : ?>
                              
                                <span style="color: red;"><?= $messageError['email'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" name="tel" placeholder="Nhập số điện thoại" value="<?= $user_information['tel'] ?? '' ?>">
                            <?php if (isset($messageError['tel'])) : ?>
                                <span style="color: red;"><?= $messageError['tel'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Địa chỉ giao hàng</label>
                            <input class="form-control" type="text" name="address" placeholder="Nhập địa chỉ" value="<?= $user_information['address'] ?? '' ?>">
                            <?php if (isset($messageError['address'])) : ?>
                                <span style="color: red;"><?= $messageError['address'] ?></span>
                            <?php endif; ?>
                        </div>
                          

                      
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Order Total</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <?php 
                        $subtotal = 0;
                        if (!empty($cart)) :
                            foreach ($cart as $value) :
                                $id_user = $value['id_user'];
                                $price = number_format($value['price'], 0, ',', '.');
                                $quantity = $value['so_luong_dat'];
                                $shipping = 0; // Mặc định phí ship = 0
                                $subtotal += $value['price'] * $quantity;
                                $total = $shipping + $subtotal;
                        ?>
                        <div class="d-flex justify-content-between">
                            <p><?= htmlspecialchars($value['name']) ?></p>
                            <p><?= $price ?> đ x <?= $quantity ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><?= number_format($subtotal, 0, ',', '.') ?> đ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"><?= number_format($shipping, 0, ',', '.') ?> đ</h6>
                        </div>
                    </div>

                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?= number_format($total, 0, ',', '.') ?> đ</h5>
                            <input type="hidden" name="total" value="<?=$total?>">
                        </div>
                    </div>

                    <?php else : ?>
                        <p class="text-danger text-center">Giỏ hàng của bạn đang trống.</p>
                    <?php endif; ?>
                </div>

                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Payment</span>
                    </h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value="1" id="cash_on_delivery" checked>
                                <label class="custom-control-label" for="cash_on_delivery">Thanh toán khi nhận hàng</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value="2" id="momo">
                                <label class="custom-control-label" for="momo">Thanh toán qua Momo</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                </div>
            </div>
        </div>
    </form>
</div>



<?php
require_once 'app/Views/layouts/client/footer.php';
?>

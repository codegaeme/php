<?php
require_once 'app/Views/layouts/client/header.php';

?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shop Detail</span>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="<?= BASE_URL ?>/app/<?= $detail->img_thumbnail ?>" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="<?= BASE_URL ?>/app/<?= $detail->img_thumbnail ?>" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="<?= BASE_URL ?>/app/<?= $detail->img_thumbnail ?>" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="<?= BASE_URL ?>/app/<?= $detail->img_thumbnail ?>" alt="Image">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <form action="<?= BASE_URL ?>addcart" method="post" enctype="multipart/form-data">
                    <h3><?= $detail->name ?></h3>

                    <h3 class="font-weight-semi-bold mb-4"><?= $detail->price ?></h3>
                    <p class="mb-4"><?= $detail->description ?></p>


                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1"
                                name="quantity" readonly>
                            <?php if (isset($message_erorr)): ?>
                                <span style="color: red;"><?php echo $message_erorr;?></span>
                            <?php endif; ?>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <?php if(isset($_SESSION['user_id'])) :?>
                        <input type="hidden" value="<?= $detail->id ?>" name="id">
                        <input type="hidden" value="<?= $_SESSION['user_id']?>" name="id_user">
                        <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>

                            <?php else :?>
                                <a href="<?=BASE_URL?>login"class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Đăng nhập để thêm giỏ hàng</a>
                                
                            <?php endif?>

                    </div>
                    <div class="d-flex mb-3">

                        <small class="pt-1">Còn lại: <?= $detail->quantity ?></small>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>

                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p><?= $detail->content ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'app/Views/layouts/client/footer.php';

?>
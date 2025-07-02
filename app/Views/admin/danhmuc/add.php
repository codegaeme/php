<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form action="<?= BASE_URL . 'admins/categories/store' ?>" method="post" style="width: 70%;" enctype="multipart/form-data">
                <div class="mt-3">
                    <label for="">Tên danh mục</label>
                    <input type="text" class="form-control" name="name_categories" placeholder="Nhập tên danh mục">
                    <?php if (isset($messageError['name'])) : ?>
                        <span style="color: red;"><?= $messageError['name'] ?></span>
                    <?php endif; ?>
                </div>

     

                <div class="mt-3">
                    <label>Trạng thái</label>
                    <input type="radio" name="status" value="1"> Hiển thị
                    <input type="radio" name="status" value="0" checked> Ẩn
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'app/Views/layouts/admin/footer.php'; ?>

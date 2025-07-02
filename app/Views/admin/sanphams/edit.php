<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <h2>Sửa sản phẩm</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL . 'admins/products/' . $product->id . '/update' ?>" method="post" style="width: 70%;" enctype="multipart/form-data">
                <div class="a">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product->name) ?>">
                </div>

                <div class="a mt-3">
                    <label for="">Mã sản phẩm</label>
                    <input type="text" class="form-control" name="product_code" value="<?= htmlspecialchars($product->product_code) ?>">
                </div>

                <div class="a mt-3">
                    <label for="">Danh mục sản phẩm</label>
                    <select name="category_id" class="form-control">
                        <option value="0">Chọn danh mục</option>
                        <?php foreach ($listCate as $value): ?>
                            <option value="<?= $value->id ?>" <?= ($value->id == $product->category_id) ? 'selected' : '' ?>>
                                <?= $value->category_name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="a mt-3">
                    <label for="">Hình ảnh sản phẩm</label>
                    <?php if (!empty($product->img_thumbnail)): ?>
                        <br>
                        <img src="<?= BASE_URL .'app/'. $product->img_thumbnail ?>" width="150">
                    <?php endif; ?>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="a mt-3">
                    <label for="">Số lượng</label>
                    <input type="text" class="form-control" name="quantity" value="<?= $product->quantity ?>">
                </div>

                <div class="a mt-3">
                    <label for="">Giá</label>
                    <input type="text" class="form-control" name="price" value="<?= $product->price ?>">
                </div>

                <div class="a mt-3">
                    <label for="">Giá khuyến mãi</label>
                    <input type="text" class="form-control" name="price_sale" value="<?= $product->price_sale ?>">
                </div>

                <div class="a mt-3">
                    <label for="">Mô tả ngắn</label>
                    <input type="text" class="form-control" name="description" value="<?= htmlspecialchars($product->description) ?>">
                </div>

                <div class="a mt-3">
                    <label for="">Mô tả dài</label>
                    <textarea name="content" class="form-control"><?= htmlspecialchars($product->content) ?></textarea>
                </div>

                <div class="a mt-3">
                    <input type="radio" name="status" value="1" <?= ($product->stastus == 1) ? 'checked' : '' ?>> Hiển thị
                    <input type="radio" name="status" value="0" <?= ($product->stastus == 0) ? 'checked' : '' ?>> Ẩn
                </div>

                <div class="a">
                    <button type="submit" class="mt-5 btn btn-primary">Cập nhật</button>
                   
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'app/Views/layouts/admin/footer.php';
?>

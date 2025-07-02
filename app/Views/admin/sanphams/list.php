<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>


<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <a href="<?= BASE_URL . 'admins/products/create' ?>" class="btn btn-primary" style="width: 10%;">Thêm mới</a>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Tên danh mục</th>
                        <th>Hình ảnh sản phẩm</th>
                        <th>Giá</th>
                        <th>Giá khuyến mãi</th>
                        <th>Lượt xem</th>
                        <th>Số lượng</th>

                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listPro as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value->name ?></td>
                            <td><?= $value->category_name ?></td>

                            <td><img src="<?= BASE_URL ?>/app/<?= $value->img_thumbnail ?>" alt="" width="100"></td>
                            <td><?= $value->price ?></td>
                            <td><?= $value->price_sale ?></td>
                            <td><?= $value->view ?></td>
                            <td><?= $value->quantity ?></td>
                            <td>
                                <a href="<?= BASE_URL . 'admins/products/' . $value->id . '/edit' ?>" class="btn btn-success">Sửa</a>
                                <form action="<?= BASE_URL . 'admins/products/delete' ?>" method="POST"
                                    style="display:inline;" >
                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                    <button type="submit" class="btn btn-danger"    onclick="return confirm('Bạn có muốn xóa không?')">Xóa</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once 'app/Views/layouts/admin/footer.php';
?>
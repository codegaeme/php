<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <a href="<?= BASE_URL . 'admins/categories/create' ?>">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listCate as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= htmlspecialchars($value->category_name) ?></td>
                            <td><?= $value->status == 1 ? 'Hiển thị' : 'Ẩn' ?></td>
                            <td>
                                <a href="<?= BASE_URL . 'admins/categories/' . $value->id . '/edit' ?>">Sửa</a>
                                <a href="<?= BASE_URL . 'admins/categories/' . $value->id . '/delete' ?>" 
                                   onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
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
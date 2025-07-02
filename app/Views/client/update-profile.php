<?php
require_once 'app/Views/layouts/client/header.php';
?>

<div class="container my-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Cập nhật thông tin cá nhân</h4>
        </div>
        <div class="card-body">
          <form action="<?= BASE_URL ?>profile/update" method="POST" enctype="multipart/form-data">
            <!-- Tên -->
            <div class="mb-3">
              <label for="name" class="form-label">Họ và tên</label>
              <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($detail['name']) ?>" required>
            </div>
            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($detail['email']) ?>" required>
            </div>
            <!-- Số điện thoại -->
            <div class="mb-3">
              <label for="tel" class="form-label">Số điện thoại</label>
              <input type="text" class="form-control" id="tel" name="tel" value="<?= htmlspecialchars($detail['tel']) ?>" required>
            </div>
            <!-- Địa chỉ -->
            <div class="mb-3">
              <label for="address" class="form-label">Địa chỉ</label>
              <textarea class="form-control" id="address" name="address" rows="3" required><?= htmlspecialchars($detail['address']) ?></textarea>
            </div>
            <!-- Ảnh đại diện -->
            <div class="mb-3">
              <label for="image" class="form-label">Ảnh đại diện</label>
              <input type="file" class="form-control" id="image" name="image">
              <div class="form-text">Chọn ảnh nếu bạn muốn thay đổi ảnh đại diện.</div>
            </div>
            <!-- Nút submit -->
            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once 'app/Views/layouts/client/footer.php';
?>

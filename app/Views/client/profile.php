<?php
require_once 'app/Views/layouts/client/header.php';
?>

<style>
  .profile-header {
    height: 100px;
    position: relative;
    background: #f0f0f0;
  }
  .profile-header::after {
    content: "";
    position: absolute;
    top: 0; left: 0;
    right: 0; bottom: 0;
    /* Nếu cần overlay, bạn có thể thêm background rgba ở đây */
  }
  .profile-img {
    width: 150px;
    height: 150px;
    border: 5px solid #fff;
    border-radius: 50%;
    object-fit: cover;
    /* Để căn giữa theo chiều dọc trong col */
    margin: auto;
  }
  .profile-info {
    /* Canh lề trái để hiển thị bên cạnh avatar */
    padding-left: 20px;
  }
  .info-box {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
    width: 100%;
    margin-top: 30px;
  }
</style>
</head>
<body>
  <div class="">
    <!-- Header với background -->
    <div class="profile-header"></div>
  
    <!-- Hàng chứa avatar và thông tin người dùng -->
    <div class="container my-5">
      <div class="row align-items-center bg-light p-4 rounded shadow-sm">
        <!-- Ảnh đại diện -->
        <div class="col-md-3 text-center">
          <?php if (isset($detail['image'])) : ?>
            <img src="<?= BASE_URL ?>app/<?= $detail['image'] ?>" alt="Ảnh đại diện" class="profile-img">
          <?php else : ?>
            <img src="<?= BASE_URL ?>app/public/client/assets/img/avatar.png" alt="Ảnh đại diện" class="profile-img">
          <?php endif ?>
        </div>
        <!-- Thông tin người dùng -->
        <div class="col-md-9 profile-info">
          <h2><?= $detail['name'] ?></h2>
          <p class="text-muted">Thành viên từ: <strong><?= $detail['created_at'] ?></strong></p>
          <p><i class="bi bi-envelope"></i> <?= $detail['email'] ?></p>
          <p><i class="bi bi-telephone"></i> <?= $detail['tel'] ?></p>
          <p><i class="bi bi-geo-alt"></i> <?= $detail['address'] ?></p>
          <a  href="<?=BASE_URL?>/profile/<?=$detail['id']?>/edit"class="btn btn-success mt-3">Cập nhật thông tin</a>
          <a  href="<?=BASE_URL?>/profile/editmk"class="btn btn-success mt-3">Đổi mật khẩu</a>
        </div>
      </div>
      
      <!-- Box hiển thị thông tin chi tiết cá nhân (nếu cần) -->
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="info-box">
            <h5><i class="bi bi-person-circle"></i> Thông tin cá nhân</h5>
            <p><strong>Họ và tên:</strong> <?= $detail['name'] ?></p>
            <p><strong>Email:</strong> <?= $detail['email'] ?></p>
            <p><strong>Số điện thoại:</strong> <?= $detail['tel'] ?></p>
            <p><strong>Địa chỉ:</strong> <?= $detail['address'] ?></p>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
<?php
require_once 'app/Views/layouts/client/footer.php';
?>

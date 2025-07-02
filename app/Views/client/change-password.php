<?php
require_once 'app/Views/layouts/client/header.php';
?>



<div class="container">
    <h2>Đổi mật khẩu</h2>
    
    <!-- Hiển thị thông báo lỗi nếu có -->
    <?php if(isset($_SESSION['message_error'])): ?>
        <div class="alert alert-danger">
            <?php 
                echo $_SESSION['message_error']; 
                unset($_SESSION['message_error']);
            ?>
        </div>
    <?php endif; ?>

    <!-- Hiển thị thông báo thành công nếu có -->
    <?php if(isset($_SESSION['message_success'])): ?>
        <div class="alert alert-success">
            <?php 
                echo $_SESSION['message_success']; 
                unset($_SESSION['message_success']);
            ?>
        </div>
    <?php endif; ?>

    <form action="<?=BASE_URL ?>profile/updatemk" method="post">
        <div class="form-group">
            <label for="new_password">Mật khẩu mới:</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
    </form>
</div>



  
<?php
require_once 'app/Views/layouts/client/footer.php';
?>

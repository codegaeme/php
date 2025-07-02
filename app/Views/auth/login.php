<?php require_once 'app/Views/layouts/auth/header.php'; ?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form " action="<?= BASE_URL ?>loginPost" method="POST">
                <span class="login100-form-title p-b-26">Welcome</span>
                <span class="login100-form-title p-b-48">
                    <img src="" alt="">
                </span>

                <!-- Hiển thị thông báo lỗi chung -->
                <?php if (isset($messageError['general'])): ?>
                    <div style="color: red; text-align: center;">
                        <?= $messageError['general']; ?>
                    </div>
                <?php endif; ?>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="email" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
                    <span class="focus-input100" data-placeholder="Email"></span>
                  
                </div>
                <?php if (!empty($messageError['email'])): ?>
                        <span style="color: red;"><?= $messageError['email'] ?></span>
                    <?php endif; ?>

                <div class="wrap-input100">
                    <span class="btn-show-pass">Hiện</span>
                    <input class="input100" type="password" name="pass">
                    <span class="focus-input100" data-placeholder="Password"></span>
                  
                </div>
                <?php if (!empty($messageError['pass'])): ?>
                        <span style="color: red;"><?= $messageError['pass'] ?></span>
                    <?php endif; ?>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">Login</button>
                    </div>
                </div>

                <div class="text-center p-t-115">
                    <span class="txt1">Don’t have an account?</span>
                    <a class="txt2" href="<?= BASE_URL ?>register">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'app/Views/layouts/auth/footer.php'; ?>

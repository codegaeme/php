<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="" href="<?=BASE_URL?>admins" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>


            </li>

            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-info-circle"></i>
                    <span class="nav-text">Quản lí danh mục </span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= BASE_URL . 'admins/categories' ?>">Danh sách danh mục</a></li>
                    <li><a href="<?= BASE_URL . 'admins/categories/create' ?>">Thêm danh mục</a></li>

                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-chart-line"></i>
                    <span class="nav-text">Quản lí sản phẩm</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= BASE_URL . 'admins/products' ?>">Danh sách sản phẩm</a></li>
                    <li><a href="<?= BASE_URL . 'admins/products/create' ?>">Thêm sản phẩm</a></li>

                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fab fa-bootstrap"></i>
                    <span class="nav-text">Quản lí đơn hàng</span>
                </a>
                <ul aria-expanded="false">
                <li><a href="<?=BASE_URL?>admins/order">Xác nhận đơn hàng</a></li>
                <li><a href="<?=BASE_URL?>admins/order/ship">Chuẩn bị hàng đơn hàng</a></li>
                <li><a href="<?=BASE_URL?>admins/order/shipnow">Vận chuyển đơn hàng</a></li>
                    <li><a href="<?=BASE_URL?>admins/order/complate">Đơn hàng đã giao</a></li>
                    
                    <li><a href="<?=BASE_URL?>admins/order/fail">Đơn hàng đã hủy</a></li>


                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-heart"></i>
                    <span class="nav-text">Yêu thích</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="uc-select2.html">Select 2</a></li>
                    <li><a href="uc-nestable.html">Nestedable</a></li>
                    <li><a href="uc-noui-slider.html">Noui Slider</a></li>
                    <li><a href="uc-sweetalert.html">Sweet Alert</a></li>
                    <li><a href="uc-toastr.html">Toastr</a></li>
                    <li><a href="map-jqvmap.html">Jqv Map</a></li>
                    <li><a href="uc-lightgallery.html">Light Gallery</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE_URL ?>/admins/listUser" class="" aria-expanded="false">
                    <i class="fas fa-user-check"></i>
                    <span class="nav-text">Quản lí tài khoản</span>
                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-clone"></i>
                    <span class="nav-text">Pages</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="page-login.html">Login</a></li>
                    <li><a href="page-register.html">Register</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                        <ul aria-expanded="false">
                            <li><a href="page-error-400.html">Error 400</a></li>
                            <li><a href="page-error-403.html">Error 403</a></li>
                            <li><a href="page-error-404.html">Error 404</a></li>
                            <li><a href="page-error-500.html">Error 500</a></li>
                            <li><a href="page-error-503.html">Error 503</a></li>
                        </ul>
                    </li>
                    <li><a href="page-lock-screen.html">Lock Screen</a></li>
                    <li><a href="empty-page.html">Empty Page</a></li>
                </ul>
            </li>
        </ul>
    

       
    </div>
</div>
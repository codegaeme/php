<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
            <div class="container-fluid">
				
                <!-- row -->
              <div class="row">
              <?php if(isset($messageError) && count($messageError) != 0): ?>
                <?php foreach($messageError as $error): ?>
                <span style="color: red;"><?= $error ?></span>
                <?php endforeach ?>
                <?php endif?>

                
                <form action="<?= BASE_URL . 'admins/categories/' .$detailCate->id .'/update' ?>" method="post" style="width: 70%;" enctype="multipart/form-data">
                   <div class="a" >
                    <label for="">Tên Danh mục</label>
                    <input type="text" class="form-control mt-3"  name="name_categories" placeholder="Nhập tên danh mục" value="<?=$detailCate->category_name?>">
                   </div>
                   <div class="a mt-3" >
                   
                    <input type="radio" name="status" value="1" <?php if ($detailCate->status==1) {
                      echo'checked';
                    }?>>Hiển thị
                    <input type="radio" name="status" value="0" <?php if ($detailCate->status==0) {
                      echo'checked';
                    }?>>Ẩn
                   </div>
                 
                   <div class="a" >
                   <button type="submit" class="mt-5 btn btn-primary ">Sửa</button>
                   </div>
                </form>
              </div>
            </div>
        </div>


 <?php
require_once 'app/Views/layouts/admin/footer.php';

?>

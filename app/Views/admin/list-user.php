<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Hình đại diện</th>
                        <th>Tên </th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Hành động</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listUser as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td>
                            <?php if (isset($value->image)) : ?>

                            <img src="<?= BASE_URL ?>/app/<?= $value->image ?>" alt="" width="100"></td>
                                <?php else : echo 'Không có hình ảnh'?>
                            <?php endif ?>
                            <td><?= $value->name ?></td>
                            <td><?= $value->email?></td>
                            <td><?php if ($value->role==1) {
                               echo 'admin';
                            }else echo'user';?></td>
                            <td>
                            <?php 
                            if($value->role==1):
                            ?>    
                            <a href="<?=BASE_URL.'admins/'.$value->id?>/setrole" class="btn btn-danger">Hạ xuống user</a></td>
                            <?php else :?>
                            <a href="<?=BASE_URL.'admins/'.$value->id?>/setrole" class="btn btn-success">Nâng lên admin</a></td>
                            <?php endif ?>
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
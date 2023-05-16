<?php
require ROOT . '/pages/user/header.php';

if ($_SESSION['role'] != 'admin') {
    redirect("/");
}

_selectAll($stmt, $count, "select * from users order by id desc limit 0, 100", $id, $name, $phone, $email, $password, $created_date, $role);

?>


<?php if (!empty($_SESSION['success'])) : ?>
    <div class="container">
        <div class="alert alert-success" role="alert" style="margin-top: 10px;">
            <h6><?php echo $_SESSION['success']; ?></h6>
        </div>
    </div>
<?php unset($_SESSION['success']);
endif; ?>

<?php if (!empty($_SESSION['errors'])) : ?>
    <div class="container">
        <div class="alert alert-danger" role="alert" style="margin-top: 10px;">
            <h6><?php echo $_SESSION['errors'] ?></h6>
        </div>
    </div>
<?php unset($_SESSION['errors']);
endif; ?>


<?php if (!empty($_SESSION['success'])) : ?>
    <div class="container">
        <div class="alert alert-success" role="alert" style="margin-top: 10px;">
            <h6><?php echo $_SESSION['success']; ?></h6>
        </div>
    </div>
<?php unset($_SESSION['success']);
endif; ?>

<?php if (!empty($_SESSION['errors'])) : ?>
    <div class="container">
        <div class="alert alert-danger" role="alert" style="margin-top: 10px;">
            <h6><?php echo $_SESSION['errors'] ?></h6>
        </div>
    </div>
<?php unset($_SESSION['errors']);
endif; ?>

<div class="row col-12">
    <div style="margin: 12px;">
        <h3>Системийн хэрэглэгчид</h3>
        <a href="/user/users/add">
            <button class="btn btn-success btn-md">+ Шинэ хэрэглэгч нэмэх</button>
        </a>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Нэр</th>
                                <th>Утас</th>
                                <th>Имайл</th>
                                <th>Үүсгэсэн огноо</th>
                                <th>Хандах эрх</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while (_fetch($stmt)) : ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td><?= $name ?></td>
                                    <td><?= $phone ?></td>
                                    <td><?= $email ?></td>
                                    <td><?= $created_date ?></td>
                                    <td><?= $role ?></td>

                                    <?php if ($role != 'admin') : ?>
                                        <td align="center"> <a href="/user/users/delete?id=<?= $id ?>" onclick="confirmDelete()"><i class="bi bi-trash3-fill" style="color: red;"></i></a></td>
                                    <?php endif; ?>

                                </tr>
                            <?php endwhile; ?>
                            <?php _close_stmt($stmt); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require ROOT . '/pages/user/footer.php'; ?>
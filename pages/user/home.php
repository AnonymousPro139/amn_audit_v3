<?php
require 'header.php';

_selectAll($stmt, $count, "select * from customers order by id desc limit 0, 250", $id, $company_name, $company_registr, $name, $phone, $email, $brand, $message, $is_view, $created_date);

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


<div class="row col-12">
    <div style="margin: 12px;">
        <h3>Гэрээ байгуулах / Үнийн санал авах жагсаалт</h3>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Компанийн нэр</th>
                                <th>Компанийн регистр</th>
                                <th>Хэрэглэгч нэр</th>
                                <th>Утас</th>
                                <th>Email</th>
                                <th>Бренд</th>
                                <th>Мессеж</th>
                                <th>Огноо</th>

                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while (_fetch($stmt)) : ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td><?= $company_name ?></td>
                                    <td><?= $company_registr ?></td>

                                    <td><?= $name ?></td>
                                    <td><?= $phone ?></td>
                                    <td><?= $email ?></td>


                                    <td><?= $brand ?></td>
                                    <td style="width: 25%;"><?= $message ?></td>
                                    <td><?= $created_date ?></td>

                                    <?php if ($is_view == 1) : ?>
                                        <td align="center"> <i class="bi bi-check2-circle" style="color: #4797ff;"></i></td>
                                    <?php else : ?>
                                        <td align="center"> <a href="/customer/update-geree?id=<?= $id ?>" onclick="confirmShow()"><i class="bi bi-bell-fill" style="color: red;"></i></a></td>
                                    <?php endif; ?>
                                    <td align="center"> <a href="/customer/delete-geree?id=<?= $id ?>" onclick="confirmDelete()"><i class="bi bi-trash3-fill" style="color: red;"></i></a></td>
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

<?php require 'footer.php'; ?>
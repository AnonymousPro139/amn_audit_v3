<?php
require 'header.php';

_selectAll($stmt, $count, "select * from contracts order by id desc limit 0, 250", $id, $company_name, $company_registr, $director_name, $director_phone, $nybo_name, $nybo_phone, $email, $address, $message, $is_view, $created_date);
$counter = $count;
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
    <div style="margin: 12px;  text-align: center">
        <h3>Гэрээ байгуулах хүсэлтүүд</h3>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Д/д</th>
                                    <th>Компанийн нэр</th>
                                    <th>Компанийн регистр</th>
                                    <th>Захирлын нэр</th>
                                    <th>Захирлын утас</th>
                                    <th>Нябо-ийн нэр</th>
                                    <th>Нябо-ийн утас</th>
                                    <th>Email</th>
                                    <th>Хаяг</th>
                                    <th>Мессеж</th>
                                    <th>Огноо</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while (_fetch($stmt)) : ?>
                                    <tr>
                                        <td><?= $counter ?></td>
                                        <td><?= $company_name ?></td>
                                        <td><?= $company_registr ?></td>
                                        <td><?= $director_name ?></td>
                                        <td><?= $director_phone ?></td>
                                        <td><?= $nybo_name ?></td>
                                        <td><?= $nybo_phone ?></td>
                                        <td><?= $email ?></td>
                                        <td><?= $address ?></td>

                                        <td style="width: 25%;"><?= $message ?></td>
                                        <td><?= $created_date ?></td>

                                        <?php if ($is_view == 1) : ?>
                                            <td align="center"> <i class="bi bi-check2-circle" style="color: #4797ff;"></i></td>
                                        <?php else : ?>
                                            <td align="center"> <a href="/contract/update-geree?id=<?= $id ?>" onclick="confirmShow()"><i class="bi bi-bell-fill" style="color: orange;"></i></a></td>
                                        <?php endif; ?>

                                        <?php if ($_SESSION['role'] == 'admin') : ?>
                                            <td align="center"> <a href="/contract/edit-geree?id=<?= $id ?>"><i class="bi bi-pencil" style="color: green;"></i></a></td>
                                            <td align="center"> <a href="/contract/delete-geree?id=<?= $id ?>" onclick="confirmDelete()"><i class="bi bi-trash3-fill" style="color: red;"></i></a></td>
                                        <?php endif; ?>

                                    </tr>
                                    <?php $counter = $counter - 1; ?>
                                <?php endwhile; ?>
                                <?php _close_stmt($stmt); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require 'footer.php'; ?>
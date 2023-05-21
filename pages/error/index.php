<?php
require ROOT . '/pages/user/header.php';

if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

if ($_SESSION['role'] != 'admin') {
    redirect("/user/home");
}

_selectAll($stmt, $count, "select * from errors order by id desc limit 0, 150", $id, $created_date, $ip, $error_code, $error, $file, $line, $note);
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
        <h3>Системд үүссэн алдаанууд</h3>
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
                                    <th>Үүссэн огноо</th>
                                    <th>IP</th>
                                    <th>Error_code</th>
                                    <th>Error</th>
                                    <th>File</th>
                                    <th>Line</th>
                                    <th>note</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while (_fetch($stmt)) : ?>
                                    <tr>
                                        <td><?= $counter ?></td>
                                        <td><?= $created_date ?></td>
                                        <td><?= $ip ?></td>
                                        <td><?= $error_code ?></td>
                                        <td><?= $error ?></td>
                                        <td><?= $file ?></td>
                                        <td><?= $line ?></td>

                                        <td style="width: 25%;"><?= $note ?></td>

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

<?php require ROOT . '/pages/user/footer.php'; ?>
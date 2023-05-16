<?php
require 'header.php';

_selectAll($stmt, $count, "select * from feedback order by id desc limit 0, 100", $id, $message, $created_date);

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
        <h3>Манай веб сайтад ирсэн санал хүсэлт</h3>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Мессеж</th>
                                <th>Огноо</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while (_fetch($stmt)) : ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td style="width: 60%;"><?= $message ?></td>
                                    <td><?= $created_date ?></td>
                                    <td align="center"> <a href="/feedback/delete-feedback?id=<?= $id ?>" onclick="confirmDelete()"><i class="bi bi-trash3-fill" style="color: red;"></i></a></td>

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
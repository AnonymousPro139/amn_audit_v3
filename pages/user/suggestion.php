<?php
require 'header.php';

_selectAll($stmt, $count, "select * from suggestions order by id desc limit 0, 250", $id, $company_name, $company_registr, $brand, $borluulat,$hurungu_dun, $phone, $email, $message, $is_view, $created_date);
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
        <h3>Үнийн санал авах хүсэлтүүд</h3>
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
                                    <th>Ү/а-ны чиглэл</th>
                                    <th>Борлуулалтын орлого</th>
                                    <th>Хөрөнгийн дүн</th>
                                    <th>Утас</th>
                                    <th>Email</th>
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
                                        <td><?= $brand ?></td>
                                        <td><?= $borluulat ?></td>
                                        <td><?= $hurungu_dun ?></td>
                                        <td><?= $phone ?></td>
                                        <td><?= $email ?></td>
                                    
                                        <td style="width: 25%;"><?= $message ?></td>
                                        <td style="width: 10%;"><?= $created_date ?></td>

                                        <?php if ($is_view == 1) : ?>
                                            <td align="center"> <i class="bi bi-check2-circle" style="color: #4797ff;"></i></td>
                                        <?php else : ?>
                                            <td align="center"> <a href="/suggestion/update?id=<?= $id ?>" onclick="confirmShow()"><i class="bi bi-bell-fill" style="color: orange;"></i></a></td>
                                        <?php endif; ?>
                                        
                                        <?php if ($_SESSION['role'] == 'admin') : ?>
                                            <td align="center"> <a href="/suggestion/edit?id=<?= $id ?>"><i class="bi bi-pencil" style="color: green;"></i></a></td>
                                            <td align="center"> <a href="/suggestion/delete?id=<?= $id ?>" onclick="confirmDelete()"><i class="bi bi-trash3-fill" style="color: red;"></i></a></td>
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
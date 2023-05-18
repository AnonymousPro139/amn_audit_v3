<?php
require ROOT . '/pages/user/header.php';

if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

if ($_SESSION['role'] != 'admin') {
    redirect("/user/home");
}

$id = $_GET['id'];

if (empty($id)) {
    $errors[] = "id байхгүй!";
}

_selectAll($stmt, $count, "select * from suggestions where id=$id",$id, $company_name, $company_registr, $brand, $borluulalt,$hurungu_dun, $phone, $email, $message, $is_view, $created_date);

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
    <div style="margin: 12px; text-align: center">
        <h3>Үнийн саналын хүсэлт засварлах</h3>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th style="width: 2%;">id</th>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php while (_fetch($stmt)) : ?>
                                <tr>
                                    <form action="/suggestion/edit-do" method="post">
                                        <td > <input name="id" style="width: 30px;" value=<?= $id ?> type='text' readonly/> </td>
                                        <td><textarea name="company_name" rows="2"><?= $company_name ?></textarea></td>
                                        <td><textarea name="company_registr" rows="2"><?= $company_registr ?></textarea></td>
                                        <td><textarea name="brand" rows="2" ><?= $brand ?></textarea></td>
                                        <td><textarea name="borluulalt" rows="2"><?= $borluulalt ?></textarea></td>
                                        <td><textarea name="hurungu_dun" rows="2"><?= $hurungu_dun ?></textarea></td>
                                        <td><textarea name="phone" rows="2"><?= $phone ?></textarea></td>
                                        <td><textarea name="email" rows="2"><?= $email ?></textarea></td>
                                        <td><textarea name="message" rows="6" required><?= $message ?></textarea></td>
                                        <td><textarea name="created_date" rows="1" required readonly><?= $created_date ?></textarea></td>
                                        <td><input type="submit" value="Хадгалах" style="color: green;"></td>
                                    </form>
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
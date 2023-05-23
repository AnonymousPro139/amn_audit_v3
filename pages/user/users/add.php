<?php
require ROOT . '/pages/user/header.php';

if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

if ($_SESSION['role'] != 'admin') {
    redirect("/user/home");
}
?>

<div class="container">
    <h3 style="text-align: center; margin-top: 10px">Шинэ хэрэглэгч бүртгэх</h3>

    <form class="form-horizontal my-4" method="POST" action="/user/users/add-do">
        <div class="form-group">
            <label for="phone">Хэрэглэгч</label>
            <div class="input-group">

                <input type="text" class="form-control" name="phone" placeholder="Утасны дугаар" required>
            </div>
        </div>

        <div class="form-group" style="margin-top: 5px;">
            <label for="phone">Email хаяг</label>
            <div class="input-group">

                <input type="text" class="form-control" name="email" placeholder="И-майл хаяг бичихгүй байж болно.">
            </div>
        </div>

        <div class="form-group" style="margin-top: 5px;">
            <label for="userpassword">Нууц үг</label>
            <div class="input-group">

                <input type="password" class="form-control" name="password" placeholder="6-с дээш урттай нууц үг оруулаарай" required>
            </div>
        </div>

        <div class="form-group mb-0 row">
            <div class="col-12 mt-2">
                <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Бүртгэх <i class="fas fa-sign-in-alt ml-1"></i></button>
            </div>
        </div>
    </form>

</div>
<?php require ROOT . '/pages/user/footer.php'; ?>
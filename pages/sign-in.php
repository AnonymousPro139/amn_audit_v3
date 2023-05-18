<?php
session_start();

if (!empty($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 'true') {
    redirect('/user/home');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Нэвтрэх</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets/css/variables.css" rel="stylesheet">
</head>

<body>
    <div class="container">

        <?php if (!empty($_SESSION['errors'])) : ?>
            <div style="margin-top: 15px;">
                <ul class="text-center">
                    <?php foreach ($_SESSION['errors'] as $err) : ?>
                        <li style="color: red;"><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php unset($_SESSION['errors']);
        endif; ?>

        <form class="form-horizontal my-4" method="POST" action="sign-in-do">
            <div class="form-group">
                <label for="phone">Нэвтрэх</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="phone" placeholder="Нэвтрэх нэр эсвэл утас" required>
                </div>
            </div>

            <div class="form-group">
                <label for="userpassword">Нууц үг</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="userpassword" placeholder="Нууц үг оруулах" required>
                </div>
            </div>

            <div class="form-group mb-0 row">
                <div class="col-12 mt-2">
                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Нэвтрэх <i class="fas fa-sign-in-alt ml-1"></i></button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
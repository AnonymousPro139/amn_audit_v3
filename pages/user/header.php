<?php
session_start();

if ($_SESSION['isLoggedIn'] != "true") {
    $_SESSION['errors'] = ['Системд нэвтэрнэ үү.'];
    redirect('/sign-in');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>AMN аудит</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Variables CSS Files. Uncomment your preferred color scheme -->
    <link href="/assets/css/variables.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">

    <script src="/assets/js/admin.js"></script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="/user/home" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <!-- <img src="/assets/img/logo.png" alt=""> -->
                <h1>AMN аудит<span>.</span> </h1>
            </a>

            <h5>Хэрэглэгч: <?= $_SESSION['phone']; ?></h5>

            <nav id="navbar" class="navbar">
                <ul>

                    <li><a class="nav-link scrollto <?php if ($_SERVER['REDIRECT_URL'] == "/user/home") echo 'active'; ?>" href="/user/home">Ирсэн мэдээлэл</a></li>
                    <li><a class="nav-link scrollto <?php if ($_SERVER['REDIRECT_URL'] == "/user/feedback") echo 'active'; ?>" href="/user/feedback">Ирсэн санал, хүсэлт</a></li>

                    <?php if ($_SESSION['role'] == 'admin') : ?>
                        <li><a class="nav-link scrollto <?php if ($_SERVER['REDIRECT_URL'] == "/user/users/show") echo 'active'; ?>" href="/user/users/show">Системийн хэрэглэгчид</a></li>

                    <?php endif; ?>

                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav>

            <a class="btn-getstarted scrollto" href="/sign-out">Гарах</a>

        </div>
    </header><!-- End Header -->

    <div class="main-content" style="margin-top: 40; margin-bottom: 45;">

        <!-- <div class="page-content"> -->
        <div class="container-fluid">
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
    <link href="/assets/img/favicon.webp" rel="icon">
    <link href="/assets/img/favicon.webp" rel="apple-touch-icon">

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

    <link href="/assets/css/variables_min.css" rel="stylesheet">
    <link href="/assets/css/main_min.css" rel="stylesheet">

    <script src="/assets/js/admin.js"></script>
</head>

<body>

    <header id="header" class="header" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="/user/home" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="/assets/img/_logo.webp" alt="amnaudit logo" style="width: 5rem; height: 4.3rem; background-color: #0ea2bd; padding: 3px;" class="rounded">
            </a>

            <h4>Хэрэглэгч: <?= $_SESSION['phone']; ?><?php if ($_SESSION['role'] == 'admin') echo '(АДМИН)'; ?></h4>

            <nav id="navbar" class="navbar">
                <ul>

                    <li><a class="nav-link scrollto <?php if ($_SERVER['REDIRECT_URL'] == "/user/home") echo 'active'; ?>" href="/user/home">Гэрээ байгуулах</a></li>
                    <li><a class="nav-link scrollto <?php if ($_SERVER['REDIRECT_URL'] == "/user/suggestion") echo 'active'; ?>" href="/user/suggestion">Үнийн санал авах</a></li>
                    <li><a class="nav-link scrollto <?php if ($_SERVER['REDIRECT_URL'] == "/user/feedback") echo 'active'; ?>" href="/user/feedback">Санал, хүсэлт</a></li>

                    <?php if ($_SESSION['role'] == 'admin') : ?>
                        <li><a class="nav-link scrollto <?php if ($_SERVER['REDIRECT_URL'] == "/user/users/show") echo 'active'; ?>" href="/user/users/show">Системийн хэрэглэгчид</a></li>
                        <li><a class="nav-link scrollto <?php if ($_SERVER['REDIRECT_URL'] == "/error/index") echo 'active'; ?>" href="/error/index">Алдаа</a></li>

                    <?php endif; ?>

                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav>

            <a class="btn-getstarted scrollto" href="/sign-out">Гарах</a>

        </div>
    </header>

    <div class="main-content" style="margin-top: 40; margin-bottom: 45;">

        <div class="container-fluid">
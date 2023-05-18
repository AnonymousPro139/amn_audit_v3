<?php
session_start();
if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

if ($_SESSION['role'] != 'admin') {
    redirect("/user/suggestion");
}

$id = $_GET['id'];

$errors = [];

if (empty($id)) {
    $errors[] = "Хүлээн авах боломжгүй байна.";
}


if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "delete from suggestions where id=?",
            'i',
            [$id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Үнийн санал авах хүсэлтийг амжилттай устгалаа";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Үнийн санал авах хүсэлт устгах үед алдаа гарлаа.";
        _exec("insert into errors set created_date=now(), note='suggestion delete', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );
    }
}

redirect("/user/suggestion");

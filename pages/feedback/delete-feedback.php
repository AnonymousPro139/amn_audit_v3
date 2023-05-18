<?php
session_start();

if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

if ($_SESSION['role'] != 'admin') {
    redirect("/user/feedback");
}

$id = $_GET['id'];

$errors = [];

if (empty($id)) {
    $errors[] = "Хүлээн авах боломжгүй байна.";
}


if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "delete from feedback where id=?",
            'i',
            [$id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Амжилттай устгалаа";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Устгах үед алдаа гарлаа.";
        _exec("insert into errors set created_date=now(), note='delete-feedback', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );

    }
}

redirect("/user/feedback");

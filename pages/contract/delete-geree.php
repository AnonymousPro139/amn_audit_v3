<?php
session_start();

if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

if ($_SESSION['role'] != 'admin') {
    redirect("/user/home");
}

$id = $_GET['id'];

$errors = [];

if (empty($id)) {
    $errors[] = "Хүлээн авах боломжгүй байна.";
}


if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "delete from contracts where id=?",
            'i',
            [$id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Мэдэгдлийг амжилттай устгалаа";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Устгах үед алдаа гарлаа.";
        _exec("insert into errors set created_date=now(), note='delete_geree', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );
    }
}

redirect("/user/home");

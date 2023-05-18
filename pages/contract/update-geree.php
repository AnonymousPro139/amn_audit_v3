<?php
session_start();

if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

$id = $_GET['id'];

$errors = [];

if (empty($id)) {
    $errors[] = "Хүлээн авах боломжгүй байна.";
}

if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "update contracts set is_view=? where id=?",
            'si',
            ["1", $id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Шинэ мэдэгдлийг ХАРСАН горимд орууллаа";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Горим өөрчлөх үед алдаа гарлаа.";
        _exec("insert into errors set created_date=now(), note='update-geree', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );
    }
}

redirect("/user/home");

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
            "update suggestions set is_view=? where id=?",
            'si',
            ["1", $id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Yнийн саналыг ХАРСАН горимд орууллаа";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Yнийн саналын горим өөрчлөх үед алдаа гарлаа.";
        _exec("insert into errors set created_date=now(), note='suggestion update', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );

    }
}

redirect("/user/suggestion");

<?php
session_start();

$id = $_GET['id'];

$errors = [];

if (empty($id)) {
    $errors[] = "Хүлээн авах боломжгүй байна.";
}


if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "update customers set is_view=? where id=?",
            'si',
            ["1", $id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Шинэ мэдэгдлийг харсан горимд орууллаа";
        }
    } catch (Exception $e) {
        // error table-d bichih?

        $_SESSION['errors'] = "Горим өөрчлөх үед алдаа гарлаа.";
    }
}

redirect("/user/home");

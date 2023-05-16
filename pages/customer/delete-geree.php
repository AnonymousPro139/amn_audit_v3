<?php
session_start();

if ($_SESSION['role'] != 'admin') {
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
            "delete from customers where id=?",
            'i',
            [$id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Мэдэгдлийг амжилттай устгалаа";
        }
    } catch (Exception $e) {
        // error table-d bichih?

        $_SESSION['errors'] = "Устгах үед алдаа гарлаа.";
    }
}

redirect("/user/home");

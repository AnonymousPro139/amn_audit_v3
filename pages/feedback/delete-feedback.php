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
            "delete from feedback where id=?",
            'i',
            [$id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Амжилттай устгалаа";
        }
    } catch (Exception $e) {
        // error table-d bichih?

        $_SESSION['errors'] = "Устгах үед алдаа гарлаа.";
    }
}

redirect("/user/feedback");

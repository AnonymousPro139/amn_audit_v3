<?php
session_start();

if ($_SESSION['role'] == 'admin') {
    $id = $_GET['id'];

    $errors = [];

    if (empty($id)) {
        $errors[] = "Хүлээн авах боломжгүй байна.";
    }


    if (sizeof($errors) == 0) {
        try {
            $success = _exec(
                "delete from users where id=?",
                'i',
                [$id],
                $count
            );

            if ($count) {
                $_SESSION['success'] = "Хэрэглэгчийг амжилттай устгалаа";
            }
        } catch (Exception $e) {
            // error table-d bichih?

            $_SESSION['errors'] = "Хэрэглэгчийг устгах үед алдаа гарлаа.";
        }
    }

    redirect("/user/users/show");
}

redirect("/");

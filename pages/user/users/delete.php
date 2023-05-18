<?php
session_start();

if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

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

            $_SESSION['errors'] = "Хэрэглэгчийг устгах үед алдаа гарлаа.";
            _exec("insert into errors set created_date=now(), note='users delete', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );

        }
    }

    redirect("/user/users/show");
}

redirect("/");

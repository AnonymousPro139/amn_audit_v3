<?php
session_start();

if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

if ($_SESSION['role'] != 'admin') {
    redirect("/user/home");
}

$name = "noname";
$phone = post('phone', 16);
$email = post('email', 30);
$password = post('password', 40);
$role = "user";

$errors = [];

if (strlen($phone) < 8) {
    $errors[] = "Утасны дугаар буруу";
}

if (strlen($password) < 5) {
    $errors[] = "Муу нууц үг";
}

if (sizeof($errors) == 0) {
    try {
        $password = md5(SALT.$password);
        $success = _exec(
            "insert into users set name=?, phone=?, email=?,password=?,role=?",
            'sssss',
            [$name, $phone, $email, $password, $role],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Шинэ хэрэглэгч амжилттай нэмлээ :))";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Шинэ хэрэглэгч нэмэх үйлдэл амжилтгүй боллоо!";
        _exec("insert into errors set created_date=now(), note='users add-do', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );
    }
} else {
    $_SESSION['errors'] = "Амжилтгүй боллоо, Та оруулсан мэдээллээ сайтар шалгана уу.";
}

redirect("/user/users/show");

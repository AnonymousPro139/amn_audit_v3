<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    redirect("/");
}

$name = "noname";
$phone = post('phone', 16);
$email = post('email', 30);
$password = post('password', 40);

if ($role != "admin") {
    $role = "user";
}

$errors = [];

if (strlen($phone) < 8) {
    $errors[] = "Утасны дугаар буруу";
}

if (strlen($password) < 6) {
    $errors[] = "Муу нууц үг";
}

if (sizeof($errors) == 0) {
    try {
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
        // error table-d bichih?

        $_SESSION['errors'] = "Шинэ хэрэглэгч нэмэх үйлдэл амжилтгүй боллоо!";
    }
} else {
    $_SESSION['errors'] = "Амжилтгүй боллоо, Та оруулсан мэдээллээ сайтар шалгана уу.";
}

redirect("/user/users/show");

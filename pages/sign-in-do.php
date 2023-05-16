<?php
session_start();
$phone = post('phone', 10);
$password = post('userpassword', 12);

$errors = [];

if (strlen($phone) < 7) {
    $errors[] = 'Утасны дугаар эсвэл нууц үг буруу';
}

if (strlen($password) < 3) {
    $errors[] = 'Утасны дугаар эсвэл нууц үг буруу';
}

if (sizeof($errors) > 0) {

    $_SESSION['errors'] = $errors;
    redirect('/sign-in');
}

_selectRow(
    $stmt,
    $count,
    "select name, email, phone, role from users where phone=? and password=?",
    'ss',
    [$phone, $password],
    $name,
    $email,
    $phone,
    $role
);


if (!empty($name)) {
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['role'] = $role;

    $_SESSION['isLoggedIn'] = "true";

    redirect("/user/home");
} else {
    $_SESSION['errors'] = ['Таны утас эсвэл нууц үг буруу'];
    redirect("/sign-in");
}

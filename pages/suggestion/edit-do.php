<?php
session_start();

if ($_SESSION['isLoggedIn'] != 'true') {
    redirect("/");
}

if ($_SESSION['role'] != 'admin') {
    redirect("/user/home");
}

$id = post('id');
$company_registr = post('company_registr', 16);
$company_name = post('company_name', 60);
$brand = post('brand', 60);
$borluulalt = post('borluulalt', 50);
$hurungu_dun = post('hurungu_dun', 50);
$phone = post('phone', 16);
$email = post('email', 40);
$message = post('message');

$errors = [];

if (empty($id)) {
    $errors[] = "Өөрчлөлт хийх боломжгүй!";
}

if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "update suggestions set company_registr=?, company_name=?, brand=?, borluulalt=?, hurungu_dun=?,phone=?,email=?, message=? where id=?",
            'ssssssssi',
            [$company_registr, $company_name, $brand,$borluulalt,$hurungu_dun,$phone,$email, $message, $id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Үнийн саналд өөрчлөлт амжилттай хийгдлээ";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Үнийн саналд өөрчлөлт хийх үед алдаа гарлаа.";
        _exec("insert into errors set created_date=now(), note='suggestion edit-do', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );

    }
}

redirect("/user/suggestion");

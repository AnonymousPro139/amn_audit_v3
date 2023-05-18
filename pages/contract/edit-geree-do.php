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
$director_name = post('director_name', 60);
$director_phone = post('director_phone', 16);
$email = post('email', 40);
$nybo_name = post('nybo_name', 60);
$nybo_phone = post('nybo_phone', 16);
$address = post('address', 100);
$message = post('message');

$errors = [];

if (empty($id)) {
    $errors[] = "Өөрчлөлт хийх боломжгүй!";
}

if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "update contracts set company_registr=?, company_name=?, director_name=?, director_phone=?, email=?,nybo_name=?,nybo_phone=?, address=?, message=? where id=?",
            'sssssssssi',
            [$company_registr, $company_name, $director_name,$director_phone,$email,$nybo_name,$nybo_phone,$address,$message, $id],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Өөрчлөлт амжилттай хийгдлээ";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Өөрчлөлт хийх үед алдаа гарлаа.";
        _exec("insert into errors set created_date=now(), note='edit-geree-dp', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );
    }
}

redirect("/user/home");

<?php
session_start();

$company_registr = post('company_registr', 16);
$company_name = post('company_name', 60);
$brand = post('brand', 60);
$borluulalt = post('borluulalt', 50);
$email = post('email', 40);
$hurungu_dun = post('hurungu_dun', 50);
$phone = post('phone', 16);
$message = post('message');

$errors = [];

if (strlen($phone) < 8) {
    $errors[] = "Таны оруулсан утасны дугаар буруу байна.";
}

if (strlen($email) < 5) {
    $errors[] = "Таны оруулсан email хаяг буруу байна";
}

if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "insert into suggestions set company_registr=?, company_name=?,brand=?, borluulalt=?,email=?, hurungu_dun=?, phone=?, message=?",
            'ssssssss',
            [$company_registr, $company_name, $brand, $borluulalt,  $email, $hurungu_dun, $phone, $message],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Амжилттай илгээгдлээ, бид таньтай холбогдох болно, баярлалаа";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Таны илгээсэн мэдээлэл амжилтгүй боллоо!";
        _exec("insert into errors set created_date=now(), note='suggestion add', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );

    }
} else {
    $_SESSION['errors'] = "Амжилтгүй, Та илгээх мэдээллээ сайтар шалгаж оруулна уу.";
}

redirect("/");

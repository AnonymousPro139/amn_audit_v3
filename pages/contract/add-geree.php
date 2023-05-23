<?php
session_start();

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

if (strlen($director_phone) < 8 || strlen($nybo_phone) < 8) {
    $errors[] = "Таны оруулсан утасны дугаар буруу байна.";
}

if (strlen($email) < 5) {
    $errors[] = "Email хаяг буруу байна";
}

if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "insert into contracts set company_registr=?, company_name=?,director_name=?, director_phone=?,email=?, nybo_name=?, nybo_phone=?, address=?,message=?",
            'sssssssss',
            [$company_registr, $company_name, $director_name, $director_phone,  $email, $nybo_name, $nybo_phone, $address, $message],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Амжилттай илгээгдлээ, бид таньтай холбогдох болно, баярлалаа";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Таны илгээсэн мэдээлэл амжилтгүй боллоо!";
        _exec("insert into errors set created_date=now(), note='add_geree', ip=?, error_code=?, error=?,file=?, line=?", "sissi", [getIpAddress(), $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine()], $count);
    }
} else {
    $_SESSION['errors'] = "Амжилтгүй!, Та илгээсэн мэдээллээ сайтар шалгана уу.";
}

redirect("/");

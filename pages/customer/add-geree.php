<?php
session_start();
// dd($_POST);
// exit;

$company_registr = post('company_registr', 16);
$company_name = post('company_name', 30);
$brand = post('brand', 50);
$email = post('email', 40);
$name = post('name', 30);
$phone = post('phone', 16);
$message = post('message');

$errors = [];

if (strlen($phone) < 8) {
    $errors[] = "Утасны дугаар буруу";
}

if (strlen($email) < 4) {
    $errors[] = "Email хаяг буруу";
}

if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "insert into customers set company_registr=?, company_name=?, brand=?, email=?,name=?,phone=?,message=?",
            'sssssss',
            [$company_registr, $company_name, $brand, $email, $name, $phone, $message],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Амжилттай илгээгдлээ. Бид таньтай холбогдох болно, баярлалаа :))";
        }
    } catch (Exception $e) {
        // error table-d bichih?

        $_SESSION['errors'] = "Таны илгээсэн мэдээлэл амжилтгүй боллоо!";
    }
} else {
    $_SESSION['errors'] = "Амжилтгүй!, Та илгээсэн мэдээллээ сайтар шалгана уу.";
}

redirect("/");

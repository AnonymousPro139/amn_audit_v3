<?php
session_start();

$feedback = post('feedback', 60);
$phone = post('phone', 8);

$errors = [];

if (strlen($feedback) < 5) {
    $errors[] = "Хүлээн авах боломжгүй утга оруулсан байна.";
}

if (strlen($phone) < 8) {
    $errors[] = "Хүлээн авах боломжгүй утга оруулсан байна.";
}


if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "insert into feedback set message=?, phone=?",
            'ss',
            [$feedback, $phone],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Таны санал, хүсэлт амжилттай илгээгдлээ, баярлалаа";
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = "Хүлээн авах боломжгүй санал, хүсэлт байна.";
        _exec("insert into errors set created_date=now(), note='add_feedback', ip=?, error_code=?, error=?,file=?, line=?", "sissi",[getIpAddress(), $e->getCode(),$e->getMessage(), $e->getFile(), $e->getLine() ], $count );
    }
} else {
    $_SESSION['errors'] = "Хүлээн авах боломжгүй санал, хүсэлт байна.";
}

redirect("/");

<?php
session_start();

$feedback = post('feedback', 60);

$errors = [];

if (strlen($feedback) < 5) {
    $errors[] = "Хүлээн авах боломжгүй байна.";
}


if (sizeof($errors) == 0) {
    try {
        $success = _exec(
            "insert into feedback set message=?",
            's',
            [$feedback],
            $count
        );

        if ($count) {
            $_SESSION['success'] = "Таны санал, хүсэлт амжилттай илгээгдлээ. Баярлалаа :))";
        }
    } catch (Exception $e) {
        // error table-d bichih?

        $_SESSION['errors'] = "Хүлээн авах боломжгүй санал, хүсэлт байна.";
    }
} else {
    $_SESSION['errors'] = "Хүлээн авах боломжгүй санал, хүсэлт байна.";
}

redirect("/");

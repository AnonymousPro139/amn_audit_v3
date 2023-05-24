<?php

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno() === 1049) {
    die("Ийм нэртэй баз байхгүй");
} elseif (mysqli_connect_errno() === 1045) {
    die("Hereglegchiin medeelel buruu");
} elseif (mysqli_connect_errno()) {
    die("aldaa: " . mysqli_connect_error());
}


// sql to create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25),
    phone VARCHAR(16) NOT NULL,
    email VARCHAR(40),
    password VARCHAR(32),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    role VARCHAR(5)
    )";

if ($con->query($sql) !== TRUE) {
    echo "Error creating user table: " . $conn->error;
    exit;
} else {
    $checkFile = ROOT . '/pages/check.php';

    if (file_exists($checkFile)) {
        _exec(
            "insert into users set name=?, phone=?, email=?,password=?,role=?",
            'sssss',
            ['amnaudit', '99093146', 'noemail', md5(SALT.'Semuun1107'), 'admin'],
            $count
        );
        unlink($checkFile); //remove
    } 
}



// sql to create contracts table
$sql = "CREATE TABLE IF NOT EXISTS contracts (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(60) NOT NULL,
    company_registr VARCHAR(16) NOT NULL,
    director_name VARCHAR(60) NOT NULL,
    director_phone VARCHAR(16) NOT NULL,
    nybo_name VARCHAR(60) NOT NULL,
    nybo_phone VARCHAR(16) NOT NULL,
    email VARCHAR(40),
    address VARCHAR(100),
    message TEXT,
    is_view BOOL DEFAULT FALSE,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($con->query($sql) !== TRUE) {
    echo "Error creating contracts table: " . $conn->error;
    exit;
}

// sql to create suggestion table
$sql = "CREATE TABLE IF NOT EXISTS suggestions (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(60) NOT NULL,
    company_registr VARCHAR(16) NOT NULL,
    brand VARCHAR(60) NOT NULL,
    borluulalt VARCHAR(50) NOT NULL,
    hurungu_dun VARCHAR(50) NOT NULL,
    phone VARCHAR(16) NOT NULL,
    email VARCHAR(40),
    message TEXT,
    is_view BOOL DEFAULT FALSE,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($con->query($sql) !== TRUE) {
    echo "Error creating suggestions table: " . $conn->error;
    exit;
}

// sql to create feedback table
$sql = "CREATE TABLE IF NOT EXISTS feedback (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    message TEXT,
    phone VARCHAR(8) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($con->query($sql) !== TRUE) {
    echo "Error creating feedback table: " . $conn->error;
    exit;
}

// sql to create error table
$sql = "CREATE TABLE IF NOT EXISTS errors (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_date datetime,
    ip VARCHAR(15),
    error_code INTEGER,
    error VARCHAR(500),
    file VARCHAR(300),
    line INTEGER,
    note VARCHAR(150)
    )";

if ($con->query($sql) !== TRUE) {
    echo "Error creating error table: " . $conn->error;
    exit;
}


function _exec($sql, $types, $sqlParams, &$count)
{
    global $con;
    mysqli_report(MYSQLI_REPORT_ALL);
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);

    $success = mysqli_stmt_execute($stmt);
    $count = mysqli_stmt_affected_rows($stmt);
    _close_stmt($stmt);

    return $success;
}

function _selectAll(&$stmt, &$count, $sql, &...$bindParams)
{
    _select($stmt, $count, $sql, null, null, ...$bindParams);
}

function _select(&$stmt, &$count, $sql, $types, $sqlParams, &...$bindParams)
{
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    if (!is_null($types)) {
        mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_bind_result($stmt, ...$bindParams);
}

function _selectRow(&$stmt, &$count, $sql, $types, $sqlParams, &...$bindParams)
{
    _select($stmt, $count, $sql, $types, $sqlParams, ...$bindParams);
    _fetch($stmt);
}

function _close_stmt($stmt)
{
    mysqli_stmt_close($stmt);
}

function _close($stmt = null)
{
    global $con;

    if (!is_null($stmt)) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($con);
}

function _fetch($stmt)
{
    return mysqli_stmt_fetch($stmt);
}

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
    name VARCHAR(25) NOT NULL,
    phone VARCHAR(16) NOT NULL,
    email VARCHAR(40),
    password VARCHAR(32),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    role VARCHAR(5)
    )";

if ($con->query($sql) !== TRUE) {
    echo "Error creating user table: " . $conn->error;
    exit;
}

// sql to create customers table
$sql = "CREATE TABLE IF NOT EXISTS customers (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(60) NOT NULL,
    company_registr VARCHAR(20) NOT NULL,
    name VARCHAR(60) NOT NULL,
    phone VARCHAR(16) NOT NULL,
    email VARCHAR(40),
    brand VARCHAR(100),
    message TEXT,
    is_view BOOL DEFAULT FALSE,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($con->query($sql) !== TRUE) {
    echo "Error creating customers table: " . $conn->error;
    exit;
}

// sql to create feedback table
$sql = "CREATE TABLE IF NOT EXISTS feedback (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    message TEXT,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($con->query($sql) !== TRUE) {
    echo "Error creating feedback table: " . $conn->error;
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

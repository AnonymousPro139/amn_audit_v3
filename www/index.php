<?php
define("ROOT", dirname(dirname(__FILE__)));
require ROOT . '/inc/conf.php';
require ROOT . '/inc/db.php';

// $page = @$_SERVER['REDIRECT_URL'];

$page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$page = rtrim($page, '/');

// if (empty($page)) {

if ($page === '') {
    require ROOT . '/pages/index.html';
} else {
    $script = ROOT . '/pages' . $page . '.php';

    if (file_exists($script)) {
        require $script;
    } else {
        require ROOT . '/pages/404.php';
    }
}

function dd($arr)
{
    echo '<pre>';
    print_r($arr);
    exit;
}

function redirect($url)
{
    header("Location: $url");
    exit;
}

function post($name, $len = null)
{
    $value = trim($_POST[$name]);
    $value = stripslashes($value); //  \' --> ' ; O\'reilly? -> O'reilly
    $value = addslashes($value); // quote string with slashes -> ""  \"\"
    $value = htmlspecialchars($value); // convert special chars to html entity  <a --> &lt;a

    if (!is_null($len) && mb_strlen($value)) {
        $value = mb_substr($value, 0, $len);
    }

    return $value;
}

function today()
{
    $today = getdate(date("U"));

    $ret = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"];
    return $ret;
}

function getIpAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){ // check ip from share internet
        return $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        // to check ip is pass from proxy
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $_SERVER['REMOTE_ADDR'];
}
<?php
define("ROOT", dirname(dirname(__FILE__)));

require ROOT . '/inc/conf.php';

require ROOT . '/inc/db.php';

$page = @$_SERVER['REDIRECT_URL'];

if (empty($page)) {
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
}

function redirect($url)
{
    header("Location: $url");
    exit;
}

function post($name, $len = null)
{
    $value = $_POST[$name];

    $value = addslashes($value);

    if (!is_null($len) && mb_strlen($value)) {
        $value = mb_substr($value, 0, $len);
        // security problem uusgene
        // echo "security";
    }
    return $value;
}

function today()
{
    $today = getdate(date("U"));

    $ret = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"];
    return $ret;
}

<?php
session_start();
_close(); // connection close

session_unset();
session_destroy();
$_SESSION = array();

redirect("/");

<?php
session_start();

$index = $_POST['index'];
$type = $_POST['type'];

if (isset($_SESSION[$type][$index])) {
    unset($_SESSION[$type][$index]);

    $_SESSION[$type] = array_values($_SESSION[$type]);
}

echo "success";
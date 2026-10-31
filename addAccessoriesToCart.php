<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['accessoriesCart'])) {
    $_SESSION['accessoriesCart'] = [];
}

$_SESSION['accessoriesCart'][] = [
    'accessoriesID' => $data['accessoriesID']
];

echo "success";
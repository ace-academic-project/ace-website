<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][] = [
    'colourID' => $data['colourID'],
    'capID'    => $data['capID'],
    'iconID'   => $data['iconID'],
    'price'    => $data['price']
];



echo "success";
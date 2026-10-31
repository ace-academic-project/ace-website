<?php
session_start();
require_once 'db.php';

$cart = [];

if (isset($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $personalisationID) {

        $stmt = $conn->prepare("
            SELECT *
            FROM personalisations
            WHERE personalisationID = ?
        ");

        $stmt->bind_param("i", $personalisationID);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $cart[] = $row;
        }
    }
}

header('Content-Type: application/json');
echo json_encode($cart);

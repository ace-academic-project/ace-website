<?php
session_start();
$_SESSION['bottleCount'] = count($_SESSION['cart']);

include 'db.php';

$bottleCount = $_SESSION['bottleCount'];

$conn->query("
    DELETE FROM personalisations
    ORDER BY personalisationID DESC
    LIMIT $bottleCount
");

header("Location: cart.php");
exit;
?>
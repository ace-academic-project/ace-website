<?php
require_once 'db.php';

$id = (int)$_GET['id'];

$stmt = $conn->prepare("
    SELECT *
    FROM bottle_colours
    WHERE colourID = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_assoc();

echo json_encode($row);
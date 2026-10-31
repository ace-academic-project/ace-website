<?php
require_once 'db.php';

$id = (int)$_GET['id'];

$stmt = $conn->prepare("
    SELECT *
    FROM icons
    WHERE iconID = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_assoc();

echo json_encode($row);

$stmt->close();
$conn->close();
?>
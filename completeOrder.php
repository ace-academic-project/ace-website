<?php
session_start();
$_SESSION['bottleCount'] = count($_SESSION['cart']);

include 'db.php';

$bottleCount = $_SESSION['bottleCount'];

$result = $conn->query("
    SELECT SUM(Price) AS bottleTotalPrice
    FROM (
        SELECT Price
        FROM personalisations
        ORDER BY personalisationID DESC
        LIMIT $bottleCount
    ) AS latest
");

$row = $result->fetch_assoc();
$bottleTotalPrice = $row['bottleTotalPrice'];

$ids = [];

foreach ($_SESSION['accessoriesCart'] as $item) {
    $ids[] = (int)$item['accessoriesID'];
}



if (!empty($ids)) {
    $idList = implode(',', $ids);

    $result = $conn->query("
        SELECT SUM(accessoriesPrice) AS totalAccessoriesPrice
        FROM accessories
        WHERE accessoriesID IN ($idList)
    ");

    $row = $result->fetch_assoc();
    $totalAccessoriesPrice = $row['totalAccessoriesPrice'];
}

$userID = $_SESSION['user_id'];
$totalPrice = $bottleTotalPrice + $totalAccessoriesPrice;
$stmt = $conn->prepare("
    INSERT INTO orders
    (customerID, totalPrice)
    VALUES (?, ?)
");

$stmt->bind_param(
    "ii",
    $userID,
    $totalPrice
);

$stmt->execute();

$orderID = $conn->insert_id;

$result = $conn->query("
    SELECT personalisationID, Price
    FROM personalisations
    ORDER BY personalisationID DESC
    LIMIT $bottleCount
");

while ($row = $result->fetch_assoc()) {

    $stmt = $conn->prepare("
        INSERT INTO order_items
        (orderID, personalisationID, price)
        VALUES (?, ?, ?)
    ");

    $stmt->bind_param(
        "iii",
        $orderID,
        $row['personalisationID'],
        $row['Price']
    );

    $stmt->execute();
}
$ids = [];

foreach ($_SESSION['accessoriesCart'] as $item) {
    $ids[] = (int)$item['accessoriesID'];
}



if (!empty($ids)) {
    $idList = implode(',', $ids);

    $result = $conn->query("
        SELECT accessoriesID,accessoriesPrice
        FROM accessories
        WHERE accessoriesID IN ($idList)
    ");

    while ($row = $result->fetch_assoc()) {

    $stmt = $conn->prepare("
        INSERT INTO order_items
        (orderID, accessoriesID, Price)
        VALUES (?, ?, ?)
    ");
    $accessoriesID = $row['accessoriesID'];
    $accessoriesPrice = $row['accessoriesPrice'];

    $stmt->bind_param(
        "iii",
        $orderID,
        $accessoriesID,
        $accessoriesPrice
    );

    $stmt->execute();
}
}


unset($_SESSION['cart']);
unset($_SESSION['accessoriesCart']);

header("Location: orderSuccess.php?orderID= . $orderID&total=$totalPrice");
exit;
?>
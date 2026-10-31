<?php
session_start();
include 'db.php';

if (!empty($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $item) {

        $colourID = $item['colourID'];
        $capID = $item['capID'];
        $iconID = $item['iconID'];

        $colourResult = $conn->query(
            "SELECT Price FROM bottle_colours WHERE colourID = $colourID"
        );
        $colourPrice = $colourResult->fetch_assoc()['Price'];

        $capResult = $conn->query(
            "SELECT Price FROM caps WHERE capID = $capID"
        );
        $capPrice = $capResult->fetch_assoc()['Price'];

        $iconPrice = 0;

        if ($iconID > 0) {
            $iconResult = $conn->query(
                "SELECT Price FROM icons WHERE iconID = $iconID"
            );
            $iconPrice = $iconResult->fetch_assoc()['Price'];
        }

        $totalPrice = $colourPrice + $capPrice + $iconPrice;

        $stmt = $conn->prepare("
            INSERT INTO personalisations
            (colourID, capID, iconID, Price)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "iiii",
            $colourID,
            $capID,
            $iconID,
            $totalPrice
        );

        $stmt->execute();
    }

    
}

echo "success";
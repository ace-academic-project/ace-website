<?php
session_start();

unset($_SESSION['accessoriesCart']);
unset($_SESSION['cart']);

header("Location: cart.php");
exit;
?>
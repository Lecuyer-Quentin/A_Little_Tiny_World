<?php
session_start();
require_once '../../config/db.php';
require_once '../../page.inc.php';
global $pdo;

$cart = new Cart();
$ps = new ProduitRepo($pdo);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id']) || !is_numeric($_POST['id']) || !isset($_POST['quantity']) || !is_numeric($_POST['quantity'])) {
        die("Invalid request");
    }
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    
    $cart->addToCart($id, $quantity);

    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: ../index.php');
    }
    exit;
} else {
    die("Invalid request");
}

<?php
global $pdo;
if($_GET['page'] == 'product' && $_GET['id']){
    $product = new ProduitRepo($pdo);
    $product = $product->read_one($_GET['id']);
    require_once 'views/product/index.php';
}else{
    $products = new ProduitRepo($pdo);
    $products = $products->read_all();
    require_once 'views/products/index.php';
}
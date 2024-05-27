<?php
global $pdo;
    $page = isset($_GET['page']) ? $_GET['page'] : 'products';
    $page =  basename($page);
    $category = isset($_GET['category']) ? $_GET['category']: '';
    $category =  basename($category);

 if($page == 'products' && $category){
    $products = new ProduitRepo($pdo);
    $products = $products->read_by_categorie($category);

 }else{ 
    $products = new ProduitRepo($pdo); 
    $products = $products->read_all();
 }


<?php

require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['id'])) {
        header('Location: index.php?page=admin&section=products');
        exit;
    }
    
    $id = isset($_POST['id']) ? $_POST['id'] : $product->get_value_of('id');
    $nom = isset($_POST['nom']) ? $_POST['nom'] : $product->get_value_of('nom');
    $description = isset($_POST['description']) ? $_POST['description'] : $product->get_value_of('description');
    $prix = isset($_POST['prix']) ? $_POST['prix'] : $product->get_value_of('prix');
    $inStock = isset($_POST['inStock']) ? $_POST['inStock'] : $product->get_value_of('inStock');
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : $product->get_value_of('categorie')->get_value_of('id');
    $special = isset($_POST['special']) ? $_POST['special'] : $product->get_value_of('special')->get_value_of('id');
    
    $image = isset($_FILES['image']) && !empty($_FILES['image'])
    ? $_FILES['image'] : '';


    try{
        $product = new ProduitRepo($pdo);

        $image = upload_images($image, 'images/products/');
    
        $modify_product = [
            'nom' => $nom,
            'description' => $description,
            'prix' => $prix,
            'inStock' => $inStock,
            'categorie' => $categorie,
            'special' => $special,
            'image' => $image,
        ];

        $product->update($id, $modify_product);

        $response = [
            'status' => 'success',
            'message' => 'Le produit '. $nom . ' a été modifié avec success',
            'redirect' => RACINE_SITE . '../../index.php?page=admin&section=products'
        ];

    } catch (PDOException $e) {
        $errors= 'Une erreur est survenue.';
    }

    //if(!empty($errors)) {
    //    $response = array(
    //        'status' => 'error',
    //        'message' => $errors,
    //    );
    //}

    //echo json_encode($response);
    if($response['status'] == 'success') {
        header('Location: ' . $response['redirect']);
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    exit;
}
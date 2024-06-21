<?php
require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if(!isset($_POST['nom']) || empty($_POST['nom'])
    || !isset($_POST['prix']) || empty($_POST['prix']) || !is_numeric($_POST['prix'])
    || !isset($_POST['categorie']) || empty($_POST['categorie'])
    || !isset($_POST['special']) || empty($_POST['special'])
    || !isset($_POST['description']) || empty($_POST['description'])
    || !isset($_POST['inStock']) || empty($_POST['inStock']) || !is_numeric($_POST['inStock'])
    || !isset($_FILES['image'])
    ) {
        $errors = 'Veuillez remplir tous les champs';
    }

    $nom = strip_tags(htmlspecialchars($_POST['nom']));
    $prix = floatval(strip_tags(htmlspecialchars($_POST['prix'])));
    $categorie = intval(strip_tags(htmlspecialchars($_POST['categorie'])));
    $special = intval(strip_tags(htmlspecialchars($_POST['special'])));
    $description = strip_tags(htmlspecialchars($_POST['description']));
    $inStock = intval(strip_tags(htmlspecialchars($_POST['inStock'])));
    $image = $_FILES['image'];
    
    if($image['error'] === UPLOAD_ERR_NO_FILE) {
        $errors = 'Image is required';
    }
    try {
        $product = new ProduitRepo($pdo);
        $categorieRepo = new CategorieRepo($pdo);
        $specialRepo = new SpecialRepo($pdo);
        $categorie = $categorieRepo->read_one($categorie);
        $special = $specialRepo->read_one($special);

        //if(empty($errors)) {
            $image = upload_images($image, 'images/products/');
            
            $product->create([
                'nom' => $nom,
                'prix' => $prix,
                'inStock' => $inStock,
                'categorie' => $categorie,
                'image' => $image,
                'special' => $special,
                'description' => $description
            ]);

        //}

        $response = array(
            'status' => 'success',
            'message' => "Le Produit " . $nom . " a été ajouté avec succès.". "<br />" . "Categorie: " . $categorie . "<br />" . "Special: " . $special,
            'redirect' => RACINE_SITE . 'index.php?page=admin&section=products'
        );
    } catch (Exception $e) {
        $errors = 'Une erreur est survenue';
    }

    if(!empty($errors)) {
       // $response = array(
       //     'status' => 'error',
       //     'message' => $errors,
       // );
    }

    //echo json_encode($response);

    if($response['status'] == 'success') {
        header('Location: ' . $response['redirect']);
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    exit;
}



<?php
require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_POST['id'])){
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    $id = $_POST['id'];

    try {
        $product = new ProduitRepo($pdo);
        $nom = $product->read_one($id)->get_value_of('nom');
        $product->delete($id);
        //$response = [
        //    'status'=> 'success',
        //    'message' => 'Le produit ' . $nom .' a été supprimé avec succès.',
        //    'redirect' => $_SERVER['HTTP_REFERER']
        //];
    } catch (PDOException $e){
        $errors = 'Une erreur est survenue';
    }

    //echo json_encode($response);
    header('Location: ../../index.php?page=admin&section=products');
    exit;
}
<?php
    require_once '../../config/db.php';
    require_once '../../page.inc.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(!isset($_POST['search']) || empty($_POST['search'])) {
            $response = array('status' => 'error', 'message' => 'Veuillez entrer un terme de recherche');
        }
        $search = $_POST['search'];
        $search = htmlspecialchars($search);
        $search = trim($search);
        $search = strip_tags($search);
        $search = strtolower($search);
        $search = explode(' ', $search);
        $search = implode('%', $search);
        $search = '%' . $search . '%';
        
        try{
            $product = new ProduitRepo($pdo);
            $products = $product->search($search);
            if(!$products) {
                $products = [];
            } else {
                $count = count($products);
                while($count > 0) {
                    $count -= 1;
                    $data = $products[$count]->get_all_data();
                    $card = new Card($data);
                    $results[] = $card->card_sm();
                }
                if(!empty($results)) {
                    $response = array('status' => 'success', 'results' => $results);
                } else {
                    $response = array('status' => 'error', 'results' => 'Aucun produit trouvé');
                }
            }
        } catch (Exception $e) {
            $response = array('status' => 'error', 'results' => 'Erreur lors de la recherche');
        }

        echo json_encode($response);
        exit;
    } 
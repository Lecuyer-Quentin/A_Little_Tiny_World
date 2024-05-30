<?php
    require_once '../../config/db.php';
    require_once '../../page.inc.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(!isset($_POST['search']) || empty($_POST['search'])) {
            $errors = 'Veuillez entrer un mot clé';
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
                $errors = 'Aucun produit trouvé';
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
                }
            }
        } catch (Exception $e) {
            $errors = $e->getMessage();
        }

        if(isset($errors) && !empty($errors)) {
            $response = array('status' => 'error', 'message' => $errors);
        }

        echo json_encode($response);
        exit;
}
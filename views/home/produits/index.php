<?php
    global $pdo;

    $products = new ProduitRepo($pdo);
    $products = $products->read_limit(6);

    function display_product_limit($products) {
        $cards = [];
        foreach ($products as $product) {
            $data = $product->get_all_data();
            $card = new Card($data);
            $cards[] = $card->card_sm();
        }
        return implode('', $cards);
    }

$product_cards = display_product_limit($products);
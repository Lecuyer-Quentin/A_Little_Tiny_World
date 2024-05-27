<?php
    function render_favorite($favorites) {
        global $pdo;
        $html = "<div class='row d-flex justify-content-around flex-wrap'>";
        $html .= "<h3>Vos favoris</h3>";
        
        if(!empty($favorites)) {
            foreach($favorites as $favorite){
                $product = new ProduitRepo($pdo);
                $product = $product->read_one($favorite);
                $data = $product->get_all_data();
                $card = new Card($data);
                $html .= $card->card_sm();
            }
        $html .= "</div>";
        } else {
            $html .= '<div class="alert alert-warning" role="alert">Aucun produit trouvé</div>';
        }
        return $html;
    }
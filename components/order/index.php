<?php

    function render_order() {
        global $pdo;
        $html = "<div class='row d-flex justify-content-around flex-wrap'>";
        $html .= "<h3>Vos commandes</h3>";
                $product = new CommandeRepo($pdo);
                $product = $product->read_all();
                if($product) {
                    $html .= $product;
                } else {
                    $html .= "<div class='alert alert-warning' role='alert'>Aucune commande trouvée.</div>";
            }
    
        return $html;
    }
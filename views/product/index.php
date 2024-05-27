<section class="container container-fluid">
    <?php require_once 'router/product/router.php'; ?>
    <h2 class="text-center">Détails du produit <?php echo $product->get_value_of('nom'); ?></h2>
    
    <article class="d-flex flex-column align-items-center justify-content-around position-relative
                    flex-md-row align-items-md-start mt-md-4">
            <?php if(!empty($product)){
                $data = $product->get_all_data();
                $card = new Card($data);
                echo $card->card_md();
                echo '</br>';
                echo $product->accordion();
            }else{
                echo '<div class="alert alert-warning" role="alert">Aucun produit trouvé</div>';
            }    
        ?>
    </article>
</section>

<aside class="container container-fluid d-flex flex-column align-items-center justify-content-start">
        <h2>Produits similaires</h2>
              
    <article class="row d-flex justify-content-around flex-wrap">
        <?php
            $same_category = new ProduitRepo($pdo);
            $same_category = $same_category->read_by_categorie($product->get_value_of('categorie')->get_value_of('id'));
            if(!empty($same_category)){
                foreach($same_category as $product){
                    $data = $product->get_all_data();
                    $card = new Card($data);
                    echo $card->card_sm();
                }
            }else{
                echo '<div class="alert alert-warning" role="alert">Aucun produit trouvé</div>';
            }
        ?>
    </article>
</aside>


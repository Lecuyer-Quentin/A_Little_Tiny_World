<section class="container container-fluid">
    <?php 
        require_once 'components/menu/products.php';
        require_once 'router/products/router.php';
        if(isset($_GET['category'])){
            $category = new CategorieRepo($pdo);
            $category = $category->read_one($_GET['category']);
            $title = 'Découvrez nos '.$category->get_value_of('nom').'s';
        }else{
            $title = 'Découvrez nos produits';
        }
    ?>
    <h2 class="text-center mt-3">
        <?= $title ?>
    </h2>
    <article class="row d-flex justify-content-around flex-wrap gap-3">
        <?php
        if(!empty($products)){
            foreach($products as $product){
                $data = $product->get_all_data();
                $card = new Card($data);
                echo $card->card_sm();
            }
        }else{
            echo '<div class="alert alert-warning" role="alert">Aucun produit trouvé</div>';
        }
        ?>
    </article>
    
</section>
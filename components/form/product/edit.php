<?php
    global $pdo;

    if($_GET['section'] == 'products' && $_GET['action'] == 'edit') {
        if(!isset($_GET['id'])) {
            header('Location: index.php?page=admin&section=products');
            exit;
        }
        $id = $_GET['id'];
        $product = new ProduitRepo($pdo);
        $product = $product->read_one($id);

        $categories = new CategorieRepo($pdo);
        $categories = $categories->read_all();

        $special = new SpecialRepo($pdo);
        $special = $special->read_all();
    }
?>


<form id="" class="form" action="controllers/product/edit.php" method="POST" enctype="multipart/form-data">
    <div>
        <h2>Modifier le produit : <br /> <?php echo $product->__toString(); ?></h2>
    </div>
    <div class="d-flex flex-column">
        <div>
            <input type="hidden" name="id" value="<?php echo $product->get_value_of('id'); ?>">
        </div>
        <div>
            <label for="nom">Nom</label>
            <input class="form-control" type="text" name="nom"value="<?php echo $product->get_value_of('nom'); ?>">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea class="form-control" name="description" cols="30" rows="10"><?php echo $product->get_value_of('description'); ?></textarea>
        </div>
        <div>
            <label for="prix">Prix</label>
            <input class="form-control" type="text" name="prix" value="<?php echo $product->get_value_of('prix'); ?>">
        </div>
        <div>
            <label for="inStock">Stock</label>
            <select name="inStock" class="form-control">
                <?php
                    for($i = 0; $i <= 1; $i++) {
                        if($i == 0)
                            $render = 'En rupture de stock';
                        else if($i == 1){
                            $render = 'En stock';
                        }
                        $selected = ($i == $product->get_value_of('inStock')) ? 'selected' : '';
                        echo "<option value='$i' $selected>$render</option>";
                    }
                ?>
            </select>
        </div>
       
        <div>
            <label for="categorie">Catégorie</label>
            <select name="categorie" class="form-control">
                <?php
                    foreach($categories as $categorie) {
                        $id = $categorie->get_value_of('id');
                        $nom = $categorie->get_value_of('nom');
                        $selected = ($id == $product->get_value_of('categorie')->get_value_of('id')) ? 'selected' : '';
                        echo "<option value='$id' $selected>$nom</option>";
                    }
                ?>
            </select>
        </div>

        <div>
            <label for="special">Promotion</label>
            <select name="special" class="form-control">
                <?php
                    foreach($special as $promo) {
                        $id = $promo->get_value_of('id');
                        $nom = $promo->get_value_of('nom');
                        $selected = ($id == $product->get_value_of('special')->get_value_of('id')) ? 'selected' : '';
                        echo "<option value='$id' $selected>$nom</option>";
                    }
                ?>
            </select>
        </div>

        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="d-flex justify-content-around mt-3">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </div>
</form>



        
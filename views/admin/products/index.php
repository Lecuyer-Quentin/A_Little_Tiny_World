
<?php 
    require_once 'components/form/product/delete.php';
    global $pdo;
    $products = new ProduitRepo($pdo);
    $products = $products->read_all();
?>

<article>
    <div class="d-flex justify-content-between align-items-center">
        <h2>Produits</h2>
        <a href="<?php echo RACINE_SITE; ?>index.php?page=admin&section=products&action=add" class="btn btn-success">
            Ajouter un produit
        </a>
    </div>

    <aside>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="d-none d-md-table-cell">Id</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th class="d-none d-xl-table-cell">Description</th>
                    <th class="d-none d-md-table-cell">Image</th>
                    <th class="d-none d-md-table-cell">Catégorie</th>
                    <th class="d-none d-md-table-cell">Spécial</th>
                    <th>Stock</th>
                    <th class='text-center'>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($products as $product){
                        $id = $product->get_value_of('id');
                        $nom = $product->get_value_of('nom');
                        $prix = $product->get_value_of('prix');
                        $description = $product->get_value_of('description');
                        $image = $product->get_value_of('image');
                        $categorie = $product->get_value_of('categorie')->get_value_of('nom');
                        $special = $product->get_value_of('special')->get_value_of('nom');
                        $stock = $product->get_value_of('inStock') ? 'En stock' : 'Rupture de stock';
                        $row = "<tr>";
                            $row .= "<td class='d-none d-md-table-cell'>$id</td>";
                            $row .= "<td>$nom</td>";
                            $row .= "<td>$prix</td>";
                            $row .= "<td class='d-none d-xl-table-cell'>$description</td>";
                            $row .= "<td class='d-none d-md-table-cell'><img src='$image' alt='$nom' style='width: 50px; height: 50px;'></td>";
                            $row .= "<td class='d-none d-md-table-cell'>$categorie</td>";
                            $row .= "<td class='d-none d-md-table-cell'>$special</td>";
                            $row .= "<td>$stock</td>";
                            $row .= "<td class='d-flex justify-content-around'>";
                                $row .= "<a href='" . RACINE_SITE ."index.php?page=admin&section=products&action=edit&id=$id' class='btn btn-primary'>Edit</a>";
                                $row .= delete_product_form($id);
                            $row .= "</td>";
                        $row .= "</tr>";
                        echo $row;
                    }
                ?>
            </tbody>
        </table>
    </aside>

</article>
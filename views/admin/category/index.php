<?php
    require_once 'components/form/category/delete.php';
    global $pdo;
    $category = new CategorieRepo($pdo);
    $category = $category->read_all();
?>

<article>
    <div class='d-flex justify-content-between align-items-center'>
        <h2>Catégories</h2>
        <a href='index.php?page=admin&section=category&action=add' class='btn btn-success'>
            Ajouter une categorie
        </a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($category as $cat){
                    $id = $cat->get_value_of('id');
                    $nom = $cat->get_value_of('nom');
                    
                    $row = "<tr>";
                        $row .= "<td>$id</td>";
                        $row .= "<td>$nom</td>";
                        $row .= "<td class='d-flex'>";
                            $row .= "<a href='index.php?page=admin&section=category&action=edit&id=$id' class='btn btn-primary'>Edit</a>";
                            $row .= delete_category_form($id);
                        $row .= "</td>";
                    $row .= "</tr>";
                    echo $row;
                }
            ?>
        </tbody>
    </table>
</article>

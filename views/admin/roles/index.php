<?php 
    global $pdo;
    $roles = new RoleRepo($pdo);
    $roles = $roles->read_all();
?>

<article>
    <div class="d-flex justify-content-between align-items-center">
        <h2>Roles</h2>
        <a href="index.php?page=admin&section=roles&action=add" class="btn btn-success">
            Ajouter un role
        </a>
    </div>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Titre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($roles as $role){
                    $id = $role->get_value_of('id');
                    $nom = $role->get_value_of('nom');
                    
                    $row = "<tr>";
                        $row .= "<td>$id</td>";
                        $row .= "<td>$nom</td>";
                        $row .= "<td class='d-flex'>";
                            $row .= "<a href='index.php?page=admin&section=roles&action=edit&id=$id' class='btn btn-primary'>Edit</a>";
                            $row .= "<form action='controllers/role/delete.php' method='post'>";
                                $row .= "<input type='hidden' name='id' value='$id'>";
                                $row .= "<button type='submit' class='btn btn-danger'>Delete</button>";
                            $row .= "</form>";
                        $row .= "</td>";
                    $row .= "</tr>";
                    echo $row;
                }
            ?>
        </tbody>
    </table>
</article>

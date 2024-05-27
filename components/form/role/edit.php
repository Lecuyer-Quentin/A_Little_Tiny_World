<?php
global $pdo;
    $data_role_edit = get_JSON("config.json", "form", "data_role_edit");

    $role = new RoleRepo($pdo);
    $role = $role->read_one($_GET['id']);

    $id = $role->get_value_of('id');
    $nom = $role->get_value_of('nom');
    ?>

    <form action="controllers/role/edit.php" method="post" class="form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group mb-3">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $nom; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    

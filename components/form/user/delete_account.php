<?php
    global $pdo;
    $user = new UtilisateurRepo($pdo);
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $user = $user->read_one($id);
    ?>
    <form id="" action="controllers/user/delete.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user->get_value_of('id'); ?>">
        <input type="hidden" name="logout" value="logout">
        <button type="submit" name="delete" class="btn btn-danger" value="delete">Supprimer mon compte</button>
    </form>
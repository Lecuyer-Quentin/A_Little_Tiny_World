<article>

<div class="">
    <h3>Modifier vos informations personnelles</h3>
    <?php require_once 'components/form/user/edit.php'; ?>
    
    </div>

    <div class="">
    <h3>Modifier votre mot de passe</h3>
    <?php require_once 'components/form/user/edit_password.php'; ?>
    </div>

    <div class="alert alert-danger" role="alert">
        <h3>Supprimer votre compte</h3>
        <p>Attention, cette action est irréversible.</p>
        <?php require_once 'components/form/user/delete_account.php'; ?>
    </div>
</article>

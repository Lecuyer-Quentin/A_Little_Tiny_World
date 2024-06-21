<article class="">

    <div class="alert alert-warning" role="alert">
        <h2>Paramètres de votre compte</h2>
        <p>Vous pouvez modifier vos informations personnelles et votre mot de passe.</p>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-around">
        <div>
            <?php require_once 'components/form/user/edit.php'; ?>
        </div>

        <div>
            <?php require_once 'components/form/user/edit_password.php'; ?>
            <div class="alert alert-danger mt-3 w-100" role="alert">
                <h3>Supprimer votre compte</h3>
                    <p>Attention, cette action est irréversible.</p>
                    <?php require_once 'components/form/user/delete_account.php'; ?>
            </div>
            <?php require_once 'components/form/user/edit_password.php'; ?>
        </div>

    </div>

</article>

<?php
    global $pdo;
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

     $id = $_GET['id'];
     $user = new UtilisateurRepo($pdo);
     $user = $user->read_one($id);

     $roles = new RoleRepo($pdo);
     $roles = $roles->read_all();
     $user_role = $user->get_value_of('role')->get_value_of('id');

     function selected($role, $user_role){
         return ($role == $user_role) ? 'selected' : '';
     }

     function render_select($roles, $user_role){
         $options = '';
         foreach($roles as $role){
             $options .= '<option value="' . $role->get_value_of('id') . '" ' . selected($role->get_value_of('id'), $user_role) . '>' . $role->get_value_of('nom') . '</option>';
         }
         return $options;
     }
     
?>
<pre>
    <?php //print_r($user); ?>
    <?php //print_r($roles); ?>
    <?php //print_r($user_role); ?>
</pre>

    <form id="" class="form" action="controllers/user/edit.php" method="POST" enctype="multipart/form-data">
        <div>
            <h2>Modifier l'utilisateur : <br /> <?php echo $user->__toString(); ?></h2>
        </div>
        <div class=" d-flex flex-column">
            <div>
                <input type="hidden" name="id" id="id" value="<?php echo $user->get_value_of('id'); ?>">
                <input type="hidden" name="page" value="<?php echo $page; ?>">
            </div>
            <div >
                <label for="nom">Nom</label><br>
                <input class="form-control" type="text" name="nom" id="nom" value="<?php echo $user->get_value_of('nom'); ?>">
            </div>
            <div>
                <label for="prenom">Prénom</label><br>
                <input class="form-control" type="text" name="prenom" id="prenom" value="<?php echo $user->get_value_of('prenom'); ?>">
            </div>
            <div>
                <label for="email">Email</label><br>
                <input class="form-control" type="email" name="email" id="email" value="<?php echo $user->get_value_of('email'); ?>">
            </div>
            <div>
                <label for="numRue">Numéro de rue</label><br>
                <input class="form-control" type="text" name="numRue" id="numRue" value="<?php echo $user->get_value_of('numRue'); ?>">
            </div>
            <div>
                <label for="nomRue">Nom de rue</label><br>
                <input class="form-control" type="text" name="nomRue" id="nomRue" value="<?php echo $user->get_value_of('nomRue'); ?>">
            </div>
            <div>
                <label for="ville">Ville</label><br>
                <input class="form-control" type="text" name="ville" id="ville" value="<?php echo $user->get_value_of('ville'); ?>">
            </div>
            <div>
                <label for="codePostal">Code postal</label><br>
                <input class="form-control" type="text" name="codePostal" id="codePostal" value="<?php echo $user->get_value_of('codePostal'); ?>">
            </div>
            <div>
                <label for="pays">Pays</label><br>
                <input class="form-control" type="text" name="pays" id="pays" value="<?php echo $user->get_value_of('pays'); ?>">
            </div>
            <div>
                <label for="telephone">Téléphone</label><br>
                <input class="form-control" type="text" name="telephone" id="telephone" value="<?php echo $user->get_value_of('telephone'); ?>">
            </div>
            <?php 
                if($page == 'admin'){
                    $select = '<div>';
                    $select .= '<label for="role">Rôle</label><br>';
                    $select .= '<select class="form-control" name="role" id="role">';
                    $select .= '<option value="">-- Choisir un rôle --</option>';

                    $select .= render_select($roles, $user_role);
                    $select .= '</select>';
                    $select .= '</div>';
                    echo $select;
                }else{
                    echo '<input type="hidden" name="role" value="'. $user_role .'">';
                }
            ?>

            <div>
                <label for="avatar">Avatar</label><br>
                <input class="form-control" type="file" name="avatar" id="avatar" accept="image/*">
            </div>


            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-primary" type="submit">Modifier</button>
            </div>
        </div>
    </form>


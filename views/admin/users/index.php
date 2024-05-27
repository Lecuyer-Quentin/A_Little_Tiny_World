
<?php
    global $pdo;
    $users = new UtilisateurRepo($pdo);
    $users = $users->read_all();    
?>

<article>
    <div class="d-flex justify-content-between align-items-center">
        <h2>Utilisateurs</h2>
        <a href="index.php?page=admin&section=users&action=add" class="btn btn-success">
            Ajouter un utilisateur
        </a>
    </div>

    <aside>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="d-none d-md-table-cell">Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th class="d-none d-xl-table-cell">Adresse</th>
                    <th class="d-none d-xl-table-cell">Avatar</th>
                    <th>Role</th>
                    <th class="d-none d-md-table-cell">Actif</th>
                    <th class="d-none d-xl-table-cell">Inscription</th>
                    <th class='text-center'>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($users as $user){
                        $id = $user->get_value_of('id');
                        $nom = $user->get_value_of('nom');
                        $prenom = $user->get_value_of('prenom');
                        $email = $user->get_value_of('email');
                        $numRue = $user->get_value_of('numRue');
                        $nomRue = $user->get_value_of('nomRue');
                        $ville = $user->get_value_of('ville');
                        $codePostal = $user->get_value_of('codePostal');
                        $pays = $user->get_value_of('pays');
                        $adresse = ($numRue && $nomRue && $ville && $codePostal && $pays) ? "$numRue $nomRue, $ville $codePostal, $pays" : 'Non renseignée';
                        $avatar = $user->get_value_of('avatar');
                        $actif = $user->get_value_of('isActif') ? 'Actif' : 'Inactif';
                        $role = $user->get_value_of('role')->get_value_of('nom');
                        $inscription = date('d/m/Y', strtotime($user->get_value_of('date_inscription')));
                        $row = "<tr>";
                            $row .= "<td class='d-none d-md-table-cell'>$id</td>";
                            $row .= "<td>$nom $prenom</td>";
                            $row .= "<td>$email</td>";
                            $row .= "<td class='d-none d-xl-table-cell'>$adresse</td>";
                            $row .= "<td class='d-none d-xl-table-cell'>";
                                $row .= "<img src='$avatar' alt='avatar' class='img-fluid' style='max-width: 50px;'>";
                            $row .= "</td>";
                            $row .= "<td>$role</td>";
                            $row .= "<td class='d-none d-md-table-cell'>$actif</td>";
                            $row .= "<td class='d-none d-xl-table-cell'>$inscription</td>";

                            $row .= "<td class='d-flex flex-column justify-content-center'>";
                                $row .= "<a href='index.php?page=admin&section=users&action=edit&id=$id' class='btn btn-primary mb-2'>Edit</a>";
                                $row .= "<form  action='controllers/user/delete.php' method='post'>";
                                    $row .= "<input type='hidden' name='id' value='$id'>";
                                    $row .= "<button type='submit' class='btn btn-danger w-100'>Delete</button>";
                                $row .= "</form>";
                            $row .= "</td>";

                        $row .= "</tr>";
                        echo $row;
                    }
                ?>
            </tbody>
        </table>
    </aside>

   
    
   
    
</article>
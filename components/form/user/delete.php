<?php


function delete_user($id){
    return '
    <form action = "controllers/user/delete.php" method = "POST" id="user_delete_form">
        <input type = "hidden" name = "id" value = "'.$id.'">
        <button type = "submit" class = "btn btn-danger">Supprimer</button>
    </form>
    ';
}
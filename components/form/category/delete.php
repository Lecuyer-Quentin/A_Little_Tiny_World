<?php

function delete_category_form($id) {
    return "
    <form action='controllers/category/delete.php' method='post' id='categorie_delete_form'>
        <input type='hidden' name='id' value='$id'>
        <button type='submit' class='btn btn-danger'>Delete</button>
    </form>";
}

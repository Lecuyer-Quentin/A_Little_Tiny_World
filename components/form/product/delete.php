<?php

function delete_product_form($id){
    return "<form action='controllers/product/delete.php' method='post' id='product_delete_form'>
                <input type='hidden' name='id' value='$id'>
                <button type='submit' class='btn btn-danger'>Delete</button>
            </form>";
}
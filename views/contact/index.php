<section>
<form class="mt-6" action="index.php?page=contact"
method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <textarea name="message" placeholder="Message"></textarea>
    <input type="file" name="image" required accept="image/*">
    <button type="submit">Send</button>
</form>
</section>


<?php
require_once 'page.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $image = $_FILES['image'];

    $errors = [];

    if(empty($name)) {
        $errors[] = 'Name is required';
    }

    if(empty($email)) {
        $errors[] = 'Email is required';
    }

    if(empty($message)) {
        $errors[] = 'Message is required';
    }

    if($image['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = 'Image is required';
    }

    if(empty($errors)) {
        $image = upload_images($image, 'images/contact/');
        
        $contact = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'image' => $image,
        ];

        $response = array(
            'status' => 'success',
            'message' => 'Message sent successfully',
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => $errors,
        );
    }
}




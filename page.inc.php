<?php

define('RACINE_SITE', '/A_Little_Tiny_World/');
define('RACINE_SERVEUR', $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE);
define('URL_SITE', 'https://alittletinyworld.go.yj.fr' . RACINE_SITE);
define('ROOT_SITE', $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE);
//$project_root = $_SERVER['DOCUMENT_ROOT'][strlen($_SERVER['DOCUMENT_ROOT']) - 1] === '/' ? $_SERVER['DOCUMENT_ROOT'] . 'A_Little_Tiny_World/' : $_SERVER['DOCUMENT_ROOT'] . '/A_Little_Tiny_World/';

enum RoleEnum : int {
    case Guest = 0;
    case User = 1;
    case Admin = 2;
    case Dev = 3;
}
function set_session($name, $data) {
    foreach ($data as $key => $value) {
        $_SESSION[$name][$key] = $value;
    }
}

function autoload() {
    spl_autoload_register(function ($class) {
        $class = str_replace('\\', '/', $class);
        require_once __DIR__ . '/models/' . $class . '.php';
    });
}
autoload();


function get_JSON($path, $name, $sub) {
    $json = json_decode(file_get_contents($path), true);
    if ($json === null) {
        return [];
    }
    if (isset($json[$name][$sub])) {
        return $json[$name][$sub];
    } else {
        return [];
    }
}


function get_directory($path) {
    $dir = ROOT_SITE . $path;
    if(!is_dir($dir)) {
        if(is_writable(ROOT_SITE)) {
            mkdir($dir, 0777, true);
        }else{
            echo "Le script n'a pas la permission d'écrire dans le répertoire" . ROOT_SITE;
        }
    }
    return $dir;
}

function upload_images($image, $path) {
    // Vérification de l'extension du fichier
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    if (!in_array($extension, $allowed_extensions)) {
        return 'Le fichier n\'est pas une image';
    }
    // Vérification de la taille du fichier
    //if ($image['size'] > 1000000) {
    //    return 'Le fichier est trop volumineux';
    //}
    // Vérification de l'upload du fichier
    if ($image['error'] !== 0) {
        return 'Une erreur est survenue lors de l\'upload du fichier';
    }
    // Déplacement du fichier
    $rep = get_directory($path);
    $new_path = $rep . uniqid() . '.' . $extension;
    move_uploaded_file($image['tmp_name'], $new_path);
    $image = basename($new_path);
    return $image;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

function send_mail($send_from, $send_to, $subject, $body) {
    try {
        $mail = new PHPMailer(true);

        //! Attention, ces paramètres sont à modifier
        // PHP n'est pas capable de vérifier le certificat SSL du serveur SMTP.
        // Une solution possible est de désactiver la vérification du certificat SSL. Cependant, cela devrait être évité dans un environnement de production car cela rend la connexion vulnérable aux attaques de type "man-in-the-middle".
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'a9f603118cece5';
        $mail->Password = '87d8cdff3816b3';
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //Paramètres de l'email
        $mail->setFrom($send_from, 'Mailer');
        $mail->addAddress($send_to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

    
<?php
require_once 'db.php';
global $dsn, $user, $pass, $options;
global $db;


echo '<section style="display: flex; flex-direction: column; align-items: center;">';
echo '<h1>Installation de la base de données</h1>';
echo '<br>';

echo 'Voulez-vous réinitialiser la base de données '.`$db`. ' ?' . '<br><br>';
echo 'Attention, toutes les données seront perdues' . '<br>';
echo 'Cette operation supprimera toutes les tables et les données de la base de données' . '<br>';
echo 'Et créera de nouvelles tables avec des données par défaut' . '<br>' . '<br>';

echo '<div style="display: flex; flex-direction: column; align-items: center;">';
echo '<h2>Attention</h2>';
echo 'Cette action est irréversible' . '<br><br>';
echo 'Tapez "oui" pour confirmer : ' . '';
echo '<form method="post" action="install.php" style="display: flex; flex-direction: column; align-items: center;">';
    echo '<input type="text" name="confirmation" placeholder="oui" required autofocus autocomplete="off">';
    echo '<input type="submit" value="Confirmer">';
echo '</form>';
echo '</div>';

echo '</section>';


if(empty($_POST['confirmation'])){
    echo '';
    exit();
}
$confirmation = $_POST['confirmation'];

if ($confirmation !== 'oui') {
    echo 'Opération annulée';
    exit();
}else{
    echo '<section style="display: flex; flex-direction: column; align-items: center;">';
    echo '<h2>Opération en cours...</h2>';
    echo 'Connexion à la base de données...' . '<br>' . '<br>';

    try {
    $conn = connect($dsn, $user, $pass, $options);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Drop database
    $conn->exec("DROP DATABASE IF EXISTS `$db`");
    echo 'Base de données supprimée avec succès' . '<br>' . '<br>';

    // Create database
    $conn->exec("CREATE DATABASE IF NOT EXISTS `$db`");
    echo 'Base de données créée avec succès' . '<br>' . '<br>';

    // Use database
    $conn->exec("USE `$db`");
    echo 'Base de données sélectionnée avec succès' . '<br>' . '<br>';

    // Drop tables
    $conn->exec("DROP TABLE IF EXISTS categorie");
    $conn->exec("DROP TABLE IF EXISTS special");
    $conn->exec("DROP TABLE IF EXISTS role");
    $conn->exec("DROP TABLE IF EXISTS produit");
    $conn->exec("DROP TABLE IF EXISTS utilisateur");
    $conn->exec("DROP TABLE IF EXISTS commande");
    $conn->exec("DROP TABLE IF EXISTS commande_produit");
    $conn->exec("DROP TABLE IF EXISTS utilisateur_role");
    $conn->exec("DROP TABLE IF EXISTS utilisateur_commande");
    $conn->exec("DROP TABLE IF EXISTS produit_categorie");
    $conn->exec("DROP TABLE IF EXISTS produit_special");
    echo 'Tables supprimées avec succès' . '<br>' . '<br>';

    // Create tables
    $conn->exec("CREATE TABLE IF NOT EXISTS categorie (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL UNIQUE
    )");
    $conn->exec("CREATE TABLE IF NOT EXISTS special (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL UNIQUE
    )");
    $conn->exec("CREATE TABLE IF NOT EXISTS role (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL UNIQUE
    )");
    $conn->exec("CREATE TABLE IF NOT EXISTS commande (
        id INT AUTO_INCREMENT PRIMARY KEY,
        total DECIMAL(10,2) NOT NULL,
        date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        date_livraison DATE,
        adresse_livraison VARCHAR(255),
        statut VARCHAR(30) DEFAULT 'En attente'
        )");
    $conn->exec("CREATE TABLE IF NOT EXISTS produit (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL,
        description TEXT,
        prix DECIMAL(10,2) NOT NULL,
        date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        image TEXT,
        inStock BOOLEAN DEFAULT TRUE
    )");
    $conn->exec("CREATE TABLE IF NOT EXISTS utilisateur (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL,
        prenom VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL UNIQUE,
        mot_de_passe VARCHAR(255) NOT NULL,
        numRue VARCHAR(10),
        nomRue VARCHAR(50),
        codePostal VARCHAR(5),
        ville VARCHAR(50),
        pays VARCHAR(50),
        telephone VARCHAR(15),
        date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        avatar TEXT,
        isActif BOOLEAN DEFAULT FALSE,
        token VARCHAR(255)        
    )");
    $conn->exec("CREATE TABLE IF NOT EXISTS commande_produit (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fkIdCommande INT NOT NULL,
        fkIdProduit INT NOT NULL,
        quantite INT NOT NULL,
        FOREIGN KEY (fkIdCommande) REFERENCES commande(id),
        FOREIGN KEY (fkIdProduit) REFERENCES produit(id),
        INDEX idx_commande_produit (fkIdCommande, fkIdProduit)
    )");
    $conn->exec("CREATE TABLE IF NOT EXISTS utilisateur_role (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fkIdUtilisateur INT NOT NULL,
        fkIdRole INT NOT NULL,
        FOREIGN KEY (fkIdUtilisateur) REFERENCES utilisateur(id),
        FOREIGN KEY (fkIdRole) REFERENCES role(id),
        INDEX idx_utilisateur_role (fkIdUtilisateur, fkIdRole)
    )");
    $conn->exec("CREATE TABLE IF NOT EXISTS utilisateur_commande (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fkIdUtilisateur INT NOT NULL,
        fkIdCommande INT NOT NULL,
        FOREIGN KEY (fkIdUtilisateur) REFERENCES utilisateur(id),
        FOREIGN KEY (fkIdCommande) REFERENCES commande(id),
        INDEX idx_utilisateur_commande (fkIdUtilisateur, fkIdCommande)
    )");
    $conn->exec("CREATE TABLE IF NOT EXISTS produit_categorie (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fkIdProduit INT NOT NULL,
        fkIdCategorie INT NOT NULL,
        FOREIGN KEY (fkIdProduit) REFERENCES produit(id),
        FOREIGN KEY (fkIdCategorie) REFERENCES categorie(id),
        INDEX idx_produit_categorie (fkIdProduit, fkIdCategorie)
    )");
    $conn->exec("CREATE TABLE IF NOT EXISTS produit_special (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fkIdProduit INT NOT NULL,
        fkIdSpecial INT NOT NULL,
        FOREIGN KEY (fkIdProduit) REFERENCES produit(id),
        FOREIGN KEY (fkIdSpecial) REFERENCES special(id),
        INDEX idx_produit_special (fkIdProduit, fkIdSpecial)
    )");
    echo 'Tables créées avec succès' . '<br>' . '<br>';

    try{
        $conn->exec("INSERT INTO categorie (nom) 
                        VALUES ('Pochette'), ('Chouchou'), ('Lingette'), ('Bavoir'), ('Mitaine'), ('Beret'), ('Snood')");
        $conn->exec("INSERT INTO special (nom) 
                        VALUES ('Nouveauté'), ('Promotion'), ('Coup de coeur'), ('One Shot'), ('Création Stagiaire')");
        $conn->exec("INSERT INTO role (nom) 
                        VALUES ('User'), ('Admin'), ('Dev')");
        $conn->exec("INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, numRue, nomRue, codePostal, ville, pays, telephone, avatar, isActif, token) 
                        VALUES ('Admin', 'Admin', 'admin@admin.com','".password_hash('admin', PASSWORD_BCRYPT)."','1', 'rue de l''admin', '75000', 'Paris', 'France', '0123456789', '', TRUE, UUID()), 
                                ('User', 'User', 'user@user.com','".password_hash('user', PASSWORD_BCRYPT)."','1', 'rue de l''user', '75000', 'Paris', 'France', '0123456789', '', TRUE, UUID()),
                                ('Dev', 'Dev', 'dev@dev.com','".password_hash('dev', PASSWORD_BCRYPT)."','1', 'rue du dev', '75000', 'Paris', 'France', '0123456789', '', TRUE, UUID())");
        $conn->exec("INSERT INTO utilisateur_role (fkIdUtilisateur, fkIdRole) 
                        VALUES (1, 2), (2, 1), (3, 3)");
        
        echo 'Données insérées avec succès' . '<br>' . '<br>';
    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
        exit();
    }

    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
        exit();
    } finally {

        echo 'La base de données a été installée avec succès';
        echo '<br>' . '<br>';

        $conn = null;
        echo '<h3>Fermeture de la connexion</h3>';

        echo '<br>' . '<br>';
        echo '<a href="../index.php?page=home">Retour à l\'accueil</a>';
        echo '</section>';
    }
}

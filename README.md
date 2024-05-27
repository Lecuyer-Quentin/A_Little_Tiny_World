# A Little Tiny World

## Description
Ce projet est un E-Commerce pour un atelier de couture.

## Features
- Présentation des différents produits 
- Administration du site avec Sql
- Compte utilisateur

## Installation
1. Installer XAMPP ou un autre serveur local. Vous pouvez télécharger XAMPP ici : `https://www.apachefriends.org/fr/download.html`
2. Ouvrir un terminal.
3. Se rendre dans le répertoire cible de XAMPP : 
```bash
cd /opt/lampp/htdocs
```
4. Cloner le repertoire: 
```bash
git clone https://github.com/Lecuyer-Quentin/A_Little_Tiny_World.git
```
5. Se rendre dans le repertoire du projet: 
```bash
cd A_Little_Tiny_World
```
6. Installer les dépendances: 
```bash
npm install
```
7. Créer la base de donnée: 
```bash 
npm run install_db
```
8. Donner les permissions d'écriture: 
```bash
npm run give_permission
```
9. Installer Google Chrome: `https://www.google.com/intl/fr/chrome/`
10. Lancer l'application: 
```bash
npm run start
```

## Usage
1. Arrêt du serveur: 
```bash
npm run x_stop
```
2. Redémarrer le serveur: 
```bash
npm run x_restart
```
3. Réinitialiser la base de donnée: 
```bash
npm run install_db
```


## License
This project is licensed under the [MIT License](./LICENSE).
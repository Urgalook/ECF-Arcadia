Ce projet a été réalisé dans le cadre de l'Evaluation en Cours de Formation du diplôme Graduate Developper Web et Web Mobile pour l'école Studi. L'objectif de ce projet a été de développer une application web aussi bien pour les visiteurs du site qui pourront consulter les différentes informations du zoo Arcadia, que pour les employés du zoo qui auront accès à un espace dédié de façon à pouvoir s'occuper de la gestion courante du zoo et mettre à jour les informations du zoo. 

Prérequis pour déployer l'application en local sur votre machine :
  - Télécharger GIT afin de pouvoir cloner ce repository GitHub
  - Télécharger VisualStudioCode (VSCode)
  - Télécharger Xampp et configurer un serveur local
  - Relier son server Xampp à un hébergeur de bases de données en local tel que phpmyadmin (http://localhost/phpmyadmin/) ou téléchargez MySQL WorkBench

Installation :
  1) Créez un dossier "projet_arcadia" dans "C:\xampp\htdocs\"
     
  2) Clonez ce dépôt GitHub dans votre répertoire "C:\xampp\htdocs\projetarcadia" en rentrant cette commmande dans GIT : "git clone https://github.com/Tomazku/Studi_ECF_Arcadia_Zoo.git main"
     
  3) Création d'un site en local :
       - rendez-vous dans C:\Windows\System32\drivers\etc et ouvrez le fichier "hosts" avec VSCode
       - ajoutez un nouveau nom de domaine en local tel que "projetarcadia.local" puis enregistrez en tant qu'administrateur
       - rendez-vous dans C:\xampp\apache\conf\extra et ouvrez le fichier "httpd-vhosts.com" dans VSCode et en bas du fichier ajoutez :
         <VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\projetarcadia"
    ServerName projetarcadia.local
         </VirtualHost>
         
  4) Rendez-vous sur PhpMyAdmin et importez la base de données "arcadia.sql"
  5) Effectuez la configuration de connexion à la base de données :
         - Ouvrez le fichier pdo.php situé dans le dossier "back" et inscrivez vos identifiants de connexion en local
  6) Une fois votre serveur web local opérationnel, rendez-vous sur projetarcadia.local

Merci à vous ! 
Maxime Bloise
     

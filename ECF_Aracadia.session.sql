DROP TABLE IF EXISTS habitat;
DROP TABLE IF EXISTS espece;
DROP TABLE IF EXISTS animaux;
DROP TABLE IF EXISTS veterinaire;
DROP TABLE IF EXISTS services;

CREATE TABLE habitat (
    id_habitat INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR (255),
    photo VARCHAR (255)
);

CREATE TABLE espece (
    id_espece INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR (255)
);

CREATE TABLE animaux (
    id_animal INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR (255),
    espece INT NOT NULL,
    habitat INT NOT NULL,
    photo VARCHAR (255)
);

CREATE TABLE veterinaire (
    id_commentaire INT AUTO_INCREMENT PRIMARY KEY,
    etat_animal VARCHAR (255),
    nourriture VARCHAR (255),
    grammage_nourriture VARCHAR (255),
    date_passage VARCHAR (255),
    remarque TEXT
);

CREATE TABLE services (
    id_service INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR (255),
    description TEXT,
    photo VARCHAR (255)
);

CREATE TABLE avis (
    id_avis INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR (255),
    avis TEXT,
    Validation BOOLEAN
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR (255) NOT NULL,
    password VARCHAR (255) NOT NULL,
    role VARCHAR (255) NOT NULL
);



INSERT INTO espece (nom) VALUES ('crocodile');
INSERT INTO espece (nom) VALUES ('gorille');
INSERT INTO espece (nom) VALUES ('panthère noire');
INSERT INTO espece (nom) VALUES ('tigre');
INSERT INTO espece (nom) VALUES ('elephant');
INSERT INTO espece (nom) VALUES ('girafe');
INSERT INTO espece (nom) VALUES ('guepard');
INSERT INTO espece (nom) VALUES ('lion');
INSERT INTO espece (nom) VALUES ('zebre');
INSERT INTO espece (nom) VALUES ('caiman');
INSERT INTO espece (nom) VALUES ('boa');
INSERT INTO espece (nom) VALUES ('tortue');

INSERT INTO habitat (nom) VALUES ('jungle');
INSERT INTO habitat (nom) VALUES ('savane');
INSERT INTO habitat (nom) VALUES ('marais');

INSERT INTO animaux (prenom, espece, habitat) VALUES ('Hector', 1, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Brutus', 1, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Luna', 1, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Nala', 1, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Winston', 2, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Kala', 2, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Maya', 2, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Nyx', 3, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Rajah', 4, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Shiva', 4, 1);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Nala', 5, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Kibo', 5, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Nia', 5, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Jamal', 6, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Shani', 6, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Aleta', 6, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Kofi', 6, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Nyota', 6, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Zephyr', 7, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Thunder', 7, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Aslan', 8, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Cleo', 8, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Ziggy', 9, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Zeke', 9, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Zoya', 9, 2);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Diego', 10, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Shadow', 10, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Rex', 10, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Fang', 10, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Delta', 10, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Ember', 10, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Jade', 10, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Spike', 11, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Franklin', 12, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Sheldon', 12, 3);
INSERT INTO animaux (prenom, espece, habitat) VALUES ('Pearl', 12, 3);

INSERT INTO services (nom, description) VALUES ('Restauration', 'Profitez de notre service de restauration du Zoo Arcadia, un véritable paradis gastronomique
            au cœur de la nature sauvage. Que vous choisissiez de vous installer à l''intérieur de notre charmant restaurant
            ou sur l''une de nos terrasses ensoleillées ou ombragées, vous êtes assuré de vivre une expérience culinaire
            inoubliable. Imaginez-vous déguster votre repas tout en observant les majestueux lions se prélasser ou les
            adorables pandas jouer dans leur enclos. Notre menu offre une variété de plats exquis pour satisfaire tous les
            palais, des délices végétariens aux succulentes grillades. Laissez-vous tenter par nos spécialités locales
            mettant en valeur les saveurs de la région, ou optez pour des mets internationaux raffinés. Pour accompagner
            votre repas, notre carte des boissons propose une sélection de vins fins, de cocktails rafraîchissants et de
            boissons non alcoolisées. Que vous veniez pour une pause déjeuner entre deux explorations ou pour un dîner
            romantique au coucher du soleil, le service chaleureux de notre équipe veillera à ce que votre expérience soit
            aussi mémorable que la visite des animaux. Au Zoo Arcadia, la fusion entre la nature et la gastronomie vous
            promet une escapade sensorielle incomparable.');

INSERT INTO services (nom, description) VALUES ('Visite_guide', 'Explorez le Zoo Arcadia en compagnie de nos guides experts pour une immersion totale dans le
            monde fascinant de la faune sauvage. Nos visites guidées offrent une expérience éducative et enrichissante,
            vous permettant de découvrir les habitats variés et les espèces extraordinaires qui peuplent notre zoo.
            Tout au long du parcours, nos guides passionnés vous dévoileront des faits intéressants sur chaque animal,
            ainsi que sur les efforts de conservation que nous déployons pour protéger leur habitat naturel. Que ce soit
            en admirant les lions majestueux dans leur savane africaine, en observant les singes espiègles dans la canopée
            de la forêt tropicale, ou en plongeant dans les eaux cristallines de notre aquarium, chaque arrêt est une
            occasion d''en apprendre davantage sur la diversité incroyable de la vie sur Terre. Nos guides sont là pour
            répondre à toutes vos questions et pour partager leur passion pour la préservation de la nature. Que vous soyez
            un amateur d''animaux passionné ou simplement curieux de découvrir le monde qui nous entoure, une visite guidée
            au Zoo Arcadia est une expérience inoubliable pour tous les âges.');
INSERT INTO services (nom, description) VALUES ('Visite_train', 'Bienvenue à bord du petit train du Zoo Arcadia, une façon pittoresque et pratique de découvrir
            tous les trésors cachés de notre parc zoologique. Installez-vous confortablement dans nos wagons et
            laissez-vous guider à travers les différents habitats et environnements, sans manquer aucune des merveilles
            que notre zoo a à offrir. Que vous soyez accompagné de jeunes enfants, de personnes âgées ou simplement à la
            recherche d''une manière relaxante de parcourir le parc, notre petit train est une option idéale pour tous les
            visiteurs. En chemin, écoutez les commentaires instructifs de nos guides audio qui vous fourniront des informations
            fascinantes sur chaque espèce animale et leur habitat naturel. Admirez les girafes gracieuses se balancer
            au-dessus des arbres, observez les éléphants majestueux barboter dans leur mare, et laissez-vous émerveiller par
            la diversité colorée des oiseaux exotiques qui peuplent nos volières. Notre petit train assure une visite complète
             du parc zoologique, vous permettant de vous concentrer pleinement sur l''observation des animaux et de créer des
             souvenirs inoubliables avec vos proches. Embarquez avec nous pour une aventure mémorable au cœur de la vie
             sauvage au Zoo Arcadia.')

ALTER TABLE services DROP COLUMN photo;

UPDATE `animaux` SET `photo`='Crocodile.jpg' WHERE espece = 1;
UPDATE `animaux` SET `photo`='Gorille.jpg' WHERE espece = 2;
UPDATE `animaux` SET `photo`='Pantère noire.webp' WHERE espece = 3;
UPDATE `animaux` SET `photo`='Tigres.jpg' WHERE espece = 4;
UPDATE `animaux` SET `photo`='Elephant.jpg' WHERE espece = 5;
UPDATE `animaux` SET `photo`='Girafe.jpg' WHERE espece = 6;
UPDATE `animaux` SET `photo`='Guépard.webp' WHERE espece = 7;
UPDATE `animaux` SET `photo`='Lion.jpg' WHERE espece = 8;
UPDATE `animaux` SET `photo`='Zèbres.jpg' WHERE espece = 9;
UPDATE `animaux` SET `photo`='Caïman.jpg' WHERE espece = 10;
UPDATE `animaux` SET `photo`='Boa.jpeg' WHERE espece = 11;
UPDATE `animaux` SET `photo`='Tortue terrestre.jpg' WHERE espece = 12;


ALTER TABLE animaux ADD FOREIGN KEY (espece) REFERENCES espece(id_espece);

ALTER TABLE veterinaire ADD FOREIGN KEY (id_animal) REFERENCES animaux(id_animal);

ALTER TABLE `veterinaire` CHANGE `grammage_nourriture` `grammage` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `veterinaire` CHANGE `date_passage` `date` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE habitat_veterinaire ADD FOREIGN KEY (habitat) REFERENCES habitat(id_habitat);

ALTER TABLE `habitat` CHANGE `photo` `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

INSERT INTO `horaires`(`jour`, `ouverture`, `fermeture`) VALUES ('lundi','10:00','20:00');



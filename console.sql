    DROP DATABASE IF EXISTS medicare;

    CREATE DATABASE medicare;

    USE medicare;

    DROP TABLE IF EXISTS clients;

    CREATE TABLE clients (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        prenom VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL ,
        address VARCHAR(255),
        CarteVitale INT,
        password VARCHAR(255) NOT NULL,
        type_compte INT NOT NULL DEFAULT 0
    );

    DROP TABLE IF EXISTS professionnels;

    CREATE TABLE professionnels (
        id INT PRIMARY KEY,
        path_photo VARCHAR(255),
        specialite VARCHAR(255) DEFAULT 'Généraliste',
        path_video VARCHAR(255),
        path_CV VARCHAR(255),
        FOREIGN KEY (id) REFERENCES clients(id),
        disponible BOOLEAN DEFAULT 1
    );


    DROP TABLE IF EXISTS disponibilites;

    CREATE TABLE disponibilites (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    medecin_id INT,
                                    jour_semaine ENUM('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'),
                                    heure_debut TIME,
                                    heure_fin TIME,
                                    disponible BOOLEAN,
                                    FOREIGN KEY (medecin_id) REFERENCES professionnels(id)
    );

    DROP TABLE IF EXISTS `rendezvous`;
    CREATE TABLE IF NOT EXISTS `rendezvous` (
                                                `rdv_id` int NOT NULL AUTO_INCREMENT,
                                                `client_id` int DEFAULT NULL,
                                                `medecin_id` int DEFAULT NULL,
                                                `services_labo_id` int DEFAULT NULL,
                                                `date` date DEFAULT NULL,
                                                `heure` time DEFAULT NULL,
                                                `statut` enum('programmé','annulé','terminé') NOT NULL,
                                                PRIMARY KEY (`rdv_id`),
                                                KEY `client_id` (`client_id`),
                                                KEY `medecin_id` (`medecin_id`)
    );


    DROP TABLE IF EXISTS `services_laboratoire`;
    CREATE TABLE IF NOT EXISTS `services_laboratoire` (
                                                          `service_id` int NOT NULL AUTO_INCREMENT,
                                                          `nom_service` varchar(255) NOT NULL,
                                                          `title` text NOT NULL,
                                                          `description` text NOT NULL,
                                                          `details` text NOT NULL,
                                                          `salle` varchar(50) DEFAULT NULL,
                                                          PRIMARY KEY (`service_id`)
    );

    DROP TABLE IF EXISTS disponibilites_labo;

    CREATE TABLE disponibilites_labo (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    services_labo_id INT,
                                    jour_semaine ENUM('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'),
                                    heure_debut TIME,
                                    heure_fin TIME,
                                    disponible BOOLEAN,
                                    FOREIGN KEY (services_labo_id) REFERENCES  services_laboratoire(service_id)
    );


    -- Table des réservations de services de laboratoire
    CREATE TABLE reservations_services (
                                           reservation_id INT AUTO_INCREMENT PRIMARY KEY,
                                           client_id INT,
                                           service_id INT,
                                           date DATE,
                                           heure TIME,
                                           statut ENUM('réservé', 'annulé', 'terminé') NOT NULL,
                                           FOREIGN KEY (client_id) REFERENCES clients(id),
                                           FOREIGN KEY (service_id) REFERENCES services_laboratoire(service_id)
    );

    -- Table des transactions de paiement
    CREATE TABLE transactions (
                                  transaction_id INT AUTO_INCREMENT PRIMARY KEY,
                                  client_id INT,
                                  type_carte ENUM('Visa', 'MasterCard', 'AmericanExpress', 'PayPal') NOT NULL,
                                  numero_carte VARCHAR(20) NOT NULL,
                                  nom_carte VARCHAR(255) NOT NULL,
                                  date_expiration DATE NOT NULL,
                                  code_securite VARCHAR(4) NOT NULL,
                                  montant DECIMAL(10, 2) NOT NULL,
                                  date_transaction DATE NOT NULL,
                                  statut ENUM('validé', 'refusé') NOT NULL,
                                  FOREIGN KEY (client_id) REFERENCES clients(id)
    );

    DROP TABLE IF EXISTS messages;

    CREATE TABLE messages (
                            message_id INT AUTO_INCREMENT PRIMARY KEY,
                            expediteur_id INT,
                            destinataire_id INT,
                            date_heure DATETIME,
                            message TEXT,
                            FOREIGN KEY (expediteur_id) REFERENCES clients(id),
                            FOREIGN KEY (destinataire_id) REFERENCES clients(id)
    );
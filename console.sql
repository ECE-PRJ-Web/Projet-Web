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
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL ,
    password VARCHAR(255) NOT NULL,
    path_photo VARCHAR(255),
    specialite VARCHAR(255),
    path_video VARCHAR(255),
    CV VARCHAR(255)
);

CREATE TABLE medecins (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          nom VARCHAR(50) NOT NULL,
                          prenom VARCHAR(50) NOT NULL,
                          photo VARCHAR(255),
                          bureau VARCHAR(100),
                          telephone VARCHAR(20),
                          courriel VARCHAR(100),
                          cv TEXT
);

DROP TABLE IF EXISTS disponibilites;

CREATE TABLE disponibilites (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                medecin_id INT,
                                jour_semaine ENUM('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'),
                                heure_debut TIME,
                                heure_fin TIME,
                                disponible BOOLEAN,
                                FOREIGN KEY (medecin_id) REFERENCES medecins(id)
);




-- Table des rendez-vous
CREATE TABLE rendezvous (
                            rdv_id INT AUTO_INCREMENT PRIMARY KEY,
                            client_id INT,
                            medecin_id INT,
                            date DATE,
                            heure TIME,
                            statut ENUM('programmé', 'annulé', 'terminé') NOT NULL,
                            FOREIGN KEY (client_id) REFERENCES clients(id),
                            FOREIGN KEY (medecin_id) REFERENCES medecins(id)
);

-- Table des services du laboratoire
CREATE TABLE services_laboratoire (
                                      service_id INT AUTO_INCREMENT PRIMARY KEY,
                                      nom_service VARCHAR(255) NOT NULL,
                                      description TEXT
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
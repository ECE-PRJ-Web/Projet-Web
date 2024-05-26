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
    password VARCHAR(255) NOT NULL
);
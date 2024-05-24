DROP DATABASE IF EXISTS L2_Web_Projet_3;
CREATE DATABASE IF NOT EXISTS L2_Web_Projet_3;
USE L2_Web_Projet_3;

DROP TABLE IF EXISTS film;
DROP TABLE IF EXISTS people;
DROP TABLE IF EXISTS liaison;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS jouer;
DROP TABLE IF EXISTS participate;



CREATE TABLE people (
    num_people INT NOT NULL PRIMARY KEY,
    nom_people VARCHAR(40) NOT NULL,
    prenom_people VARCHAR(20) NOT NULL,
    type INT NOT NULL,
    anNais_people INT,
    image_path VARCHAR(100) NOT NULL
);

CREATE TABLE tag (
    tag_name VARCHAR(15) NOT NULL PRIMARY KEY
);

CREATE TABLE liaison(
    num_tag INT NOT NULL,
    num_film INT NOT NULL,
    tag_name VARCHAR(15) NOT NULL PRIMARY KEY,
    CONSTRAINT fk_liaison_tag FOREIGN KEY (tag_name) REFERENCES tag (tag_name)
);

CREATE TABLE film (
    num_film INT NOT NULL PRIMARY KEY,
    titre_film VARCHAR(40) NOT NULL,
    dateSortie_film DATE,
    budget_film INT,
    num_real INT NOT NULL,
    num_people INT NOT NULL,
    resume_film TEXT,
    tag_name VARCHAR(15),
    poster_path VARCHAR(100) NOT NULL,
    vu BOOLEAN NOT NULL,
    CONSTRAINT fk_film_people FOREIGN KEY (num_people) REFERENCES people (num_people),
    CONSTRAINT fk_film_tag FOREIGN KEY (tag_name) REFERENCES tag (tag_name)
);

CREATE TABLE participate (
        num_people INT NOT NULL,
        num_film INT NOT NULL
);

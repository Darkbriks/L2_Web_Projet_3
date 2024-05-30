DROP DATABASE IF EXISTS L2_Web_Projet_3;
CREATE DATABASE IF NOT EXISTS L2_Web_Projet_3;
USE L2_Web_Projet_3;

DROP TABLE IF EXISTS movie_actor;
DROP TABLE IF EXISTS movie_director;
DROP TABLE IF EXISTS movie_tag;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS movies;

CREATE TABLE movies (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    release_date DATE NOT NULL,
    synopsis TEXT,
    vu BOOLEAN DEFAULT FALSE,
    image_path VARCHAR(100) NOT NULL,
    time_duration TIME NOT NULL,
    note INT,
    trailer_path VARCHAR(100) NOT NULL,
    rating INT
);

CREATE TABLE person (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    birth_date DATE NOT NULL,
    death_date DATE,
    type INT DEFAULT 0 CHECK(type IN (0, 1, 2, 3)),
    image_path VARCHAR(100) NOT NULL
);

CREATE TABLE tag (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(15) NOT NULL
);

CREATE TABLE movie_tag (
    movie_id INT,
    tag_id INT,
    PRIMARY KEY (movie_id, tag_id),
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (tag_id) REFERENCES tag(id)
);

CREATE TABLE movie_person (
                              movie_id INT,
                              person_id INT,
                              person_type INT DEFAULT 0 CHECK(type IN (0, 1, 2, 3)),
                              played_name VARCHAR(20), /*Null uniquement si c'est un réalisateur ou un compositeur*/
                              PRIMARY KEY (movie_id, person_id, person_type),
                              FOREIGN KEY (movie_id) REFERENCES movies(id),
                              FOREIGN KEY (actor_id) REFERENCES person(id)
                                  FOREIGN KEY (person_type ) REFERENCES person(type)
);

INSERT INTO tag (name) VALUES
                          ('Action'),
                          ('Adventure'),
                          ('Comedy'),
                          ('Crime'),
                          ('Drama'),
                          ('Fantasy'),
                          ('Historical'),
                          ('Horror'),
                          ('Mystery'),
                          ('Romance'),
                          ('Science Fiction'),
                          ('Space Opera'),
                          ('Thriller'),
                          ('Western');
-- Acteurs et réalisateurs de tous les films Star Wars
INSERT INTO person (first_name, last_name, birth_date, death_date, type, image_path) VALUES
                                                                                         ('Harrison', 'Ford', '1942-07-13', NULL, 1, 'Harrison_Ford.jpg'),
                                                                                         ('Carrie', 'Fisher', '1956-10-21', '2016-12-27', 1, 'Carrie_Fisher.jpg'),
                                                                                         ('Mark', 'Hamill', '1951-09-25', NULL, 1, 'Mark_Hamill.jpg'),
                                                                                         ('George', 'Lucas', '1944-05-14', NULL, 2, 'George_Lucas.jpg'), -- Réalisateur
                                                                                         ('Irvin', 'Kershner', '1923-04-29', '2010-11-27', 2, 'Irvin_Kershner.jpg'), -- Réalisateur
                                                                                         ('Richard', 'Marquand', '1938-09-22', '1987-09-04', 2, 'Richard_Marquand.jpg'), -- Réalisateur
                                                                                         ('Liam', 'Neeson', '1952-06-07', NULL, 1, 'Liam_Neeson.jpg'),
                                                                                         ('Natalie', 'Portman', '1981-06-09', NULL, 1, 'Natalie_Portman.jpg'),
                                                                                         ('Ewan', 'McGregor', '1971-03-31', NULL, 1, 'Ewan_McGregor.jpg'),
                                                                                         ('J.J.', 'Abrams', '1966-06-27', NULL, 2, 'JJ_Abrams.jpg'), -- Réalisateur
                                                                                         ('Rian', 'Johnson', '1973-12-17', NULL, 2, 'Rian_Johnson.jpg'), -- Réalisateur
                                                                                         ('John', 'Williams', '1932-02-08', NULL, 3, 'John_Williams.jpg'), -- Compositeur
                                                                                         ('Daisy', 'Ridley', '1992-04-10', NULL, 1, 'Daisy_Ridley.jpg'),
                                                                                         ('Adam', 'Driver', '1983-11-19', NULL, 1, 'Adam_Driver.jpg'),
                                                                                         ('John', 'Boyega', '1992-03-17', NULL, 1, 'John_Boyega.jpg');


-- Insérer des films
INSERT INTO movies (title, release_date, synopsis, vu, image_path, time_duration, note, rating) VALUES
    ('Star Wars: Episode I - The Phantom Menace', '1999-05-19', 'Two Jedi escape a hostile blockade to find allies and come across a young boy who may bring balance to the Force, but the long dormant Sith resurface to claim their old glory.', TRUE, 'Star_Wars_Episode_I_The_Phantom_Menace.jpg','02:16:00',10,-9),
    ('Star Wars: Episode II - Attack of the Clones', '2002-05-16', 'Ten years after initially meeting, Anakin Skywalker shares a forbidden romance with Padmé Amidala, while Obi-Wan Kenobi investigates an assassination attempt on the senator and discovers a secret clone army crafted for the Jedi.', TRUE, 'Star_Wars_Episode_II_Attack_of_the_Clones.jpg','02:22:00',11,-9),
    ('Star Wars: Episode III - Revenge of the Sith', '2005-05-19', 'Three years into the Clone Wars, the Jedi rescue Palpatine from Count Dooku. As Obi-Wan pursues a new threat, Anakin acts as a double agent between the Jedi Council and Palpatine and is lured into a sinister plan to rule the galaxy.', FALSE, 'Star_Wars_Episode_III_Revenge_of_the_Sith.jpg','02:20:00',12,-9),
    ('Star Wars: Episode IV - A New Hope', '1977-05-25', 'Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a Wookiee and two droids to save the galaxy from the Empire''s world-destroying battle station, while also attempting to rescue Princess Leia from the mysterious Darth Vader.', TRUE, 'Star_Wars_Episode_IV_A_New_Hope.jpg','02:11:00',13,-9),
    ('Star Wars: Episode V - The Empire Strikes Back', '1980-05-21', 'After the Rebels are brutally overpowered by the Empire on the ice planet Hoth, Luke Skywalker begins Jedi training with Yoda, while his friends are pursued by Darth Vader.', TRUE, 'Star_Wars_Episode_V_The_Empire_Strikes_Back.jpg','02:04:00',14,-9),
    ('Star Wars: Episode VI - Return of the Jedi', '1983-05-25', 'After a daring mission to rescue Han Solo from Jabba the Hutt, the Rebels dispatch to Endor to destroy the second Death Star. Meanwhile, Luke struggles to help Darth Vader back from the dark side without falling into the Emperor''s trap.', FALSE, 'Star_Wars_Episode_VI_Return_of_the_Jedi.jpg','02:11:00',15,-9),
    ('Star Wars: Episode VII - The Force Awakens', '2015-12-18', 'Three decades after the Empire''s defeat, a new threat arises in the militant First Order. Stormtrooper defector Finn and the scavenger Rey are caught up in the Resistance''s search for the missing Luke Skywalker.', FALSE, 'Star_Wars_Episode_VII_The_Force_Awakens.jpg','02:18:00',16,-9),
    ('Star Wars: Episode VIII - The Last Jedi', '2017-12-15', 'Rey develops her newly discovered abilities with the guidance of Luke Skywalker, who is unsettled by the strength of her powers. Meanwhile, the Resistance prepares for battle with the First Order.', FALSE, 'Star_Wars_Episode_VIII_The_Last_Jedi.jpg','02:32:00',17,-9),
    ('Star Wars: Episode IX - The Rise of Skywalker', '2019-12-20', 'The surviving members of the Resistance face the First Order once again, and the legendary conflict between the Jedi and the Sith reaches its peak, bringing the Skywalker saga to its end.', FALSE, 'Star_Wars_Episode_IX_The_Rise_of_Skywalker.jpg','02:22:00',18,-9);

-- Acteurs et personnages joués dans les films
INSERT INTO movie_person (movie_id, person_id, played_name, person_type) VALUES
                                                                             (1, 1, 'Han Solo', 1), (1, 2, 'Princess Leia', 1), (1, 3, 'Luke Skywalker', 1),
                                                                             (2, 1, 'Han Solo', 1), (2, 2, 'Princess Leia', 1), (2, 3, 'Luke Skywalker', 1),
                                                                             (3, 1, 'Han Solo', 1), (3, 2, 'Princess Leia', 1), (3, 3, 'Luke Skywalker', 1),
                                                                             (4, 4, 'Qui-Gon Jinn', 1), (4, 8, 'Padmé Amidala', 1), (4, 9, 'Obi-Wan Kenobi', 1),
                                                                             (5, 4, 'Qui-Gon Jinn', 1), (5, 8, 'Padmé Amidala', 1), (5, 9, 'Obi-Wan Kenobi', 1),
                                                                             (6, 4, 'Qui-Gon Jinn', 1), (6, 8, 'Padmé Amidala', 1), (6, 9, 'Obi-Wan Kenobi', 1),
                                                                             (7, 1, 'Han Solo', 1), (7, 2, 'Princess Leia', 1), (7, 13, 'Rey', 1),
                                                                             (8, 14, 'Kylo Ren', 1), (8, 15, 'Finn', 1), (8, 13, 'Rey', 1),
                                                                             (9, 14, 'Kylo Ren', 1), (9, 15, 'Finn', 1), (9, 13, 'Rey', 1),
                                                                             (1, 4, NULL, 2), (2, 5, NULL, 2), (3, 6, NULL, 2), -- Ajout des réalisateurs pour les anciens films
                                                                             (4, 4, NULL, 2), (5, 4, NULL, 2), (6, 4, NULL, 2), -- George Lucas comme réalisateur pour les 3 premiers
                                                                             (7, 10, NULL, 2), (8, 11, NULL, 2), (9, 10, NULL, 2); -- Réalisateurs pour les 7, 8, 9
-- Réalisateurs des films
INSERT INTO movie_person (movie_id, person_id) VALUES
                                                       (1, 4), (2, 4), (3, 4), (4, 4), (5, 4), (6, 4), (7, 10), (8, 11), (9, 10);


-- Insérer des relations movie_tag
INSERT INTO movie_tag (movie_id, tag_id) VALUES
                                             (1, 1), (1, 5), (1, 6),
                                             (2, 1), (2, 5), (2, 6),
                                             (3, 1), (3, 5), (3, 6),
                                             (4, 1), (4, 5), (4, 6),
                                             (5, 1), (5, 5), (5, 6),
                                             (6, 1), (6, 5), (6, 6),
                                             (7, 1), (7, 5), (7, 6),
                                             (8, 1), (8, 5), (8, 6),
                                             (9, 1), (9, 5), (9, 6);

INSERT INTO movie_person (movie_id, person_id) VALUES
                                             (7, 10);
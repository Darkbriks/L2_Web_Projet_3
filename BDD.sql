DROP DATABASE IF EXISTS L2_Web_Projet_3;
CREATE DATABASE IF NOT EXISTS L2_Web_Projet_3;
USE L2_Web_Projet_3;

DROP TABLE IF EXISTS movie_person;
DROP TABLE IF EXISTS movie_tag;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS movies;

CREATE TABLE movies (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    type INT NOT NULL,
    title VARCHAR(50) NOT NULL,
    release_date DATE NOT NULL,
    synopsis TEXT,
    vu BOOLEAN DEFAULT FALSE,
    image_path VARCHAR(100) NOT NULL,
    time_duration INT NOT NULL,
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
    person_type INT DEFAULT 0 CHECK(person_type IN (0, 1, 2, 3)), -- 0: default, 1: actor, 2: director, 3: composer
    played_name VARCHAR(20), -- Null uniquement si c'est un réalisateur ou un compositeur
    PRIMARY KEY (movie_id, person_id, person_type),
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (person_id) REFERENCES person(id)
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
INSERT INTO person (first_name, last_name, birth_date, death_date, image_path) VALUES
     ('Harrison', 'Ford', '1942-07-13', NULL, 'Harrison_Ford.jpg'),
     ('Carrie', 'Fisher', '1956-10-21', '2016-12-27', 'Carrie_Fisher.jpg'),
     ('Mark', 'Hamill', '1951-09-25', NULL, 'Mark_Hamill.jpg'),
     ('George', 'Lucas', '1944-05-14', NULL, 'George_Lucas.jpg'), -- Réalisateur
     ('Irvin', 'Kershner', '1923-04-29', '2010-11-27', 'Irvin_Kershner.jpg'), -- Réalisateur
     ('Richard', 'Marquand', '1938-09-22', '1987-09-04', 'Richard_Marquand.jpg'), -- Réalisateur
     ('Liam', 'Neeson', '1952-06-07', NULL, 'Liam_Neeson.jpg'),
     ('Natalie', 'Portman', '1981-06-09', NULL, 'Natalie_Portman.jpg'),
     ('Ewan', 'McGregor', '1971-03-31', NULL, 'Ewan_McGregor.jpg'),
     ('J.J.', 'Abrams', '1966-06-27', NULL, 'JJ_Abrams.jpg'), -- Réalisateur
     ('Rian', 'Johnson', '1973-12-17', NULL, 'Rian_Johnson.jpg'), -- Réalisateur
     ('John', 'Williams', '1932-02-08', NULL, 'John_Williams.jpg'), -- Compositeur
     ('Daisy', 'Ridley', '1992-04-10', NULL, 'Daisy_Ridley.jpg'),
     ('Adam', 'Driver', '1983-11-19', NULL, 'Adam_Driver.jpg'),
     ('John', 'Boyega', '1992-03-17', NULL, 'John_Boyega.jpg');


-- Insérer des films
INSERT INTO movies (title, type, release_date, synopsis, vu, image_path, time_duration, note, rating, trailer_path) VALUES
    ('Star Wars: Episode I - The Phantom Menace', 0,'1999-05-19', 'Two Jedi escape a hostile blockade to find allies and come across a young boy who may bring balance to the Force, but the long dormant Sith resurface to claim their old glory.', TRUE, 'Star_Wars_Episode_I_The_Phantom_Menace.jpg', 140,10,-9,'https://www.youtube.com/watch?v=bD7bpG-zDJQ&list=PLYZVlJMKY1dJqti6ZcgLIzXsg0A0QWcqH&index=2'),
    ('Star Wars: Episode II - Attack of the Clones', 0,'2002-05-16', 'Ten years after initially meeting, Anakin Skywalker shares a forbidden romance with Padmé Amidala, while Obi-Wan Kenobi investigates an assassination attempt on the senator and discovers a secret clone army crafted for the Jedi.', TRUE, 'Star_Wars_Episode_II_Attack_of_the_Clones.jpg', 140,11,-9,'https://www.youtube.com/watch?v=gYbW1F_c9eM&list=PLYZVlJMKY1dJqti6ZcgLIzXsg0A0QWcqH&index=3'),
    ('Star Wars: Episode III - Revenge of the Sith', 0,'2005-05-19', 'Three years into the Clone Wars, the Jedi rescue Palpatine from Count Dooku. As Obi-Wan pursues a new threat, Anakin acts as a double agent between the Jedi Council and Palpatine and is lured into a sinister plan to rule the galaxy.', FALSE, 'Star_Wars_Episode_III_Revenge_of_the_Sith.jpg', 140,12,-9,'https://www.youtube.com/watch?v=5UnjrG_N8hU'),
    ('Star Wars: Episode IV - A New Hope', 0,'1977-05-25', 'Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a Wookiee and two droids to save the galaxy from the Empire''s world-destroying battle station, while also attempting to rescue Princess Leia from the mysterious Darth Vader.', TRUE, 'newHope.jpeg', 140,13,-9,'https://www.youtube.com/watch?v=vZ734NWnAHA&list=PLYZVlJMKY1dJqti6ZcgLIzXsg0A0QWcqH&index=23'),
    ('Star Wars: Episode V - The Empire Strikes Back', 0,'1980-05-21', 'After the Rebels are brutally overpowered by the Empire on the ice planet Hoth, Luke Skywalker begins Jedi training with Yoda, while his friends are pursued by Darth Vader.', TRUE, 'strikesBack.jpeg', 140,14,-9,'https://www.youtube.com/watch?v=JNwNXF9Y6kY&list=PLYZVlJMKY1dJqti6ZcgLIzXsg0A0QWcqH&index=24'),
    ('Star Wars: Episode VI - Return of the Jedi', 0,'1983-05-25', 'After a daring mission to rescue Han Solo from Jabba the Hutt, the Rebels dispatch to Endor to destroy the second Death Star. Meanwhile, Luke struggles to help Darth Vader back from the dark side without falling into the Emperor''s trap.', FALSE, 'returnOfJedi.jpeg', 140,15,-9,'https://www.youtube.com/watch?v=7L8p7_SLzvU'),
    ('Star Wars: Episode VII - The Force Awakens', 0,'2015-12-18', 'Three decades after the Empire''s defeat, a new threat arises in the militant First Order. Stormtrooper defector Finn and the scavenger Rey are caught up in the Resistance''s search for the missing Luke Skywalker.', FALSE, 'Star_Wars_Episode_VII_The_Force_Awakens.jpg', 140,16,-9,'https://www.youtube.com/watch?v=sGbxmsDFVnE&list=PLYZVlJMKY1dJqti6ZcgLIzXsg0A0QWcqH&index=32'),
    ('Star Wars: Episode VIII - The Last Jedi', 0,'2017-12-15', 'Rey develops her newly discovered abilities with the guidance of Luke Skywalker, who is unsettled by the strength of her powers. Meanwhile, the Resistance prepares for battle with the First Order.', FALSE, 'Star_Wars_Episode_VIII_The_Last_Jedi.jpg', 140,17,-9,'https://www.youtube.com/watch?v=Q0CbN8sfihY&list=PLYZVlJMKY1dJqti6ZcgLIzXsg0A0QWcqH&index=34'),
    ('Star Wars: Episode IX - The Rise of Skywalker', 0,'2019-12-20', 'The surviving members of the Resistance face the First Order once again, and the legendary conflict between the Jedi and the Sith reaches its peak, bringing the Skywalker saga to its end.', FALSE, 'Star_Wars_Episode_IX_The_Rise_of_Skywalker.jpg',140 ,18,-9,'https://www.youtube.com/watch?v=8Qn_spdM5Zg&list=PLYZVlJMKY1dJqti6ZcgLIzXsg0A0QWcqH&index=35');

-- Acteurs et personnages joués dans les films
INSERT INTO movie_person (movie_id, person_id, played_name, person_type) VALUES
     (1, 4, 'Qui-Gon Jinn', 1), (1, 8, 'Padmé Amidala', 1), (1, 9, 'Obi-Wan Kenobi', 1),
     (2, 4, 'Qui-Gon Jinn', 1), (2, 8, 'Padmé Amidala', 1), (2, 9, 'Obi-Wan Kenobi', 1),
     (3, 4, 'Qui-Gon Jinn', 1), (3, 8, 'Padmé Amidala', 1), (3, 9, 'Obi-Wan Kenobi', 1),
     (4, 1, 'Han Solo', 1), (4, 2, 'Princess Leia', 1), (4, 3, 'Luke Skywalker', 1),
     (5, 1, 'Han Solo', 1), (5, 2, 'Princess Leia', 1), (5, 3, 'Luke Skywalker', 1),
     (6, 1, 'Han Solo', 1), (6, 2, 'Princess Leia', 1), (6, 3, 'Luke Skywalker', 1),
     (7, 1, 'Han Solo', 1), (7, 2, 'Princess Leia', 1), (7, 13, 'Rey', 1),
     (8, 14, 'Kylo Ren', 1), (8, 15, 'Finn', 1), (8, 13, 'Rey', 1),
     (9, 14, 'Kylo Ren', 1), (9, 15, 'Finn', 1), (9, 13, 'Rey', 1),
     (1, 4, NULL, 2), (2, 5, NULL, 2), (3, 6, NULL, 2), -- Ajout des réalisateurs pour les anciens films
     (4, 4, NULL, 2), (5, 4, NULL, 2), (6, 4, NULL, 2), -- George Lucas comme réalisateur pour les 3 premiers
     (7, 10, NULL, 2), (8, 11, NULL, 2), (9, 10, NULL, 2), -- Réalisateurs pour les 7, 8, 9
     (1, 12, NULL, 3), (2, 12, NULL, 3), (3, 12, NULL, 3),
     (4, 12, NULL, 3), (5, 12, NULL, 3), (6, 12, NULL, 3),
     (7, 12, NULL, 3), (8, 12, NULL, 3), (9, 12, NULL, 3);

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

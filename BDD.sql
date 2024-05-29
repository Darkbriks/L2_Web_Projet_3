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
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    release_date DATE NOT NULL,
    synopsis TEXT,
    vu BOOLEAN DEFAULT FALSE,
    image_path VARCHAR(100) NOT NULL
);

CREATE TABLE person (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    birth_date DATE NOT NULL,
    death_date DATE,
    type INT DEFAULT 0 CHECK(type IN (0, 1, 2)),
    image_path VARCHAR(100) NOT NULL
);

CREATE TABLE tag (
     id INT AUTO_INCREMENT PRIMARY KEY,
     nom VARCHAR(15) NOT NULL
);

CREATE TABLE movie_tag (
    movie_id INT,
    tag_id INT,
    PRIMARY KEY (movie_id, tag_id),
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (tag_id) REFERENCES tag(id)
);

CREATE TABLE movie_actor (
    movie_id INT,
    actor_id INT,
    PRIMARY KEY (movie_id, actor_id),
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (actor_id) REFERENCES person(id)
);

CREATE TABLE movie_director (
    movie_id INT,
    director_id INT,
    PRIMARY KEY (movie_id, director_id),
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (director_id) REFERENCES person(id)
);

INSERT INTO tag (nom) VALUES ('Action'), ('Adventure'), ('Comedy'), ('Crime'), ('Drama'), ('Fantasy'), ('Historical'), ('Horror'), ('Mystery'), ('Romance'), ('Science Fiction'), ('Space Opera'), ('Thriller'), ('Western');

INSERT INTO person (first_name, last_name, birth_date, death_date, type, image_path) VALUES ('Harrison', 'Ford', '1942-07-13', NULL, 1, 'Harrison_Ford.jpg'), ('Carrie', 'Fisher', '1956-10-21', '2016-12-27', 1, 'Carrie_Fisher.jpg'), ('Mark', 'Hamill', '1951-09-25', NULL, 1, 'Mark_Hamill.jpg'), ('George', 'Lucas', '1944-05-14', NULL, 2, 'George_Lucas.jpg');

INSERT INTO movies (title, release_date, synopsis, vu, image_path) VALUES ('Star Wars: Episode IV - A New Hope', '1977-05-25', 'Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a Wookiee and two droids to save the galaxy from the Empire''s world-destroying battle station, while also attempting to rescue Princess Leia from the mysterious Darth Vader.', TRUE, 'Star_Wars_Episode_IV_A_New_Hope.jpg'), ('Star Wars: Episode V - The Empire Strikes Back', '1980-05-21', 'After the Rebels are brutally overpowered by the Empire on the ice planet Hoth, Luke Skywalker begins Jedi training with Yoda, while his friends are pursued by Darth Vader.', TRUE, 'Star_Wars_Episode_V_The_Empire_Strikes_Back.jpg'), ('Star Wars: Episode VI - Return of the Jedi', '1983-05-25', 'After a daring mission to rescue Han Solo from Jabba the Hutt, the Rebels dispatch to Endor to destroy the second Death Star. Meanwhile, Luke struggles to help Darth Vader back from the dark side without falling into the Emperor''s trap.', FALSE, 'Star_Wars_Episode_VI_Return_of_the_Jedi.jpg');

INSERT INTO movie_actor (movie_id, actor_id) VALUES (1, 1), (1, 2), (1, 3), (2, 1), (2, 2), (2, 3), (3, 1), (3, 2), (3, 3);

INSERT INTO movie_director (movie_id, director_id) VALUES (1, 4), (2, 4), (3, 4);

INSERT INTO movie_tag (movie_id, tag_id) VALUES (1, 1), (1, 5), (1, 6), (2, 1), (2, 5), (2, 6), (3, 1), (3, 5), (3, 6);
CREATE DATABASE IF NOT EXISTS tp7_crud CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE tp7_crud;

CREATE TABLE IF NOT EXISTS formations (
    id_formation INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    duree VARCHAR(50) NOT NULL,
    niveau VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS etudiants (
    id_etudiant INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    id_formation INT NOT NULL,
    CONSTRAINT fk_etudiants_formations FOREIGN KEY (id_formation)
        REFERENCES formations(id_formation)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS modules (
    id_module INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    coefficient INT NOT NULL,
    id_formation INT NOT NULL,
    CONSTRAINT fk_modules_formations FOREIGN KEY (id_formation)
        REFERENCES formations(id_formation)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Donnees de demonstration (a executer une seule fois sur une base vide)
INSERT INTO formations (nom, duree, niveau) VALUES
('Genie Informatique', '2 ans', 'Bac+2'),
('Developpement Web', '1 an', 'Bac+3'),
('Reseaux et Systemes', '1 an', 'Bac+3');

INSERT INTO etudiants (nom, prenom, email, id_formation) VALUES
('Alami', 'Sara', 'sara@example.com', 1),
('Benali', 'Youssef', 'youssef@example.com', 1),
('Karimi', 'Lina', 'lina@example.com', 2);

INSERT INTO modules (nom, coefficient, id_formation) VALUES
('PHP et PDO', 3, 1),
('Java', 4, 1),
('HTML et CSS', 2, 2),
('Administration reseau', 3, 3);

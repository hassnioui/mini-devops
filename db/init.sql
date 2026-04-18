USE devops_exam;

CREATE TABLE IF NOT EXISTS categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS produit (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nom_produit VARCHAR(100) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    quantite INT NOT NULL,
    id_categorie INT NOT NULL,
    CONSTRAINT fk_produit_categorie
        FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
);

INSERT INTO categorie (nom_categorie) VALUES
('Informatique'),
('Bureautique'),
('Reseau');

INSERT INTO produit (nom_produit, prix, quantite, id_categorie) VALUES
('Clavier', 120.00, 10, 1),
('Souris', 80.00, 15, 1),
('Imprimante', 950.00, 3, 2);

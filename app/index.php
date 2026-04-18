<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $id_categorie = $_POST['id_categorie'];

    $sql = "INSERT INTO produit (nom_produit, prix, quantite, id_categorie) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prix, $quantite, $id_categorie]);

    header('Location: index.php');
    exit();
}

$categories = $pdo->query("SELECT * FROM categorie ORDER BY nom_categorie")->fetchAll(PDO::FETCH_ASSOC);

$produits = $pdo->query("
    SELECT p.id_produit, p.nom_produit, p.prix, p.quantite, c.nom_categorie
    FROM produit p
    JOIN categorie c ON p.id_categorie = c.id_categorie
    ORDER BY p.id_produit DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini DevOps - Gestion de produits</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Mini application DevOps</h1>
        <p>Gestion simple de produits avec PHP, MySQL et Docker.</p>

        <h2>Ajouter un produit</h2>
        <form method="post" action="">
            <input type="text" name="nom" placeholder="Nom du produit" required>
            <input type="number" step="0.01" name="prix" placeholder="Prix" required>
            <input type="number" name="quantite" placeholder="Quantité" required>
            <select name="id_categorie" required>
                <option value="">Choisir une catégorie</option>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id_categorie'] ?>">
                        <?= htmlspecialchars($categorie['nom_categorie']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Ajouter</button>
        </form>

        <h2>Liste des produits</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= $produit['id_produit'] ?></td>
                    <td><?= htmlspecialchars($produit['nom_produit']) ?></td>
                    <td><?= number_format($produit['prix'], 2) ?> DH</td>
                    <td><?= $produit['quantite'] ?></td>
                    <td><?= htmlspecialchars($produit['nom_categorie']) ?></td>
                    <td><?= ($produit['quantite'] > 0) ? 'En stock' : 'Rupture' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

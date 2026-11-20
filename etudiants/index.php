<?php

require_once "../database/connexion.php";

$sql = "SELECT etudiants.*, formations.nom AS formation
        FROM etudiants
        INNER JOIN formations
        ON etudiants.id_formation = formations.id_formation";

$stmt = $pdo->query($sql);

$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Liste des étudiants</h1>

<a href="create.php">Ajouter un étudiant</a>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Formation</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($etudiants as $etudiant) { ?>

        <tr>

            <td><?= $etudiant['id_etudiant'] ?></td>
            <td><?= htmlspecialchars($etudiant['nom']) ?></td>
            <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
            <td><?= htmlspecialchars($etudiant['email'] ?? '') ?></td>
            <td><?= htmlspecialchars($etudiant['formation']) ?></td>

            <td>
                <a href="edit.php?id=<?= $etudiant['id_etudiant'] ?>">Modifier</a>
                <a href="delete.php?id=<?= $etudiant['id_etudiant'] ?>">Supprimer</a>
            </td>

        </tr>

    <?php } ?>

</table>
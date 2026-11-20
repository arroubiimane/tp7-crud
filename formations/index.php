<?php

require_once "../database/connexion.php";

$sql = "SELECT * FROM formations";

$stmt = $pdo->query($sql);

$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Liste des formations</h1>

<a href="create.php">Ajouter une formation</a>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Durée</th>
        <th>Niveau</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($formations as $formation) { ?>

        <tr>

            <td><?= $formation['id_formation'] ?></td>

            <td><?= htmlspecialchars($formation['nom']) ?></td>

            <td><?= htmlspecialchars($formation['duree']) ?></td>

            <td><?= htmlspecialchars($formation['niveau']) ?></td>

            <td>
                <a href="edit.php?id=<?= $formation['id_formation'] ?>">Modifier</a>

                <a href="delete.php?id=<?= $formation['id_formation'] ?>">Supprimer</a>
            </td>

        </tr>

    <?php } ?>

</table>
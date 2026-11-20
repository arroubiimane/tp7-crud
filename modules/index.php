<?php

require_once "../database/connexion.php";

$sql = "SELECT modules.*, formations.nom AS formation
        FROM modules
        INNER JOIN formations
        ON modules.id_formation = formations.id_formation";

$stmt = $pdo->query($sql);

$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Liste des modules</h1>

<a href="create.php">Ajouter un module</a>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Coefficient</th>
        <th>Formation</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($modules as $module) { ?>

        <tr>

            <td><?= $module['id_module'] ?></td>
            <td><?= htmlspecialchars($module['nom']) ?></td>
            <td><?= htmlspecialchars($module['coefficient'] ?? '') ?></td>
            <td><?= htmlspecialchars($module['formation']) ?></td>

            <td>
                <a href="edit.php?id=<?= $module['id_module'] ?>">Modifier</a>
                <a href="delete.php?id=<?= $module['id_module'] ?>">Supprimer</a>
            </td>

        </tr>

    <?php } ?>

</table>
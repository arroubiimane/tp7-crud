<?php

require_once "../database/connexion.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("Identifiant invalide");
}

$stmt = $pdo->prepare(
    "SELECT * FROM modules WHERE id_module = :id"
);

$stmt->execute([':id' => $id]);

$module = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    die("Module introuvable");
}

$formations = $pdo->query(
    "SELECT * FROM formations"
)->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $coefficient = $_POST['coefficient'];
    $id_formation = $_POST['id_formation'];

    $sql = "UPDATE modules
            SET nom = :nom,
                coefficient = :coefficient,
                id_formation = :id_formation
            WHERE id_module = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':coefficient' => $coefficient,
        ':id_formation' => $id_formation,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Modifier un module</h1>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom"
           value="<?= htmlspecialchars($module['nom']) ?>" required>

    <br><br>

    <label>Coefficient :</label>
    <input type="number" name="coefficient"
           value="<?= htmlspecialchars($module['coefficient'] ?? '') ?>">

    <br><br>

    <label>Formation :</label>

    <select name="id_formation" required>

        <?php foreach ($formations as $formation) { ?>

            <option value="<?= $formation['id_formation'] ?>"
                <?= $formation['id_formation'] == $module['id_formation'] ? 'selected' : '' ?>>

                <?= htmlspecialchars($formation['nom']) ?>

            </option>

        <?php } ?>

    </select>

    <br><br>

    <input type="submit" value="Modifier">

</form>
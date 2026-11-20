<?php

require_once "../database/connexion.php";

$formations = $pdo->query(
    "SELECT * FROM formations"
)->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $coefficient = $_POST['coefficient'];
    $id_formation = $_POST['id_formation'];

    $sql = "INSERT INTO modules
            (nom, coefficient, id_formation)
            VALUES (:nom, :coefficient, :id_formation)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':coefficient' => $coefficient,
        ':id_formation' => $id_formation
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Ajouter un module</h1>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom" required>

    <br><br>

    <label>Coefficient :</label>
    <input type="number" name="coefficient">

    <br><br>

    <label>Formation :</label>

    <select name="id_formation" required>

        <?php foreach ($formations as $formation) { ?>

            <option value="<?= $formation['id_formation'] ?>">
                <?= htmlspecialchars($formation['nom']) ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <input type="submit" value="Ajouter">

</form>
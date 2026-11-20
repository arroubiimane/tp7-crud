<?php

require_once "../database/connexion.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("Identifiant invalide");
}

$sql = "SELECT * FROM formations WHERE id_formation = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

$formation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    die("Formation introuvable");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $duree = $_POST['duree'];
    $niveau = $_POST['niveau'];

    $sql = "UPDATE formations
            SET nom = :nom, duree = :duree, niveau = :niveau
            WHERE id_formation = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':duree' => $duree,
        ':niveau' => $niveau,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Modifier une formation</h1>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom"
           value="<?= htmlspecialchars($formation['nom']) ?>" required>

    <br><br>

    <label>Durée :</label>
    <input type="text" name="duree"
           value="<?= htmlspecialchars($formation['duree'] ?? '') ?>">

    <br><br>

    <label>Niveau :</label>
    <input type="text" name="niveau"
           value="<?= htmlspecialchars($formation['niveau'] ?? '') ?>">

    <br><br>

    <input type="submit" value="Modifier">

</form>
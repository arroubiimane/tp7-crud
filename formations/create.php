<?php

require_once "../database/connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $duree = $_POST['duree'];
    $niveau = $_POST['niveau'];

    $sql = "INSERT INTO formations (nom, duree, niveau)
            VALUES (:nom, :duree, :niveau)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':duree' => $duree,
        ':niveau' => $niveau
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Ajouter une formation</h1>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom" required>

    <br><br>

    <label>Durée :</label>
    <input type="text" name="duree">

    <br><br>

    <label>Niveau :</label>
    <input type="text" name="niveau">

    <br><br>

    <input type="submit" value="Ajouter">

</form>
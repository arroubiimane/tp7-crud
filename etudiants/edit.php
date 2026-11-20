<?php

require_once "../database/connexion.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("Identifiant invalide");
}

$stmt = $pdo->prepare(
    "SELECT * FROM etudiants WHERE id_etudiant = :id"
);

$stmt->execute([':id' => $id]);

$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    die("Etudiant introuvable");
}

$formations = $pdo->query(
    "SELECT * FROM formations"
)->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $id_formation = $_POST['id_formation'];

    $sql = "UPDATE etudiants
            SET nom = :nom,
                prenom = :prenom,
                email = :email,
                id_formation = :id_formation
            WHERE id_etudiant = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':id_formation' => $id_formation,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Modifier un étudiant</h1>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom"
           value="<?= htmlspecialchars($etudiant['nom']) ?>" required>

    <br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom"
           value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>

    <br><br>

    <label>Email :</label>
    <input type="email" name="email"
           value="<?= htmlspecialchars($etudiant['email'] ?? '') ?>">

    <br><br>

    <label>Formation :</label>

    <select name="id_formation" required>

        <?php foreach ($formations as $formation) { ?>

            <option value="<?= $formation['id_formation'] ?>"
                <?= $formation['id_formation'] == $etudiant['id_formation'] ? 'selected' : '' ?>>

                <?= htmlspecialchars($formation['nom']) ?>

            </option>

        <?php } ?>

    </select>

    <br><br>

    <input type="submit" value="Modifier">

</form>
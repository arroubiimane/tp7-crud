<?php

require_once "../database/connexion.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("Identifiant invalide");
}

$sql = "DELETE FROM etudiants WHERE id_etudiant = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([':id' => $id]);

header("Location: index.php");
exit();

?>
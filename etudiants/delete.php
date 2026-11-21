<?php
require_once '../database/connexion.php';
require_once '../includes/functions.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { set_flash('danger', 'Identifiant invalide.'); redirect('index.php'); }
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id_etudiant = :id");
$stmt->execute([':id' => $id]);
$item = $stmt->fetch();
if (!$item) { set_flash('danger', 'Enregistrement introuvable.'); redirect('index.php'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id_etudiant = :id");
        $stmt->execute([':id' => $id]);
        set_flash('success', 'L’enregistrement a été supprimé.');
    } catch (PDOException $e) {
        set_flash('danger', 'Suppression impossible : cette formation est encore utilisée par des étudiants ou des modules.');
    }
    redirect('index.php');
}
$pageTitle = 'Confirmer la suppression'; $activePage = 'etudiants'; $basePath = '../';
require '../includes/header.php';
?>
<div class="page-heading"><div><div class="eyebrow">CONFIRMATION</div><h1>Supprimer étudiant</h1><p>Vérifiez l’enregistrement avant de confirmer.</p></div></div>
<section class="form-card confirm-card"><p>Voulez-vous vraiment supprimer <strong><?= e($item['nom']) ?></strong> ? Cette action est définitive.</p><form method="POST" class="form-actions"><button class="btn btn-danger" type="submit">Oui, supprimer</button><a class="btn btn-light" href="index.php">Annuler</a></form></section>
<?php require '../includes/footer.php'; ?>

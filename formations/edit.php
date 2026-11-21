<?php
require_once '../database/connexion.php';
require_once '../includes/functions.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { set_flash('danger', 'Identifiant invalide.'); redirect('index.php'); }
$stmt = $pdo->prepare("SELECT * FROM formations WHERE id_formation = :id"); $stmt->execute([':id' => $id]); $item = $stmt->fetch();
if (!$item) { set_flash('danger', 'Enregistrement introuvable.'); redirect('index.php'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['nom' => trim($_POST['nom'] ?? ''), 'duree' => trim($_POST['duree'] ?? ''), 'niveau' => trim($_POST['niveau'] ?? '')];
    $sql = "UPDATE formations SET nom = :nom, duree = :duree, niveau = :niveau WHERE id_formation = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nom' => $data['nom'], ':duree' => $data['duree'], ':niveau' => $data['niveau'], ':id' => $id]);
    set_flash('success', 'La modification a été enregistrée avec succès.');
    redirect('index.php');
}
$pageTitle = 'Modifier'; $activePage = 'formations'; $basePath = '../';
require '../includes/header.php';
?>
<div class="page-heading"><div><div class="eyebrow">MISE À JOUR</div><h1>Modifier formation</h1><p>Les champs sont préremplis avec les données actuelles.</p></div><a class="btn btn-light" href="index.php">← Retour à la liste</a></div>
<form class="form-card" method="POST"><div class="form-grid"><div class="field"><label for="nom">Nom de la formation</label><input type="text" id="nom" name="nom" value="<?= e($item['nom']) ?>"  required></div>
<div class="field"><label for="duree">Durée</label><input type="text" id="duree" name="duree" value="<?= e($item['duree']) ?>"  required></div>
<div class="field"><label for="niveau">Niveau</label><input type="text" id="niveau" name="niveau" value="<?= e($item['niveau']) ?>"  required></div>
</div><div class="form-actions"><button class="btn btn-primary" type="submit">Enregistrer les modifications</button><a class="btn btn-light" href="index.php">Annuler</a></div></form>
<?php require '../includes/footer.php'; ?>

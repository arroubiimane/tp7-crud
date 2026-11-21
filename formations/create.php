<?php
require_once '../database/connexion.php';
require_once '../includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['nom' => trim($_POST['nom'] ?? ''), 'duree' => trim($_POST['duree'] ?? ''), 'niveau' => trim($_POST['niveau'] ?? '')];
    $sql = "INSERT INTO formations (nom, duree, niveau) VALUES (:nom, :duree, :niveau)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nom' => $data['nom'], ':duree' => $data['duree'], ':niveau' => $data['niveau']]);
    set_flash('success', 'Le nouvel enregistrement a été ajouté avec succès.');
    redirect('index.php');
}
$pageTitle = 'Ajouter'; $activePage = 'formations'; $basePath = '../';
require '../includes/header.php';
?>
<div class="page-heading"><div><div class="eyebrow">NOUVEL ENREGISTREMENT</div><h1>Ajouter formation</h1><p>Remplissez les informations ci-dessous.</p></div><a class="btn btn-light" href="index.php">← Retour à la liste</a></div>
<form class="form-card" method="POST"><div class="form-grid"><div class="field"><label for="nom">Nom de la formation</label><input type="text" id="nom" name="nom"  required></div>
<div class="field"><label for="duree">Durée</label><input type="text" id="duree" name="duree"  required></div>
<div class="field"><label for="niveau">Niveau</label><input type="text" id="niveau" name="niveau"  required></div>
</div><div class="form-actions"><button class="btn btn-primary" type="submit">Enregistrer</button><a class="btn btn-light" href="index.php">Annuler</a></div></form>
<?php require '../includes/footer.php'; ?>

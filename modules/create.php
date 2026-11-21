<?php
require_once '../database/connexion.php';
require_once '../includes/functions.php';
$formations = $pdo->query('SELECT id_formation, nom FROM formations ORDER BY nom')->fetchAll();
if (!$formations) { set_flash('warning', 'Ajoutez d’abord une formation.'); redirect('../formations/index.php'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['nom' => trim($_POST['nom'] ?? ''), 'coefficient' => trim($_POST['coefficient'] ?? ''), 'id_formation' => (int)($_POST['id_formation'] ?? 0)];
    $sql = "INSERT INTO modules (nom, coefficient, id_formation) VALUES (:nom, :coefficient, :id_formation)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nom' => $data['nom'], ':coefficient' => $data['coefficient'], ':id_formation' => $data['id_formation']]);
    set_flash('success', 'Le nouvel enregistrement a été ajouté avec succès.');
    redirect('index.php');
}
$pageTitle = 'Ajouter'; $activePage = 'modules'; $basePath = '../';
require '../includes/header.php';
?>
<div class="page-heading"><div><div class="eyebrow">NOUVEL ENREGISTREMENT</div><h1>Ajouter module</h1><p>Remplissez les informations ci-dessous.</p></div><a class="btn btn-light" href="index.php">← Retour à la liste</a></div>
<form class="form-card" method="POST"><div class="form-grid"><div class="field"><label for="nom">Nom du module</label><input type="text" id="nom" name="nom"  required></div>
<div class="field"><label for="coefficient">Coefficient</label><input type="number" id="coefficient" name="coefficient" step="1" min="1" required></div>
<div class="field full"><label for="id_formation">Formation</label><select id="id_formation" name="id_formation" required><option value="">Choisir une formation</option><?php foreach ($formations as $formation): ?><option value="<?= (int)$formation['id_formation'] ?>"><?= e($formation['nom']) ?></option><?php endforeach; ?></select></div></div><div class="form-actions"><button class="btn btn-primary" type="submit">Enregistrer</button><a class="btn btn-light" href="index.php">Annuler</a></div></form>
<?php require '../includes/footer.php'; ?>

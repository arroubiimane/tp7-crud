<?php
require_once '../database/connexion.php';
require_once '../includes/functions.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { set_flash('danger', 'Identifiant invalide.'); redirect('index.php'); }
$stmt = $pdo->prepare("SELECT * FROM modules WHERE id_module = :id"); $stmt->execute([':id' => $id]); $item = $stmt->fetch();
if (!$item) { set_flash('danger', 'Enregistrement introuvable.'); redirect('index.php'); }
$formations = $pdo->query('SELECT id_formation, nom FROM formations ORDER BY nom')->fetchAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['nom' => trim($_POST['nom'] ?? ''), 'coefficient' => trim($_POST['coefficient'] ?? ''), 'id_formation' => (int)($_POST['id_formation'] ?? 0)];
    $sql = "UPDATE modules SET nom = :nom, coefficient = :coefficient, id_formation = :id_formation WHERE id_module = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nom' => $data['nom'], ':coefficient' => $data['coefficient'], ':id_formation' => $data['id_formation'], ':id' => $id]);
    set_flash('success', 'La modification a été enregistrée avec succès.');
    redirect('index.php');
}
$pageTitle = 'Modifier'; $activePage = 'modules'; $basePath = '../';
require '../includes/header.php';
?>
<div class="page-heading"><div><div class="eyebrow">MISE À JOUR</div><h1>Modifier module</h1><p>Les champs sont préremplis avec les données actuelles.</p></div><a class="btn btn-light" href="index.php">← Retour à la liste</a></div>
<form class="form-card" method="POST"><div class="form-grid"><div class="field"><label for="nom">Nom du module</label><input type="text" id="nom" name="nom" value="<?= e($item['nom']) ?>"  required></div>
<div class="field"><label for="coefficient">Coefficient</label><input type="number" id="coefficient" name="coefficient" value="<?= e($item['coefficient']) ?>" step="1" min="1" required></div>
<div class="field full"><label for="id_formation">Formation</label><select id="id_formation" name="id_formation" required><?php foreach ($formations as $formation): ?><option value="<?= (int)$formation['id_formation'] ?>" <?= (int)$formation['id_formation'] === (int)$item['id_formation'] ? 'selected' : '' ?>><?= e($formation['nom']) ?></option><?php endforeach; ?></select></div></div><div class="form-actions"><button class="btn btn-primary" type="submit">Enregistrer les modifications</button><a class="btn btn-light" href="index.php">Annuler</a></div></form>
<?php require '../includes/footer.php'; ?>

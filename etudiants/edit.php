<?php
require_once '../database/connexion.php';
require_once '../includes/functions.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { set_flash('danger', 'Identifiant invalide.'); redirect('index.php'); }
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id_etudiant = :id"); $stmt->execute([':id' => $id]); $item = $stmt->fetch();
if (!$item) { set_flash('danger', 'Enregistrement introuvable.'); redirect('index.php'); }
$formations = $pdo->query('SELECT id_formation, nom FROM formations ORDER BY nom')->fetchAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['nom' => trim($_POST['nom'] ?? ''), 'prenom' => trim($_POST['prenom'] ?? ''), 'email' => trim($_POST['email'] ?? ''), 'id_formation' => (int)($_POST['id_formation'] ?? 0)];
    $sql = "UPDATE etudiants SET nom = :nom, prenom = :prenom, email = :email, id_formation = :id_formation WHERE id_etudiant = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nom' => $data['nom'], ':prenom' => $data['prenom'], ':email' => $data['email'], ':id_formation' => $data['id_formation'], ':id' => $id]);
    set_flash('success', 'La modification a été enregistrée avec succès.');
    redirect('index.php');
}
$pageTitle = 'Modifier'; $activePage = 'etudiants'; $basePath = '../';
require '../includes/header.php';
?>
<div class="page-heading"><div><div class="eyebrow">MISE À JOUR</div><h1>Modifier étudiant</h1><p>Les champs sont préremplis avec les données actuelles.</p></div><a class="btn btn-light" href="index.php">← Retour à la liste</a></div>
<form class="form-card" method="POST"><div class="form-grid"><div class="field"><label for="nom">Nom</label><input type="text" id="nom" name="nom" value="<?= e($item['nom']) ?>"  required></div>
<div class="field"><label for="prenom">Prénom</label><input type="text" id="prenom" name="prenom" value="<?= e($item['prenom']) ?>"  required></div>
<div class="field"><label for="email">Adresse e-mail</label><input type="email" id="email" name="email" value="<?= e($item['email']) ?>"  required></div>
<div class="field full"><label for="id_formation">Formation</label><select id="id_formation" name="id_formation" required><?php foreach ($formations as $formation): ?><option value="<?= (int)$formation['id_formation'] ?>" <?= (int)$formation['id_formation'] === (int)$item['id_formation'] ? 'selected' : '' ?>><?= e($formation['nom']) ?></option><?php endforeach; ?></select></div></div><div class="form-actions"><button class="btn btn-primary" type="submit">Enregistrer les modifications</button><a class="btn btn-light" href="index.php">Annuler</a></div></form>
<?php require '../includes/footer.php'; ?>

<?php
require_once '../database/connexion.php';
require_once '../includes/functions.php';
$items = $pdo->query("SELECT etudiants.*, formations.nom AS formation_nom FROM etudiants INNER JOIN formations ON etudiants.id_formation = formations.id_formation ORDER BY etudiants.id_etudiant DESC")->fetchAll();
$pageTitle = 'Étudiants'; $activePage = 'etudiants'; $basePath = '../';
require '../includes/header.php';
?>
<div class="page-heading"><div><div class="eyebrow">GESTION DES DONNÉES</div><h1>Étudiants</h1><p>Consultez et gérez les étudiants du centre.</p></div><a class="btn btn-primary" href="create.php">＋ Ajouter un étudiant</a></div>
<section class="content-card"><div class="card-head"><div><h2>Liste des étudiants</h2><p><?= count($items) ?> enregistrement(s)</p></div></div><div class="table-wrap"><table><thead><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>E-mail</th><th>Formation</th><th>Actions</th></tr></thead><tbody>
<?php if (count($items) === 0): ?><tr><td colspan="7" class="empty">Aucun enregistrement pour le moment.</td></tr><?php else: ?>
<?php foreach ($items as $item): ?><tr><td>#<?= (int)$item['id_etudiant'] ?></td><td><strong><?= e($item['nom']) ?></strong></td><td><?= e($item['prenom']) ?></td><td><?= e($item['email']) ?></td><td><span class="badge"><?= e($item['formation_nom']) ?></span></td><td><div class="actions"><a class="action-link" href="edit.php?id=<?= (int)$item['id_etudiant'] ?>">Modifier</a><a class="action-link delete" href="delete.php?id=<?= (int)$item['id_etudiant'] ?>">Supprimer</a></div></td></tr><?php endforeach; ?>
<?php endif; ?></tbody></table></div></section>
<?php require '../includes/footer.php'; ?>

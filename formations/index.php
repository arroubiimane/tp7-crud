<?php
require_once '../database/connexion.php';
require_once '../includes/functions.php';
$items = $pdo->query("SELECT * FROM formations ORDER BY id_formation DESC")->fetchAll();
$pageTitle = 'Formations'; $activePage = 'formations'; $basePath = '../';
require '../includes/header.php';
?>
<div class="page-heading"><div><div class="eyebrow">GESTION DES DONNÉES</div><h1>Formations</h1><p>Consultez et gérez les formations du centre.</p></div><a class="btn btn-primary" href="create.php">＋ Ajouter une formation</a></div>
<section class="content-card"><div class="card-head"><div><h2>Liste des formations</h2><p><?= count($items) ?> enregistrement(s)</p></div></div><div class="table-wrap"><table><thead><tr><th>ID</th><th>Nom</th><th>Durée</th><th>Niveau</th><th>Actions</th></tr></thead><tbody>
<?php if (count($items) === 0): ?><tr><td colspan="6" class="empty">Aucun enregistrement pour le moment.</td></tr><?php else: ?>
<?php foreach ($items as $item): ?><tr><td>#<?= (int)$item['id_formation'] ?></td><td><strong><?= e($item['nom']) ?></strong></td><td><?= e($item['duree']) ?></td><td><span class="badge"><?= e($item['niveau']) ?></span></td><td><div class="actions"><a class="action-link" href="edit.php?id=<?= (int)$item['id_formation'] ?>">Modifier</a><a class="action-link delete" href="delete.php?id=<?= (int)$item['id_formation'] ?>">Supprimer</a></div></td></tr><?php endforeach; ?>
<?php endif; ?></tbody></table></div></section>
<?php require '../includes/footer.php'; ?>

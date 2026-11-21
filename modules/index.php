<?php
require_once '../database/connexion.php';
require_once '../includes/functions.php';
$items = $pdo->query("SELECT modules.*, formations.nom AS formation_nom FROM modules INNER JOIN formations ON modules.id_formation = formations.id_formation ORDER BY modules.id_module DESC")->fetchAll();
$pageTitle = 'Modules'; $activePage = 'modules'; $basePath = '../';
require '../includes/header.php';
?>
<div class="page-heading"><div><div class="eyebrow">GESTION DES DONNÉES</div><h1>Modules</h1><p>Consultez et gérez les modules du centre.</p></div><a class="btn btn-primary" href="create.php">＋ Ajouter un module</a></div>
<section class="content-card"><div class="card-head"><div><h2>Liste des modules</h2><p><?= count($items) ?> enregistrement(s)</p></div></div><div class="table-wrap"><table><thead><tr><th>ID</th><th>Nom</th><th>Coefficient</th><th>Formation</th><th>Actions</th></tr></thead><tbody>
<?php if (count($items) === 0): ?><tr><td colspan="6" class="empty">Aucun enregistrement pour le moment.</td></tr><?php else: ?>
<?php foreach ($items as $item): ?><tr><td>#<?= (int)$item['id_module'] ?></td><td><strong><?= e($item['nom']) ?></strong></td><td><?= e($item['coefficient']) ?></td><td><span class="badge"><?= e($item['formation_nom']) ?></span></td><td><div class="actions"><a class="action-link" href="edit.php?id=<?= (int)$item['id_module'] ?>">Modifier</a><a class="action-link delete" href="delete.php?id=<?= (int)$item['id_module'] ?>">Supprimer</a></div></td></tr><?php endforeach; ?>
<?php endif; ?></tbody></table></div></section>
<?php require '../includes/footer.php'; ?>

<?php
require_once 'database/connexion.php';
$nbFormations = $pdo->query('SELECT COUNT(*) FROM formations')->fetchColumn();
$nbEtudiants = $pdo->query('SELECT COUNT(*) FROM etudiants')->fetchColumn();
$nbModules = $pdo->query('SELECT COUNT(*) FROM modules')->fetchColumn();
$pageTitle = 'Tableau de bord'; $activePage = 'home'; $basePath = '';
require 'includes/header.php';
?>
<section class="hero"><div class="eyebrow" style="color:#c8e2f8">BIENVENUE</div><h1>Gérez votre centre de formation</h1><p>Retrouvez au même endroit les formations, les étudiants et les modules.<br>Utilisez le menu pour consulter ou gérer vos données.</p></section>
<section class="stats-grid">
    <div class="stat-card"><div class="stat-label">FORMATIONS</div><div class="stat-number"><?= (int)$nbFormations ?></div><div class="stat-note">Formations enregistrées</div></div>
    <div class="stat-card"><div class="stat-label">ÉTUDIANTS</div><div class="stat-number"><?= (int)$nbEtudiants ?></div><div class="stat-note">Étudiants inscrits</div></div>
    <div class="stat-card"><div class="stat-label">MODULES</div><div class="stat-number"><?= (int)$nbModules ?></div><div class="stat-note">Modules proposés</div></div>
</section>
<section class="quick-grid">
    <article class="quick-card"><div class="quick-icon">▦</div><h2>Formations</h2><p>Créer, consulter, modifier et supprimer les formations proposées.</p><a class="btn btn-primary" href="formations/index.php">Gérer les formations</a></article>
    <article class="quick-card"><div class="quick-icon">♙</div><h2>Étudiants</h2><p>Gérer les étudiants et consulter leur formation associée.</p><a class="btn btn-primary" href="etudiants/index.php">Gérer les étudiants</a></article>
    <article class="quick-card"><div class="quick-icon">▤</div><h2>Modules</h2><p>Gérer les modules et leur rattachement à une formation.</p><a class="btn btn-primary" href="modules/index.php">Gérer les modules</a></article>
</section>
<?php require 'includes/footer.php'; ?>

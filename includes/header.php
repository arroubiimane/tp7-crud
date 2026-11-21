<?php
require_once __DIR__ . '/functions.php';
$pageTitle = $pageTitle ?? 'Centre de Formation';
$basePath = $basePath ?? '';
$activePage = $activePage ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> | Centre de Formation</title>
    <link rel="stylesheet" href="<?= e($basePath) ?>assets/css/style.css">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="<?= e($basePath) ?>index.php">
            <span class="brand-mark">CF</span>
            <span><strong>Centre de Formation</strong><small>ESPACE DE GESTION</small></span>
        </a>
        <div class="nav-label">MENU PRINCIPAL</div>
        <a class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>" href="<?= e($basePath) ?>index.php"><span>⌂</span> Tableau de bord</a>
        <a class="nav-link <?= $activePage === 'formations' ? 'active' : '' ?>" href="<?= e($basePath) ?>formations/index.php"><span>▦</span> Formations</a>
        <a class="nav-link <?= $activePage === 'etudiants' ? 'active' : '' ?>" href="<?= e($basePath) ?>etudiants/index.php"><span>♙</span> Étudiants</a>
        <a class="nav-link <?= $activePage === 'modules' ? 'active' : '' ?>" href="<?= e($basePath) ?>modules/index.php"><span>▤</span> Modules</a>
        <div class="sidebar-footer"><span class="avatar">AD</span><span><strong>Administration</strong><small>Gestion du centre</small></span></div>
    </aside>
    <main class="main-content">
        <header class="topbar"><div class="breadcrumb">CENTRE DE FORMATION <span>/</span> <?= e(strtoupper($pageTitle)) ?></div><div class="topbar-label">Application de gestion</div></header>
        <?php show_flash(); ?>

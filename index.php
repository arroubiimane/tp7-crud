<?php

require_once "database/connexion.php";

echo "Connexion réussie !";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion du centre</title>
</head>

<body>

    <h1>Gestion du centre de formation</h1>

    <h2>Bienvenue</h2>

    <p>Choisissez une partie à gérer :</p>

    <ul>

        <li>
            <a href="formations/index.php">
                Gestion des formations
            </a>
        </li>

        <li>
            <a href="etudiants/index.php">
                Gestion des étudiants
            </a>
        </li>

        <li>
            <a href="modules/index.php">
                Gestion des modules
            </a>
        </li>

    </ul>

</body>
</html>
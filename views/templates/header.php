<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomtroc</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<header class="navbar">
    <div class="container nav-content">
        <div class="logo">
            <img src="img/logo.svg" alt="Logo">
        </div>
        <nav class="nav-links">
            <a href="index.php?page=home" class="<?= ($_GET['page'] ?? '') === 'home' ? 'active' : '' ?>">Accueil</a>
            <a href="index.php?page=booklist" class="<?= ($_GET['page'] ?? '') === 'booklist' ? 'active' : '' ?>">Nos livres à l’échange</a>
        </nav>
        <div class="nav-right">
            <a href="#">💬 Messagerie</a>
            <a href="index.php?page=moncompte" class="<?= ($_GET['page'] ?? '') === 'moncompte' ? 'active' : '' ?>">👤 Mon compte</a>
            <a href="index.php?page=connexion" class="<?= ($_GET['page'] ?? '') === 'connexion' ? 'active' : '' ?>">Connexion</a>
        </div>
    </div>
</header>

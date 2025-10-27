<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomtroc</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<?php
    // Connexion à la base de données
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=tomtroc;charset=utf8', 'root', '');
    }
    catch(Exception $e){
            die( 'Erreur : '.$e->getMessage()   );
    }
?>

<body>
    <header class="navbar">
        <div class="container nav-content">
            <div class="logo">
                <img src="img/logo.svg" alt="Logo">
            </div>

            <nav class="nav-links">
                <a href="#" class="active">Accueil</a>
                <a href="#">Nos livres à l’échange</a>
            </nav>

            <div class="nav-right">
                <a href="#">💬 Messagerie</a>
                <a href="#">👤 Mon compte</a>
                <a href="#" class="login">Connexion</a>
            </div>

        </div>
  </header>

    <main class="hero container">
        <div class="hero-text">
            <h2>Rejoignez nos lecteurs passionnés</h2>
            <p>
                Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. 
                Nous croyons en la magie du partage de connaissances et d’histoires à travers les livres.
            </p>
            <a href="#" class="btn">Découvrir</a>
        </div>
        <div class="hero-image">
            <img src="img/hamza-nouasria-KXrvPthkmYQ-unsplash 1.png" alt="Image page accueil" />
            <p class="image-author">Hamza</p>
        </div>
    </main>  
      
    <footer class="footer">
        <p>Politique de confidentialité</a>
    </footer>
</body>
</html>
<?php
/**
 * Page d'accueil : affichage des derniers livres
 */
?>

<main class="home hero">
    <!-- HERO SECTION -->
    <div class="contenair hero-content">
    <div class="hero-text">
        <h2>Rejoignez nos lecteurs passionnés</h2>
        <p>
            Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. 
            Nous croyons en la magie du partage de connaissances et d’histoires à travers les livres.
        </p>
        <a href="index.php?page=booklist" class="btn">Découvrir</a>
    </div>

    <div class="hero-image">
        <img src="img/hamza-nouasria-KXrvPthkmYQ-unsplash 1.png" alt="Image page accueil" />
        <div class="image-author">Hamza</div>
    </div>
    </div>
</main>

<!-- GRID DES LIVRES -->
<section class="books container">
    <h3>Les derniers livres ajoutés</h3>
    <div class="books-grid">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <div class="book-card">
                    <a href="index.php?page=detail&book_id=<?= htmlspecialchars($book->getBookId()) ?>">
                        <img src="<?= htmlspecialchars($book->getImage()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>" class="book-image" />
                    </a>
                    <h4><?= htmlspecialchars($book->getTitle()) ?></h4>
                    <p> <strong><?= htmlspecialchars($book->getAuthor()) ?></strong></p>
                    <p>Vendu par : <strong><?= htmlspecialchars($book->getNickname()) ?></strong></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun livre disponible pour le moment.</p>
        <?php endif; ?>
    </div>
    <a href="index.php?page=booklist" class="view-all-btn">Voir tous les livres</a>
</section>

<!-- ============================ COMMENT ÇA MARCHE ============================ -->
<section class="how-it-works">
    <div class="container">
    <h2>Comment ça marche ?</h2>
    <p class="how-subtitle">
        Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :
    </p>

    <div class="how-grid">

        <div class="how-card">
            <h4>Inscrivez-vous</h4>
            <p>Créez gratuitement votre compte sur notre plateforme.</p>
        </div>

        <div class="how-card highlight">
            <h4>Ajoutez vos livres</h4>
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        </div>

        <div class="how-card">
            <h4>Parcourez les autres</h4>
            <p>Consultez les livres disponibles chez d'autres membres.</p>
        </div>

        <div class="how-card">
            <h4>Échangez & discutez</h4>
            <p>Proposez un échange et discutez avec d’autres passionnés.</p>
        </div>

    </div>

    <a href="index.php?page=booklist" class="btn btn-center">Voir tous les livres</a>
</section>


<!-- ============================ BANDEROLE IMAGE ============================ -->
<section class="banner-image">
    <img src="img/banner.png" alt="Bannière bibliothèque" />
</section>


<!-- ============================ NOS VALEURS ============================ -->
<section class="values">
    <div class="container">
        <h2>Nos valeurs</h2>

        <p>
            Chez Tom Troc, nous mettons l’accent sur le partage, la découverte et la communauté. 
            Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. 
            Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
        </p>

        <p>
         Notre association a été fondée avec une conviction profonde : chaque livre mérite d’être lu et partagé.
        </p>

        <p>
            Nous sommes passionnés par la création d’une plateforme conviviale qui permet aux lecteurs de se connecter, 
            de partager leurs découvertes littéraires et d’échanger des livres qui attendent patiemment sur les étagères.
        </p>

        <p class="values-signature">L’équipe Tom Troc</p>

        <div class="values-icon">
            <img src="img/heart.png" alt="Icône cœur" />
        </div>
    </div>
</section>

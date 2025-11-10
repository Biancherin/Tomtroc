<?php
/**
 * Page d'accueil : affichage des derniers livres
 */
?>

<main class="home hero container">
    <!-- HERO SECTION -->
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
                    <p>par <strong><?= htmlspecialchars($book->getAuthor()) ?></strong></p>
                    <p>Vendu par : <strong><?= htmlspecialchars($book->getNickname()) ?></strong></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun livre disponible pour le moment.</p>
        <?php endif; ?>
    </div>
</section>

<?php
/**
 * Detail d'un livre
 */
?>

<main class="container detail-book">

    <!-- Fil d’Ariane -->
    <nav class="breadcrumb">
        <a href="index.php?page=booklist">Nos livres</a> &gt; 
        <span><?= htmlspecialchars($book->getTitle()) ?></span>
    </nav>

    <div class="detail-grid">
        <!-- Image du livre -->
        <div class="detail-image">
            <img src="<?= htmlspecialchars($book->getImage()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>" />
        </div>

        <!-- Informations du livre -->
        <div class="detail-info">
            <h2><?= htmlspecialchars($book->getTitle()) ?></h2>
            <p class="author">par <strong><?= htmlspecialchars($book->getAuthor()) ?></strong></p>

            <h3>Description</h3>
            <p><?= nl2br(htmlspecialchars($book->getContent())) ?></p>

            <p class="owner">
                Propriétaire : 
                <strong>
                    <img src="<?= htmlspecialchars($book->getOwnerImage()) ?>" alt="Propriétaire" class="owner-img" />
                    <?= htmlspecialchars($book->getNickname()) ?>
                </strong>
            </p>

            <!-- Gros bouton envoyer un message -->
            <button class="btn-message">Envoyer un message</button>
        </div>
    </div>
</main>

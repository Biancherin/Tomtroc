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
                    <a href="index.php?page=moncompte&user_id=<?= $book->getUserTId() ?>">
                        <img src="<?= htmlspecialchars($book->getOwnerImage()) ?>" alt="Propriétaire" class="owner-img" />
                        <?= htmlspecialchars($book->getNickname()) ?>
                    </a>
                </strong>
            </p>

            <!-- Bouton envoyer un message -->
            <a href="index.php?page=messages&to=<?= $book->getUserTId() ?>&book_id=<?= $book->getBookId() ?>" 
               class="btn-message">
               Envoyer un message
            </a>
        </div>
    </div>
</main>

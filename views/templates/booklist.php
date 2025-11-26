<?php
/**
 * Page de liste complète des livres à l'échange
 * Variable disponible : $books (tableau de livres)
 */
?>
<main class="booklist container">
    <!-- En-tête avec titre et barre de recherche -->
    <div class="booklist-header">
        <h2 class="booklist-title">Nos livres à l’échange</h2>

        <form method="GET" action="index.php" class="booklist-search-form">
            <input type="hidden" name="page" value="booklist">
            <input type="text" 
                name="q" 
                class="booklist-search" 
                placeholder="Rechercher un livre..." 
                value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>"
            />
        </form>
    </div>

    <!-- Grille des livres -->
    <section class="booklist">
        <div class="books-grid-list">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <div class="book-card">
                        <!-- Image cliquable vers la page détail -->
                        <a href="index.php?page=detail&book_id=<?= htmlspecialchars($book->getBookId()) ?>">
                            <img src="<?= htmlspecialchars($book->getImage()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>" 
                                class="book-image"/>
                        </a>
                        <h4><?= htmlspecialchars($book->getTitle()) ?></h4>
                        <p> <strong><?= htmlspecialchars($book->getAuthor()) ?></strong></p>

                        <p><em>Vendu par : <?= htmlspecialchars($book->getNickname()) ?></em></p>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun livre trouvé pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

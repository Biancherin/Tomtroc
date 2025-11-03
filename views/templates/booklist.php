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

        <form method="get" action="index.php" class="booklist-search-form">
            <input type="hidden" name="page" value="booklist">
            <input 
                type="text" 
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
                        <a href="index.php?page=detail&book_id=<?= htmlspecialchars($book['id'] ?? $book['book_id'] ?? '') ?>">
                            <img 
                                src="<?= htmlspecialchars($book['image']) ?>" 
                                alt="<?= htmlspecialchars($book['title']) ?>" 
                                class="book-image"
                            />
                        </a>
                        <h4><?= htmlspecialchars($book['title']) ?></h4>
                        <p>par <strong><?= htmlspecialchars($book['author']) ?></strong></p>
                        <p><em>Vendu par : <?= htmlspecialchars($book['nickname']) ?></em></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun livre trouvé pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

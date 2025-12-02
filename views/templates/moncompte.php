<?php
/** @var User $user */
?>

<section class="mon-compte container">

    <!-- ✅ PROFIL UTILISATEUR -->
    <div class="profilu">
        <img src="<?= htmlspecialchars($user?->getImage() ?: 'img/defaultavatar.png') ?>" 
             alt="Photo de profil <?= htmlspecialchars($user?->getNickname() ?: 'Invité') ?>" 
             class="profilu-photo">

        <div class="profile-divider"></div>

        <h2><?= htmlspecialchars($user?->getNickname() ?: 'Invité') ?></h2>

        <p>Membre depuis <?= $user?->getDateCreation() ? $user->getDateCreation()->format('Y') : 'N/A' ?></p>

        <h3>Bibliothèque</h3>

        <p><strong><?= count($books ?? []) ?></strong> livre<?= count($books ?? []) > 1 ? 's' : '' ?></p>

        <a href="index.php?page=messages&to=<?= $userId ?>" class="btnu">Écrire un message</a>
    </div>

    <!-- ✅ TABLEAU DES LIVRES -->
    <div class="livresu">

        <!-- En-têtes du tableau -->
        <div class="book-card header">
            <div><strong>PHOTO</strong></div>
            <div><strong>TITRE</strong></div>
            <div><strong>AUTEUR</strong></div>
            <div><strong>DESCRIPTION</strong></div>
        </div>

        <div class="books-grid-listu">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <div class="book-cardu">
                        
                        <!-- Photo -->
                        <a href="index.php?page=detail&book_id=<?= $book->getBookId() ?>">
                            <img src="<?= htmlspecialchars($book->getImage()) ?>" 
                                 alt="<?= htmlspecialchars($book->getTitle()) ?>" 
                                 class="book-imageu">
                        </a>

                        <!-- Titre -->
                        <div>
                            <h4><?= htmlspecialchars($book->getTitle()) ?></h4>
                        </div>

                        <!-- Auteur -->
                        <div>
                            <p><strong><?= htmlspecialchars($book->getAuthor()) ?></strong></p>
                        </div>

                        <!-- Description -->
                        <div>
                            <p class="book-descu"><?= htmlspecialchars($book->getContent()) ?></p>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="padding: 20px;">Cet utilisateur n’a publié aucun livre pour le moment.</p>
            <?php endif; ?>
        </div>

    </div>

</section>


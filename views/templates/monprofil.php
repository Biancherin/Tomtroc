<?php
/** @var User $user */
?>

<section class="mon-profil">
    <h1>Mon compte</h1>

    <div class="monprofil-container">

        <!-- PROFIL UTILISATEUR -->
        <div class="profil-section">
            <div class="profil-photo">

        <!-- Photo de profil ou photo par défaut -->
       <img 
            src="<?= htmlspecialchars($user?->getImage() ?: 'img/defaultavatar.png') ?>"
            alt="Photo de profil <?= htmlspecialchars($user?->getNickname() ?: 'Invité') ?>"
            class="profilu-photo"
        >
    
        <!-- FORMULAIRE DE MODIFICATION DE PHOTO  -->
        <form action="index.php?page=updateUser" method="post" enctype="multipart/form-data" class="form-photo">

        <!-- Input fichier visible -->
        <label for="image" class="custom-uploadu">Modifier la photo</label>
        <input type="file" name="image" id="image" accept="image/*" style="display:none;">

        </form>

        </div>

            <h2><?= htmlspecialchars($user?->getNickname()) ?></h2>

            <p class="membre-depuis">
                Membre depuis <?= $user?->getDateCreation() ? $user?->getDateCreation()->format('M Y') : 'Inconnue' ?>
            </p>

            <h3>BIBLIOTHÈQUE</h3>

            <p class="nb-livres">
                📚 <?= count($books) ?> livres
            </p>

            <!-- Bouton pour ajouter un livre -->
            <div class="add-book-btn">
                <a href="index.php?page=addBook" class="btn-ajouter">Ajouter un livre</a>
            </div>

        </div>

        <!-- INFORMATIONS PERSONNELLES -->
        <div class="infos-section">
            <h4> Vos Informations personnelles</h4>

            <form action="index.php?page=updateUser" method="post" class="form-infos" enctype="multipart/form-data">
                
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="********">

                <label for="nickname">Pseudo</label>
                <input type="text" id="nickname" name="nickname" value="<?= htmlspecialchars($user->getNickname()) ?>" required>


                <button type="submit" class="btn-enregistrer">Enregistrer</button>
            </form>
        </div>

    </div>

    <!-- LISTE DES LIVRES -->
    <div class="liste-livres-section">
    
        <?php if (!empty($books)): ?>
        <table class="livres-table">
            <thead>
                <tr>
                    <th>PHOTO</th>
                    <th>TITRE</th>
                    <th>AUTEUR</th>
                    <th>DESCRIPTION</th>
                    <th>DISPONIBILITE</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td>
                        <img src="<?= htmlspecialchars($book->getImage() ?? 'img/default-book.png') ?>"
                             alt="<?= htmlspecialchars($book->getTitle()) ?>"
                             class="book-img">
                    </td>
                    <td><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                    <td><?= htmlspecialchars($book->getContent()) ?></td>
                    <td class="td-dispo">
                        <?php if ($book->getIsEnabled()): ?>
                            <span class="badge-dispo">Disponible</span>
                            <?php else: ?>
                            <span class="badge-nondispo">Non dispo</span>
                            <?php endif; ?>
                    </td>
                    <td class="actions-td">
                        <a href="index.php?page=editBook&book_id=<?= $book->getBookId() ?>" class="btn-edit">Éditer</a>
                        <a href="index.php?page=deleteBook&book_id=<?= $book->getBookId() ?>" class="btn-delete"
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Vous n'avez encore ajouté aucun livre.</p>
        <?php endif; ?>
    </div>
</section>



<section class="mon-profil">
    <h1>Mon compte</h1>

    <div class="monprofil-container">

        <!-- PROFIL UTILISATEUR -->
        <div class="profil-section">
            <div class="profil-photo">
                <img id="profilImage" src="<?= htmlspecialchars($user->getImage() ?? 'img/default-user.png') ?>" alt="Photo de profil">
                <form id="formUploadImage" action="index.php?page=updateUser" method="post" enctype="multipart/form-data" style="display:none;">
                    <input type="file" name="image" id="inputImage" accept="image/*" onchange="document.getElementById('formUploadImage').submit();">
                </form>
                <a href="#" class="modifier-photo" id="modifierPhoto">Modifier</a>
            </div>

            <h2><?= htmlspecialchars($user->getNickname()) ?></h2>

            <p class="membre-depuis">
                Membre depuis <?= $user->getDateCreation() ? $user->getDateCreation()->format('M Y') : 'Inconnue' ?>
            </p>

            <h3>BIBLIOTHÈQUE</h3>

            <p class="nb-livres">
                📚 <?= count($books) ?> livres proposés
            </p>

            <!-- Bouton pour ajouter un livre -->
            <div class="add-book-btn">
                <a href="index.php?page=addBook" class="btn-ajouter">Ajouter un livre</a>
            </div>

        </div>

        <!-- INFORMATIONS PERSONNELLES -->
        <div class="infos-section">
            <h4>Informations personnelles</h4>

            <form action="index.php?page=updateUser" method="post" class="form-infos" enctype="multipart/form-data">
                <label for="nickname">Pseudo</label>
                <input type="text" id="nickname" name="nickname" value="<?= htmlspecialchars($user->getNickname()) ?>" required>

                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="********">

                <button type="submit" class="btn-enregistrer">Enregistrer</button>
            </form>
        </div>

    </div>

    <!-- LISTE DES LIVRES -->
    <div class="liste-livres-section">
        <h4>Mes livres à l’échange</h4>

        <?php if (!empty($books)): ?>
        <table class="livres-table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>Disponibilité</th>
                    <th>Actions</th>
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
                        <?= $book->getIsEnabled() ? "Disponible" : "Non dispo" ?>
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

<script>
    // Clic sur "Modifier" pour déclencher l'input file
    document.getElementById('modifierPhoto').addEventListener('click', function(e){
        e.preventDefault();
        document.getElementById('inputImage').click();
    });
</script>

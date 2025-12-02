<section class="modify-book">

    <!-- Lien retour -->
    <a href="index.php?page=monprofil" class="back-link">← Retour</a>

    <h1 class="page-title">Modifier les informations</h1>

    <div class="modify-container">

        <!-- SECTION PHOTO -->
        <div class="left-section">
            <label class="small-label">Photo</label>

            <div class="book-photo">
                <img src="<?= htmlspecialchars($book->getImage() ?? 'img/defaultbook.png') ?>" 
                        alt="Photo du livre">
            </div>

            <!-- formulaire pour modifier la  photo -->
            <form action="index.php?page=updateBookImage" 
                  method="post" 
                  enctype="multipart/form-data">

                <input type="hidden" name="book_id" value="<?= $book->getBookId() ?>">
            
                <!-- Input file caché -->
                <input type="file" name="image" id="imageUpload" accept="image/*" style="display:none;" required>

                <!-- Label cliquable -->
                <label for="imageUpload" class="custom-upload">Modifier la photo</label>

                <!-- Bouton submit spécifique à ce formulaire -->
                <button type="submit" class="btn-save">Valider la photo</button>

            </form>
        </div>

        <!-- SECTION FORMULAIRE -->
        <div class="right-section">

            <form action="index.php?page=updateBook" method="post" class="modify-form">

                <input type="hidden" name="book_id" value="<?= $book->getBookId() ?>">

                <!-- TITRE -->
                <label for="title" class="small-label">Titre</label>
                <input type="text" 
                    id="title"
                    name="title" 
                    class="input-field"
                    value="<?= htmlspecialchars($book->getTitle()) ?>" 
                    required>

                <!-- AUTEUR -->
                <label for="author" class="small-label">Auteur</label>
                <input type="text" 
                    id="author"
                    name="author"
                    class="input-field"
                    value="<?= htmlspecialchars($book->getAuthor()) ?>" 
                    required>

                <!-- COMMENTAIRES -->
                <label for="content" class="small-label">Commentaires</label>
                <textarea id="content"
                        name="content" 
                        class="input-field textarea-field" 
                        required><?= htmlspecialchars($book->getContent()) ?></textarea>

                <!-- DISPONIBILITÉ -->
                <label for="is_enabled" class="small-label">Disponibilité</label>
                <select id="is_enabled" name="is_enabled" class="input-field">
                    <option value="1" <?= $book->getIsEnabled() ? 'selected' : '' ?>>
                        Disponible
                    </option>
                    <option value="0" <?= !$book->getIsEnabled() ? 'selected' : '' ?>>
                        Non disponible
                    </option>
                </select>

                <button type="submit" class="btn-save">Valider</button>
            </form>

        </div>
    </div>

</section>

<section class="modify-book">

    <!-- Lien retour -->
    <a href="index.php?page=monprofil" class="back-link">← Retour</a>

    <h1 class="page-title">Modifier les informations</h1>

    <div class="modify-container">

        <!-- SECTION PHOTO -->
        <div class="left-section">
            <label class="small-label">Photo</label>

            <div class="book-photo">
                <img src="<?= htmlspecialchars($book->getImage()) ?>" 
                     alt="Photo du livre">
            </div>

            <!-- Upload photo -->
            <form action="index.php?page=updateBookImage" 
                  method="post" 
                  enctype="multipart/form-data">

                <input type="hidden" name="book_id" value="<?= $book->getBookId() ?>">

                <!-- Input file caché -->
                <input type="file" name="image" id="imageUpload" class="upload-input" accept="image/*" style="display:none;">

                <!-- Label cliquable pour l'input file -->
                <label for="imageUpload" class="custom-upload">Modifier la photo</label>

            </form>
        </div>

        <!-- SECTION FORMULAIRE -->
        <div class="right-section">

            <form action="index.php?page=updateBook" method="post" class="modify-form">

                <input type="hidden" name="book_id" value="<?= $book->getBookId() ?>">

                <!-- TITRE -->
                <label class="small-label">Titre</label>
                <input type="text" 
                       name="title" 
                       class="input-field"
                       value="<?= htmlspecialchars($book->getTitle()) ?>" 
                       required>

                <!-- AUTEUR -->
                <label class="small-label">Auteur</label>
                <input type="text" 
                       name="author"
                       class="input-field"
                       value="<?= htmlspecialchars($book->getAuthor()) ?>" 
                       required>

                <!-- COMMENTAIRES -->
                <label class="small-label">Commentaires</label>
                <textarea name="content" 
                          class="input-field textarea-field" 
                          required><?= htmlspecialchars($book->getContent()) ?></textarea>

                <!-- DISPONIBILITÉ -->
                <label class="small-label">Disponibilité</label>
                <select name="is_enabled" class="input-field">
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

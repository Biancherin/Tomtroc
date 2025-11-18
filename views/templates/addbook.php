<section class="modify-book">

    <!-- Lien retour -->
    <a href="index.php?page=monprofil" class="back-link">← Retour</a>

    <h1 class="page-title">Ajouter un Livre</h1>

    <!-- FORMULAIRE UNIQUE -->
    <form action="index.php?page=addBookAction" 
          method="post" 
          enctype="multipart/form-data"
          class="modify-form-full">

        <div class="modify-container">

            <!-- SECTION PHOTO -->
            <div class="left-section">
                <label class="small-label">Photo</label>

                <div class="book-photo">
                    <img src="img/default-book.png" alt="Photo du livre" id="previewImage">
                </div>

                <input type="file" name="image" id="imageUpload" accept="image/*" style="display:none;">
                <label for="imageUpload" class="custom-upload">Ajouter une photo</label>
            </div>

            <!-- SECTION FORMULAIRE -->
            <div class="right-section">

                <label class="small-label">Titre</label>
                <input type="text" name="title" class="input-field" required>

                <label class="small-label">Auteur</label>
                <input type="text" name="author" class="input-field" required>

                <label class="small-label">Commentaires</label>
                <textarea name="content" class="input-field textarea-field" required></textarea>

                <label class="small-label">Disponibilité</label>
                <select name="is_enabled" class="input-field">
                    <option value="1" selected>Disponible</option>
                    <option value="0">Non disponible</option>
                </select>

                <button type="submit" class="btn-save">Ajouter le livre</button>
            </div>

        </div>

    </form>
</section>

<main class="auth-container">
    <div class="auth-left">
        <!-- Colonne gauche : formulaire -->
        <section class="auth-box">
            <h2>Inscription</h2>

            <form method="post" action="index.php?page=registerAction" class="auth-form">
                <label for="nickname">Pseudo</label>
                <input type="text" id="nickname" name="nickname" placeholder="Votre pseudo" required>

                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

                <button type="submit" class="btn-auth">S’inscrire</button>
            </form>

            <p class="auth-footer">
                Déjà inscrit ? <a href="index.php?page=connexion">Connectez-vous</a>
            </p>
        </section>
    </div>
        

    <!-- Partie droite : image -->
    <section class="auth-right">
        <img src="img/connexion.png" alt="Image de connexion" />
    </section>
</main>

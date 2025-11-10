<main class="auth-container">

    <!-- Partie gauche : formulaire -->
    <section class="auth-left">
        <div class="auth-box">
            <h2>Connexion</h2>

            <form method="post" action="index.php?page=loginAction" class="auth-form">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" placeholder="exemple@tomtroc.fr" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

                <button type="submit" class="btn-auth">Se Connecter</button>
            </form>

            <p class="auth-footer">
                Pas de compte ? <a href="index.php?page=inscription">Inscrivez-vous</a>
            </p>
        </div>
    </section>

    <!-- Partie droite : image -->
    <section class="auth-right">
        <img src="img/connexion.png" alt="Image de connexion" />
    </section>

</main>

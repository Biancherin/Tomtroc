<section class="mon-compte">
    <div class="profil">
        <img src="<?= htmlspecialchars($user['image'] ?? 'img/default-user.png') ?>" alt="Photo de profil" class="profil-photo">
        <h2><?= htmlspecialchars($user['nickname']) ?></h2>
        <p>Membre depuis le <?= date('Y', strtotime($user['date_creation'])) ?></p>
        <p><strong><?= count($books) ?></strong> livres</p>
        <a href="index.php?page=message&to=<?= $userId ?>" class="btn">Écrire un message</a>
    </div>

    <div class="livres">
        <table class="livres-table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>" class="book-img"></td>
                        <td><?= htmlspecialchars($book['title']) ?></td>
                        <td><?= htmlspecialchars($book['author']) ?></td>
                        <td><?= htmlspecialchars($book['content']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

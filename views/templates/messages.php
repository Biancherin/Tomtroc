<main class="container messagerie">
    <div class="messagerie-container">

        <!-- 🗂️ Liste des conversations -->
        <aside class="messagerie-sidebar">
            <h2>Messagerie</h2>
            <?php if (!empty($conversations)): ?>
                <ul class="conversation-list">
                    <?php foreach ($conversations as $conv): ?>
                        <li class="<?= ($contact && $contact->getUserTId() === $conv['contact_id']) ? 'active' : '' ?>">
                            <a href="index.php?page=messages&to=<?= $conv['contact_id'] ?>">
                                <img src="<?= htmlspecialchars($conv['image'] ?? 'img/default-user.png') ?>" 
                                     alt="<?= htmlspecialchars($conv['nickname']) ?>" 
                                     class="conv-avatar">
                                <div class="conv-info">
                                    <strong><?= htmlspecialchars($conv['nickname']) ?></strong>
                                    <div class="conv-preview">
                                        <small><?= htmlspecialchars($conv['last_message'] ?? '') ?></small>
                                        <span class="conv-time">
                                            <?= !empty($conv['last_date']) ? (new DateTime($conv['last_date']))->format('H:i') : '' ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucune conversation pour le moment.</p>
            <?php endif; ?>
        </aside>

        <!-- 💬 Fil de discussion -->
        <section class="messagerie-content">
            <?php if ($contact): ?>
                <header class="conv-header">
                    <div class="contact-info">
                        <img src="<?= htmlspecialchars($contact->getImage() ?? 'img/default-user.png') ?>" alt="<?= htmlspecialchars($contact->getNickname()) ?>" class="contact-avatar">
                        <h3><?= htmlspecialchars($contact->getNickname()) ?></h3>
                    </div>
                </header>

                <div class="conv-messages">
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $msg): ?>
                            <?php 
                                $isSender = ($msg->getSenderId() == $currentUser->getUserTId());
                                $userImg = $isSender 
                                    ? ($currentUser->getImage() ?? 'img/default-user.png')
                                    : ($contact->getImage() ?? 'img/default-user.png');
                            ?>
                            <div class="message <?= $isSender ? 'sent' : 'received' ?>">
                                <img src="<?= htmlspecialchars($userImg) ?>" alt="avatar" class="msg-avatar">
                                
                                 <span class="msg-time">
                                    <?= $msg->getDateMessage() ? $msg->getDateMessage()->format('d.m H:i') : '' ?>
                                </span>
                                <div class="message-content">
                                    <p><?= nl2br(htmlspecialchars($msg->getContent())) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-messages">Aucun message pour le moment.</p>
                    <?php endif; ?>
                </div>

                <!-- 📝 Formulaire d’envoi -->
                <form action="index.php?page=sendMessage" method="POST" class="message-form">
                    <input type="hidden" name="receiver_id" value="<?= $contact->getUserTId() ?>">
                    <input type="hidden" name="book_id" value="<?= $_GET['book_id'] ?? 0 ?>">
                    <textarea name="content" placeholder="Tapez votre message..." required></textarea>
                    <button type="submit" class="btn">Envoyer</button>
                </form>

            <?php else: ?>
                <p>Sélectionnez une conversation pour commencer à discuter.</p>
            <?php endif; ?>
        </section>

    </div>
</main>

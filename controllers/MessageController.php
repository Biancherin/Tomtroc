<?php
class MessageController extends BaseController {
    private UserManager $userManager;
    private LibraryManager $libraryManager;

    public function __construct(PDO $dbConnection) {
        $this->messageManager = new MessageManager($dbConnection);
        $this->userManager = new UserManager($dbConnection);
        $this->libraryManager = new LibraryManager($dbConnection);
    }

    /**
     * 🔹 Affiche la messagerie
     */
    public function showMessages(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=connexion');
            exit;
        }

        /** @var User $currentUser */
        $currentUser = $_SESSION['user'];
        $currentUserId = $currentUser->getUserTId();

        // On récupère l'ID du contact depuis l'URL
        $contactId = isset($_GET['to']) ? intval($_GET['to']) : null;

        // Récupération des conversations de l'utilisateur connecté
        $conversations = $this->messageManager->getUserConversations($currentUserId);

        $messages = [];
        $contact = null;

        if ($contactId) {
            // Récupère le fil de discussion avec ce contact
            $messages = $this->messageManager->getConversation($currentUserId, $contactId);

            // Récupère les infos du contact (objet User)
            $contact = $this->userManager->getUserById($contactId);
        }
            // Marquer reçus comme lus
            foreach ($messages as $msg) {
                if ($msg->getReceiverId() === $currentUserId && $msg->getIsRead() == 0) {
                $this->messageManager->markMessageAsRead($msg->getMessageId(), $currentUserId);
            }
        }

            // Mettre à jour le compteur
            $this->unreadCount = $this->messageManager->getUnreadCount($currentUserId);
        
        $unreadCount = $this->unreadCount;

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/messages.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    /**
     * 🔹 Envoie un message
     */
    public function sendMessage(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=connexion');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /** @var User $currentUser */
            $currentUser = $_SESSION['user'];
            $sender_id = $currentUser->getUserTId();
            $nickname = $currentUser->getNickname();

            $receiver_id = intval($_POST['receiver_id'] ?? 0);
            $book_id = intval($_POST['book_id'] ?? 0);
            $content = trim($_POST['content'] ?? '');

            if ($receiver_id && !empty($content)) {
                $this->messageManager->sendMessage($sender_id, $receiver_id, $book_id, $content, $nickname);
            }

            header('Location: index.php?page=messages&to=' . $receiver_id);
            exit;
        }
    }
}

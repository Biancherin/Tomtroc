<?php

class BaseController {
    protected MessageManager $messageManager;
    protected ?User $currentUser = null;
    protected int $unreadCount = 0;

    public function __construct(PDO $dbConnection)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->messageManager = new MessageManager($dbConnection);

        // Gestion utilisateur connecté
        if (isset($_SESSION['user'])) {
            $this->currentUser = $_SESSION['user'];
            $this->unreadCount = $this->messageManager->getUnreadCount(
                $this->currentUser->getUserTId()
            );
        }
    }
}

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

    // Affiche la page d erreur 404
    public function error404() 
   {
    http_response_code(404); // code HTTP 404

    // Inclure les parties du template directement
    require ROOT_PATH . '/Views/templates/header.php';
    require ROOT_PATH . '/Views/templates/404.php';
    require ROOT_PATH . '/Views/templates/footer.php';

    exit; // arrêter l'exécution                                   // stoppe l’exécution
    }

}

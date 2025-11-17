<?php
// Afficher toutes les erreurs PHP pour le debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Charger la config et l'autoload
require_once __DIR__ . '/config/config.php';
require_once ROOT_PATH . '/config/autoload.php';

// Déterminer la page demandée
$page = $_GET['page'] ?? 'home';

// Instancier le controller une seule fois
$libraryController = new LibraryController($dbConnection);
$userController = new UserController($dbConnection);
$messageController = new MessageController($dbConnection);


// Router selon la page
switch ($page) {
    case 'home':
        $libraryController->home();
        break;

    case 'detail':
        if (!isset($_GET['book_id'])) {
            echo "<p>Livre non spécifié.</p>";
            exit;
        }
        $bookId = (int) $_GET['book_id'];
        $libraryController->detail($bookId);
        break;
    
    case 'booklist': 
        $libraryController->booklist();
        break;
    
    case 'connexion':
        $userController->connexion();
    break;

    case 'loginAction':
        $userController->loginAction();
    break;

    case 'inscription':
        $userController->inscription();
    break;

    case 'monprofil':
        $userController->monprofil();
    break;

    case 'moncompte':
        $userController->moncompte();
    break;

    case 'updateUser':   
        $userController->updateProfileAction();
        break;
    
    case 'editBook':
        $bookId = intval($_GET['book_id'] ?? 0);
        $libraryController->editBook($bookId);
    break;

    case 'updateBook':
        $libraryController->updateBook();
    break;

    case 'updateBookImage':
        $libraryController->updateBookImage();
    break;

    case 'messages':
        $messageController->showMessages();
    break;

    case 'messagerie':
        $messageController->showMessages();
    break;

    case 'sendMessage':
        $messageController->sendMessage();
    break;

    default:
        echo "<p>Page non trouvée.</p>";
        break;
}

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
$controller = new LibraryController($dbConnection);

// Router selon la page
switch ($page) {
    case 'home':
        $controller->home();
        break;

    case 'detail':
        if (!isset($_GET['book_id'])) {
            echo "<p>Livre non spécifié.</p>";
            exit;
        }
        $bookId = (int) $_GET['book_id'];
        $controller->detail($bookId);
        break;
    
    case 'booklist': 
        $controller->booklist();
        break;

    default:
        echo "<p>Page non trouvée.</p>";
        break;
}

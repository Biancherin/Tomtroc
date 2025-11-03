<?php
class LibraryController {
    private LibraryManager $manager;

    public function __construct(PDO $dbConnection) {
        $this->manager = new LibraryManager($dbConnection);
    }

    /** ===== PAGE D’ACCUEIL ===== */

    public function home(): void {
        $books = $this->manager->getLastBooks(4);
        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/home.php';
        require ROOT_PATH . '/views/templates/footer.php';
    
    }

     /** ===== PAGE DÉTAIL D’UN LIVRE ===== */

    public function detail(int $bookId): void {
    $book = $this->manager->getBookById($bookId);
    require ROOT_PATH . '/views/templates/header.php';
    require ROOT_PATH . '/views/templates/detailLibrary.php';
    require ROOT_PATH . '/views/templates/footer.php';
    }

        /** ===== NOUVELLE PAGE LISTE DES LIVRES ===== */
    public function booklist(): void {
        // Récupère tous les livres triés par date de création décroissante
        $books = $this->manager->getAllBooksOrderedByDate();

        // Affiche la vue
        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/booklist.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }


}


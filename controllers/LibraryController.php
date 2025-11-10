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

        /** =====  PAGE LISTE DES LIVRES ===== */
    public function booklist(): void {
        // Récupère tous les livres triés par date de création décroissante
        $books = $this->manager->getAllBooksOrderedByDate();

        // Affiche la vue
        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/booklist.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }
    /** =====  AFFICHER MODIFIER UN LIVRE ===== */ 

    public function editBook(int $bookId): void {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $userId = $_SESSION['user']['user_t_id'];

        // Vérifier que le livre appartient à l'utilisateur
        $book = $this->manager->getBookById($bookId);

        if (!$book || $book->getUserId() != $userId) {
            echo "<p>Accès refusé.</p>";
            exit;
        }

        require ROOT_PATH . "/views/templates/header.php";
        require ROOT_PATH . "/views/templates/modifybook.php";
        require ROOT_PATH . "/views/templates/footer.php";
    }
    /** =====  ACTION METTRE A JOUR UN LIVRE ===== */ 
    public function updateBook(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=monprofil");
            exit;
        }

        $userId = $_SESSION['user']['user_t_id'];

        $bookId = intval($_POST["book_id"] ?? 0);
        $title = trim($_POST["title"] ?? "");
        $author = trim($_POST["author"] ?? "");
        $content = trim($_POST["content"] ?? "");
        $isEnabled = intval($_POST["is_enabled"] ?? 1);

        // Vérifier propriété du livre
        $book = $this->manager->getBookById($bookId);

        if (!$book || $book->getUserId() != $userId) {
            echo "<p>Accès refusé.</p>";
            exit;
        }

        // Mise à jour en base
        $this->manager->updateBook($bookId, $title, $author, $content, $isEnabled);

        header("Location: index.php?page=monprofil");
        exit;
    }
     /** =====  ACTION METTRE A JOUR IMAGE LIVRE ===== */ 
     public function updateBookImage(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=monprofil");
            exit;
        }

        $userId = $_SESSION['user']['user_t_id'];
        $bookId = intval($_POST["book_id"] ?? 0);

        $book = $this->manager->getBookById($bookId);

        if (!$book || $book->getUserId() != $userId) {
            echo "<p>Accès refusé.</p>";
            exit;
        }

        // Upload image
        if (!empty($_FILES["image"]["name"])) {

            $file = $_FILES["image"];
            $uploadDir = ROOT_PATH . "/public/uploads/books/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            $newFileName = "book_" . $bookId . "_" . time() . "." . $extension;
            $uploadPath = $uploadDir . $newFileName;

            move_uploaded_file($file["tmp_name"], $uploadPath);

            $imagePathSQL = "uploads/books/" . $newFileName;

            $this->manager->updateBookImage($bookId, $imagePathSQL);
        }

        header("Location: index.php?page=editBook&book_id=" . $bookId);
        exit;
    }
}


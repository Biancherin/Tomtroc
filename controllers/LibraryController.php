<?php
class LibraryController extends BaseController {
    private LibraryManager $manager;
    private string $defaultBookImage = "img/defaultbook.png"; // ← image par défaut


    public function __construct(PDO $dbConnection) {
        parent::__construct($dbConnection);
        $this->manager = new LibraryManager($dbConnection);
    }

    /** ===== PAGE D’ACCUEIL ===== */
    public function home(): void {
        $books = $this->manager->getLastBooks(4);
        $unreadCount = $this->unreadCount;

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/home.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    /** ===== PAGE DÉTAIL D’UN LIVRE ===== */
    public function detail(int $bookId): void {
        $book = $this->manager->getBookById($bookId);
        $unreadCount = $this->unreadCount;

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/detailLibrary.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    /** ===== PAGE LISTE DES LIVRES ===== */
    public function booklist(): void {
        $search = isset($_GET['q']) ? trim($_GET['q']) : '';

        if ($search !== '') {
            $books = $this->manager->searchBooks($search);} else {
            $books = $this->manager->getAllBooksOrderedByDate();
        }
        $unreadCount = $this->unreadCount;

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/booklist.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    /** ===== AJOUTER UN LIVRE ===== */
    public function addBook(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $unreadCount = $this->unreadCount;

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/addbook.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    /** ===== ACTION ENVOYER UN NOUVEAU LIVRE ===== */
    public function saveBook(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=monprofil");
            exit;
        }

        /** @var User $user */
        $user = $_SESSION['user'];
        $userId = $user->getUserTId();

        $title = trim($_POST['title'] ?? '');
        $author = trim($_POST['author'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $isEnabled = intval($_POST['is_enabled'] ?? 1);

        /* ==== IMAGE ==== */
        $imagePath = $this->defaultBookImage; // image par défaut

        if ($title && $author) {
            $this->manager->addBook([
                'user_t_id'  => $userId,
                'title'      => $title,
                'author'     => $author,
                'content'    => $content,
                'image'      => $imagePath,
                'is_enabled' => $isEnabled
            ]);

            header("Location: index.php?page=monprofil");
            exit;
        } else {
            echo "<p>Veuillez remplir le titre et l'auteur.</p>";
        }
    }

    /** ===== AFFICHER MODIFIER UN LIVRE ===== */
    public function editBook(int $bookId): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        /** @var User $user */
        $user = $_SESSION['user'];
        $userId = $user->getUserTId();

        $book = $this->manager->getBookById($bookId);

        if (!$book || $book->getUserTId() !== $userId) {
            echo "<p>Accès refusé.</p>";
            exit;
        }
        $unreadCount = $this->unreadCount;

        require ROOT_PATH . "/views/templates/header.php";
        require ROOT_PATH . "/views/templates/modifybook.php";
        require ROOT_PATH . "/views/templates/footer.php";
    }

    /** ===== ACTION METTRE À JOUR UN LIVRE ===== */
    public function updateBook(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=monprofil");
            exit;
        }

        /** @var User $user */
        $user = $_SESSION['user'];
        $userId = $user->getUserTId();

        $bookId = intval($_POST["book_id"] ?? 0);
        $title = trim($_POST["title"] ?? "");
        $author = trim($_POST["author"] ?? "");
        $content = trim($_POST["content"] ?? "");
        $isEnabled = intval($_POST["is_enabled"] ?? 1);

        $book = $this->manager->getBookById($bookId);

        if (!$book || $book->getUserTId() !== $userId) {
            echo "<p>Accès refusé.</p>";
            exit;
        }

        $this->manager->updateBook($bookId, $title, $author, $content, $isEnabled);
        header("Location: index.php?page=monprofil");
        exit;
    }

    /** ===== ACTION METTRE À JOUR IMAGE LIVRE ===== */
    public function updateBookImage(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=monprofil");
            exit;
        }

        /** @var User $user */
        $user = $_SESSION['user'];
        $userId = $user->getUserTId();

        $bookId = intval($_POST["book_id"] ?? 0);
        $book = $this->manager->getBookById($bookId);

        if (!$book || $book->getUserTId() !== $userId) {
            echo "<p>Accès refusé.</p>";
            exit;
        }
         /* ==== NOUVELLE IMAGE ==== */
         $imagePath = $this->defaultBookImage; // image par défaut
         

        header("Location: index.php?page=editBook&book_id=" . $bookId);
        exit;
    }

    /** ===== SUPPRIMER UN LIVRE ===== */
    public function deleteBook(int $bookId): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=connexion");
        exit;
        }

        /** @var User $user */
        $user = $_SESSION['user'];
        $userId = $user->getUserTId();

        $book = $this->manager->getBookById($bookId);

        // Vérifie que le livre existe et appartient à l'utilisateur
        if (!$book || $book->getUserTId() !== $userId) {
            echo "<p>Accès refusé ou livre introuvable.</p>";
            exit;
        }

    // Supprime le livre dans la base de données
        $this->manager->deleteBook($bookId);

    // Redirection vers le profil
        header("Location: index.php?page=monprofil");
    exit;
    }
}



<?php
class UserController extends BaseController {
    private UserManager $manager;
    private LibraryManager $libraryManager;

    public function __construct(PDO $dbConnection) {
        $this->manager = new UserManager($dbConnection);
        $this->libraryManager = new LibraryManager($dbConnection);
    }

    // ------------------- Helpers -------------------
    private function ensureUserSession(): ?User {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $user = $_SESSION['user'] ?? null;

        if (!($user instanceof User)) {
            $userId = is_array($user) ? ($user['user_t_id'] ?? 0) : 0;
            $user = $this->manager->getUserById($userId);
            $_SESSION['user'] = $user;
        }

        return $user instanceof User ? $user : null;
    }

    // ------------------- Pages -------------------
    public function inscription(): void {
        $unreadCount = $this->unreadCount;

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/inscription.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    public function connexion(): void {
        $unreadCount = $this->unreadCount;

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/connexion.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    public function monprofil(): void {
        $user = $this->ensureUserSession();
        if (!$user) {
            header('Location: index.php?page=connexion');
            exit;
        }

        $books = $this->libraryManager->getBooksByUser($user->getUserTId());
        $unreadCount = $this->unreadCount;

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/monprofil.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    public function moncompte(): void {
        $userId = intval($_GET['user_id'] ?? 0);
        $user = $this->manager->getUserById($userId);

        if (!$user) {
            echo "<p>Utilisateur introuvable.</p>";
            exit;
        }

        $books = $this->libraryManager->getBooksByUser($userId);
        $unreadCount = $this->unreadCount;

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/moncompte.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    // ------------------- Actions -------------------
    public function registerAction(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $nickname = trim($_POST['nickname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($nickname && $email && $password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $this->manager->addUser($nickname, $email, $hash);
            header('Location: index.php?page=connexion');
            exit;
        } else {
            echo "<p>Veuillez remplir tous les champs.</p>";
        }
    }

    public function loginAction(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->manager->getUserByEmail($email);

        if ($user instanceof User && password_verify($password, $user->getPassword())) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['user'] = $user;
            header('Location: index.php?page=monprofil');
            exit;
        } else {
            echo "<p>Email ou mot de passe incorrect.</p>";
        }
    }

    public function updateProfileAction(): void {
        $user = $this->ensureUserSession();
        if (!$user) {
            header('Location: index.php?page=connexion');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nickname = trim($_POST['nickname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $imagePath = null;

            if (!empty($_FILES['image']['name'])) {
                $uploadDir = ROOT_PATH . '/public/uploads/profiles/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                $filename = uniqid() . '_' . basename($_FILES['image']['name']);
                $targetFile = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = 'uploads/profiles/' . $filename;
                }
            }

            if ($nickname && $email) {
                $hash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;
                $this->manager->updateUser($user->getUserTId(), $nickname, $email, $hash, $imagePath);

                $updatedUser = $this->manager->getUserById($user->getUserTId());
                $_SESSION['user'] = $updatedUser;

                header('Location: index.php?page=monprofil');
                exit;
            } else {
                echo "<p>Veuillez remplir le pseudo et l'email.</p>";
            }
        }
    }

    public function deleteBookAction(): void {
        $user = $this->ensureUserSession();
        if (!$user) {
            header('Location: index.php?page=connexion');
            exit;
        }

        $bookId = intval($_GET['book_id'] ?? 0);
        if ($bookId > 0) $this->libraryManager->deleteBook($bookId);

        header('Location: index.php?page=monprofil');
        exit;
    }
}

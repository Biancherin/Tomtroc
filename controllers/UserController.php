<?php
class UserController {
    private UserManager $manager;
    private LibraryManager $libraryManager;

    public function __construct(PDO $dbConnection) {
        $this->manager = new UserManager($dbConnection);
        $this->libraryManager = new LibraryManager($dbConnection);
    }

    // Page d'inscription
    public function inscription(): void {
        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/inscription.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    // Action d'inscription
    public function registerAction(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    }

    // Page de connexion
    public function connexion(): void {
        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/connexion.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    // Action de connexion
    public function loginAction(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->manager->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user'] = $user;
                header('Location: index.php?page=monprofil');
                exit;
            } else {
                echo "<p>Email ou mot de passe incorrect.</p>";
            }
        }
    }

    // Page Mon Profil
    public function monprofil(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=connexion');
            exit;
        }

        $userId = $_SESSION['user']['user_t_id'];
        $user = $this->manager->getUserById($userId);
        $books = $this->libraryManager->getBooksByUser($userId);

        require ROOT_PATH . '/views/templates/header.php';
        require ROOT_PATH . '/views/templates/monprofil.php';
        require ROOT_PATH . '/views/templates/footer.php';
    }

    // Action pour mettre à jour les infos utilisateur (pseudo, email, mot de passe, photo)
    public function updateProfileAction(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=monprofil');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['user_t_id'];
            $nickname = trim($_POST['nickname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $imagePath = null;

            // Gérer l'upload de la photo si un fichier est sélectionné
            if (!empty($_FILES['image']['name'])) {
                $uploadDir = ROOT_PATH . '/uploads/profiles/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $filename = uniqid() . '_' . basename($_FILES['image']['name']);
                $targetFile = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = 'uploads/profiles/' . $filename;
                }
            }

            if ($nickname && $email) {
                $hash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

                $this->manager->updateUser($userId, $nickname, $email, $hash, $imagePath);

                // Mettre à jour la session
                $_SESSION['user'] = $this->manager->getUserById($userId);

                header('Location: index.php?page=monprofil');
                exit;
            } else {
                echo "<p>Veuillez remplir le pseudo et l'email.</p>";
            }
        }
    }

    // Action pour supprimer un livre
    public function deleteBookAction(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=connexion');
            exit;
        }

        $bookId = intval($_GET['book_id'] ?? 0);
        if ($bookId > 0) {
            $this->libraryManager->deleteBook($bookId);
        }

        header('Location: index.php?page=monprofil');
        exit;
    }
}

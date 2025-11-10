<?php
// seed_users.php
// Script : insère 15 utilisateurs et hache leurs mots de passe.
// Usage CLI: php seed_users.php
// Attention : adapter la connexion PDO ci-dessous à ton environnement.

$dsn = 'mysql:host=localhost;dbname=tomtroc;charset=utf8mb4';
$dbUser = 'root';
$dbPass = ''; // adapte si nécessaire

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    echo "Erreur connexion : " . $e->getMessage() . PHP_EOL;
    exit(1);
}

// Définis ici 15 utilisateurs (nickname, email, mot de passe en clair)
$users = [
    ['nickname'=>'CamilleClubLit','email'=>'camille@gmail.com','password'=>'Passw0rd9!'],
    ['nickname'=>'Alexlecture','email'=>'alex@gamil.com','password'=>'Password2!'],
    ['nickname'=>'Hugo_1990_12','email'=>'hugo@gmail.com','password'=>'Secret3@'],
    ['nickname'=>'nathalire','email'=>'nathalire@gmail.com','password'=>'MonPass4#'],
    ['nickname'=>'juju1432','email'=>'julie@gmail.com','password'=>'Qwerty5$'],
    ['nickname'=>'christiane75014','email'=>'christiane@gmail.com','password'=>'Fiona6%'],
    ['nickname'=>'Hamazalecture','email'=>'hamza@gmail.com','password'=>'GeoPass7&'],
    ['nickname'=>'Lou&Ben50','email'=>'lou@gmail.com','password'=>'Lou8*'],
    ['nickname'=>'ivan','email'=>'ivan@gmail.com','password'=>'IvanPass9('],
    ['nickname'=>'julie','email'=>'julie@gmail.com','password'=>'Julie10)'],
    ['nickname'=>'kevin','email'=>'kevin@gmail.com','password'=>'Kevin11!'],
    ['nickname'=>'laura','email'=>'laura@gmail.com','password'=>'Laura12@'],
    ['nickname'=>'marc','email'=>'marc@gmail.com','password'=>'Marc13#'],
    ['nickname'=>'nadia','email'=>'nadia@gmail.com','password'=>'Nadia14$'],
    ['nickname'=>'olivier','email'=>'olivier@gmail.com','password'=>'Olivier15%'],
];

// Prépare l'insert
$sql = "INSERT INTO user_t (nickname, email, password, image) VALUES (:nickname, :email, :password, :image)";
$stmt = $pdo->prepare($sql);

// image par défaut (modifie la valeur si tu veux)
$defaultImage = 'img/default-user.png';

$inserted = 0;
foreach ($users as $u) {
    $hash = password_hash($u['password'], PASSWORD_DEFAULT);
    try {
        $stmt->execute([
            ':nickname' => $u['nickname'],
            ':email'    => $u['email'],
            ':password' => $hash,
            ':image'    => $defaultImage,
        ]);
        $inserted++;
        echo "Inséré : {$u['nickname']} ({$u['email']})" . PHP_EOL;
    } catch (PDOException $ex) {
        // si email déjà présent, on affiche l'erreur et on continue
        echo "Erreur insertion {$u['email']}: " . $ex->getMessage() . PHP_EOL;
    }
}

echo "Total insérés : $inserted" . PHP_EOL;

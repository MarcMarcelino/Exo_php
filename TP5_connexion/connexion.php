<?php
require_once "config.php";
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: connexion.php");
    exit();
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: protected.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $validUsername = 'admin';
    $validPassword = 'password123';

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['loggedin'] = true;
        header("Location: protected.php");
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<form action="" method="post">
    <label>Nom d'utilisateur :</label>
    <input type="text" name="username"><br><br>

    <label>Mot de passe :</label>
    <input type="password" name="password"><br><br>

    <button type="submit">Se connecter</button>
</form>

<?php if (!empty($error)) : ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

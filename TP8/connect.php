<?php
require_once "config.php";
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: connect.php");
    exit();
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: submit_inscription.php");
    exit();
}
$inscription_msg = "";
$connexion_msg = "";
$errors_inscription = [];
$errors_connexion = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['form_type']) && $_POST['form_type'] === 'inscription') {

        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($nom === '') $errors_inscription[] = 'Le nom est requis.';
        if ($prenom === '') $errors_inscription[] = 'Le prénom est requis.';
        if ($password === '') $errors_inscription[] = 'Le mot de passe est requis.';

        if (empty($errors_inscription)) {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sth = $mysqlClient->prepare(
                'INSERT INTO users (nom, prenom, password) VALUES (:nom, :prenom, :password)'
            );
            $sth->execute([
                ':nom'      => $nom,
                ':prenom'   => $prenom,
                ':password' => $hash
            ]);

            $inscription_msg = "Inscription réussie pour l'utilisateur : " . htmlspecialchars($nom);
        }

    }
    elseif (isset($_POST['form_type']) && $_POST['form_type'] === 'connexion') {

        $nom = trim($_POST['nom'] ?? '');
        $password = trim($_POST['password'] ?? '');
        if ($nom === '') $errors_connexion[] = 'Le nom est requis.';
        if ($password === '') $errors_connexion[] = 'Le mot de passe est requis.';
        $stmt = $mysqlClient->prepare('SELECT * FROM users WHERE nom = :nom');
        $stmt->execute([':nom' => $nom]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['loggedin'] = true;
            $_SESSION['Username'] = $nom;

            header("Location: submit_inscription.php");
            exit();

        } else {
            $errors_connexion[] = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Projet Inscription / Connexion</title>
    <style>
        form {
            border: 1px solid black;
            width: 300px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<h1>Inscription</h1>
<?php if (!empty($inscription_msg)) echo "<p class='success'>$inscription_msg</p>"; ?>
<?php foreach ($errors_inscription as $error) echo "<p class='error'>$error</p>"; ?>

<form action="" method="post">
    <input type="hidden" name="form_type" value="inscription">
    <label for="nom">Nom d'utilisateur :</label><br>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"><br><br>

    <label for="prenom">Prénom :</label><br>
    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>"><br><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password"><br><br>

    <input type="submit" value="S'inscrire">
</form>

<h1>Connexion</h1>
<?php foreach ($errors_connexion as $error) echo "<p class='error'>$error</p>"; ?>

<form action="" method="post">
    <input type="hidden" name="form_type" value="connexion">
    <label for="nom_connexion">Nom d'utilisateur :</label><br>
    <input type="text" id="nom_connexion" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"><br><br>

    <label for="password_connexion">Mot de passe :</label><br>
    <input type="password" id="password_connexion" name="password"><br><br>

    <input type="submit" value="Se connecter">
</form>

</body>
</html>

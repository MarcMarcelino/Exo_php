<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: connexion.php");
    exit();
}
?>
<?php
echo "Bonjour,  ! Vous avez accès à cette page protégée."; ?>
<form action="connexion.php" method="get" style="display:inline;">
    <button type="submit" name="logout" value="1">Déconnexion</button>
</form>
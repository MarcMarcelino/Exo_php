<?php
require_once "config.php"; // connexion PDO ($mysqlClient)

if ($_SERVER['REQUEST_METHOD'] === 'POST' 
    && isset($_POST['action']) 
    && $_POST['action'] === 'add') {

    // Sécurisation
    $nom    = trim($_POST['nom'] ?? '');
    $pays   = trim($_POST['pays'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $temps  = trim($_POST['temps'] ?? '');

    // Vérifications
    $errors = [];
    if ($nom === '')    $errors[] = 'Le nom est requis.';
    if ($pays === '')   $errors[] = 'Le pays est requis.';
    if ($course === '') $errors[] = 'La course est requise.';
    if ($temps === '')  $errors[] = 'Le temps est requis.';

    if (empty($errors)) {

        $sql = "INSERT INTO `100` (nom, pays, course, temps)
                VALUES (:nom, :pays, :course, :temps)";

        $stmt = $mysqlClient->prepare($sql);

        $ok = $stmt->execute([
            ':nom'    => $nom,
            ':pays'   => $pays,
            ':course' => $course,
            ':temps'  => $temps
        ]);

        if ($ok) {
            header("Location: modif.php");
            exit();
        } else {
            echo "Erreur lors de l'insertion.";
        }
    } 
}
?>

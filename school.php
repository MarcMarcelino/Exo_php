<?php 
function schoollevel(int $age){
    if ($age < 3) {
        return "Crèche";
    } elseif ($age >= 3 && $age <= 6) {
        return "Maternelle";
    } elseif ($age >= 6 && $age <= 11) {
        return "Primaire";
    } elseif ($age >= 11 && $age <= 16) {
        return "Collège";
    } elseif ($age >= 16 && $age <= 18) {
        return "Lycée"; 
    } else {
        return "Hors du système scolaire";
    }
}
echo schoollevel(20); // Affiche 
?>
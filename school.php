<?php 
function schoollevel(int $age): string {
    if ($age < 3) {
        return "Crèche";
    } elseif ($age < 6) {
        return "Maternelle";
    } elseif ($age < 11) {
        return "Primaire";
    } elseif ($age < 16) {
        return "Collège";
    } else {
        return "Not in school age range";
    }
}
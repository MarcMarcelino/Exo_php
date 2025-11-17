<?php
function calculeMoyenne(array $notes): float {
    $somme = array_sum($notes);
    $nombreDeNotes = count($notes);
    return $somme / $nombreDeNotes;
}

echo calculeMoyenne([12, 15, 14, 10, 18]);
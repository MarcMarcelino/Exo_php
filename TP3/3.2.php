<?php 
 $eleves = [
    ["nom" => "Alice", "notes" => [15, 18, 20]],
    ["nom" => "Bob", "notes" => [12, 10, 11]],
    ["nom" => "Claire", "notes" => [18, 17, 16]]
];

function calculer_moyenne($notes) {
    $somme = array_sum($notes);
    $nombre_notes = count($notes);
    $moy = $somme / $nombre_notes;
    return $nombre_notes > 0 ? $moy : 0;
}

foreach ($eleves as $eleve) {
    $moyenne = calculer_moyenne($eleve["notes"]);
    echo "La moyenne de " . $eleve["nom"] . " est de " . $moyenne . "<br>";
}
?>

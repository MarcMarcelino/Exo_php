<?php
$filename = "contact.txt";
if (!file_exists($filename)) {
    file_put_contents($filename, "");
    echo "Le fichier vient d'être créé.<br>";
} else {
    echo "Le fichier existe déjà.<br>";
}
$contenue = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$contenue[] = "Mathieu LOUVEL";
$contenue[] = "Alice DUPONT";
$contenue[] = "John Doe";
$contenue[] = "Jean Martin";

$contenue_sans_doublon = array_unique($contenue);

file_put_contents($filename, implode("\n", $contenue_sans_doublon) . "\n");

$contenu = file_get_contents($filename);
echo $contenu;
echo "<br>";
?> 
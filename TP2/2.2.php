<?php

function reverseString($word) {
    $reversed = "";
    $length = strlen($word);
    for ($i = $length - 1; $i >= 0; $i--) {
        $reversed .= $word[$i];
    }
    return $reversed;
}
echo reverseString("Bonjour");  
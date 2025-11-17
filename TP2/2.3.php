<?php
function my_str_contains($phrase, $mot) {
    if ($mot === "") {
        return true; 
    }
    
    $h = str_split($phrase); 
    $n = str_split($mot);

    $hLen = count($h);
    $nLen = count($n);

    if ($nLen > $hLen) {
        return false;
    }

    for ($i = 0; $i <= $hLen - $nLen; $i++) {

        $match = true;

        for ($j = 0; $j < $nLen; $j++) {
            if (!isset($h[$i + $j]) || $h[$i + $j] !== $n[$j]) {
                $match = false;
                break;
            }
        }
        if ($match) {
            return true; 
        }
    }

    return false;
}

echo my_str_contains("Bonjour le monde", "jour");
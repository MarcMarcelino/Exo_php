<?php 
for ($i=0; $i<100; $i++){
    if ($i % 3 == 0){
        echo $i . " Foo"; 
    } elseif ($i % 5 == 0){
        echo $i . " Bar";
    } elseif ($i % 3 == 0 && $i % 5 == 0){
        echo $i . " FooBar";
    }
}
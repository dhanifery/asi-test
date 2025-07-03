<?php
for ($i = 0; $i < 7; $i++) {
    for ($j = 0; $j < 7; $j++) {
        // cek jika nilai i samadengan j atau i + j samadengan 7 - 1 maka tampilkan X  
        if ($i == $j or $i + $j ==  7 - 1) {
            echo "X ";
        } else {
            echo "O ";
        }
    }
    echo "\n";
}

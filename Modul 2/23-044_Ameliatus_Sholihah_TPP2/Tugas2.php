<?php
// Array mata kuliah
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

// Perulangan foreach dengan parameter alias
foreach ($matkul as $mk) {
    switch ($mk) {
        case "PTI":
            echo "Saya suka $mk<br>";
            break;
        case "ALPRO":
            echo "Saya suka $mk<br>";
            break;
        case "DPW":
            echo "Saya suka $mk<br>";
            break;
        case "STRUKDAT":
            echo "Saya suka $mk<br>";
            break;
        case "JARKOM":
            echo "Saya suka $mk<br>";
            break;
        case "PAW":
            echo "Saya suka $mk<br>";
            break;
        default:
            echo "Saya tidak mengambil matkul $mk<br>";
            break;
    }
}
?>

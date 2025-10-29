<?php 
function validateName($field_list, $field_name, &$errors)
{

    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = 'Field tidak ditemukan.';
        return false;
    }

    $value = trim($field_list[$field_name]);


    if ($value === '') {
        $errors[$field_name] = 'Nama tidak boleh kosong.';
        return false;
    }


    $pattern = "/^[a-zA-Z'-]+$/";

    if (!preg_match($pattern, $value)) {
        $errors[$field_name] = 'Nama hanya boleh berisi huruf (A–Z), tanda (-), atau (\').';
        return false;
    }


    return true;
}

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (validateName($_POST, 'AMELIA', $errors)) {
        echo "<h3 style='color:green;'>Data OK!</h3>";
        echo "<p>Nama: " . htmlspecialchars($_POST['AMELIA']) . "</p>";
    } else {
        echo "<h3 style='color:red;'>Data invalid!</h3>";
        echo "<p><strong>Error:</strong> " . $errors['AMELIA'] . "</p>";
    }
}
?>

<!-- ==========================
     FORM INPUT
=========================== -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Server-side Sederhana</title>
</head>
<body>
    <h2>Form Input Surname</h2>
    <form method="post" action="">
        <label for="surname">Masukkan Surname:</label><br>
        <input type="text" name="AMELIA" id="230411100044" required>
        <br><br>
        <input type="submit" value="Kirim">
    </form>
</body>
</html>

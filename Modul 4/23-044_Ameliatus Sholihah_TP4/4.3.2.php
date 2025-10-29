<?php

$errors = [];
$surname = "";


function validateName($field_value, &$errors)
{
    if (empty($field_value)) {
        $errors['surname'] = "Field surname tidak boleh kosong.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/"; 
    if (!preg_match($pattern, $field_value)) {
        $errors['surname'] = "Nama hanya boleh berisi huruf (A–Z), tanda (-), atau (').";
        return false;
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = trim($_POST['surname']);

    if (validateName($surname, $errors)) {
        $success_message = "Data berhasil diproses!<br>Nama: " . htmlspecialchars($surname);
    }
}
?>

<!-- ==========================
     TAMPILAN FORM
=========================== -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Server-side Self-Submission</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .error { color: red; }
        .success { color: green; }
        form { margin-top: 20px; }
        input[type="text"] { padding: 8px; width: 250px; }
        input[type="submit"] { padding: 8px 14px; margin-top: 10px; }
    </style>
</head>
<body>

    <h2>Validasi Server-side (Self-Submission)</h2>

    <?php
    if (!empty($success_message)) {
        echo "<p class='success'>$success_message</p>";
        echo "<p><a href='".$_SERVER['PHP_SELF']."'>Isi ulang form</a></p>";
    } else {
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="surname">Masukkan Surname:</label><br>
            <input type="text" name="surname" id="surname"
                   value="<?php echo htmlspecialchars($surname); ?>" required>
            <br>

            <?php
            
            if (isset($errors['surname'])) {
                echo "<p class='error'>" . $errors['surname'] . "</p>";
            }
            ?>

            <input type="submit" value="Kirim">
        </form>

        <?php
    }
    ?>

</body>
</html>

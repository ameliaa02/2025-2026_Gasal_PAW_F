<?php

$errors = [];
$success_message = "";
$name = $email = $age = $website = $ip = $date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = trim($_POST['age']);
    $website = trim($_POST['website']);
    $ip = trim($_POST['ip']);
    $date = trim($_POST['date']); 

    if (!preg_match("/^[a-zA-Z\s'-]+$/", $name)) {
        $errors['name'] = "Nama hanya boleh berisi huruf dan spasi.";
    } else {

        $name = ucwords(strtolower($name));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid.";
    }

    if (!filter_var($website, FILTER_VALIDATE_URL)) {
        $errors['website'] = "URL website tidak valid.";
    }

    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        $errors['ip'] = "Alamat IP tidak valid.";
    }

    if (!is_numeric($age)) {
        $errors['age'] = "Umur harus berupa angka.";
    } elseif ($age < 0 || $age > 120) {
        $errors['age'] = "Umur tidak masuk akal.";
    }

    if (!empty($date)) {
        $parts = explode('-', $date);
            if (!checkdate($parts[1], $parts[2], $parts[0])) {
                $errors['date'] = "Tanggal tidak valid.";
            }
        } else {
            $errors['date'] = "Format tanggal salah (gunakan YYYY-MM-DD).";
        }
    } else {
        $errors['date'] = "Tanggal tidak boleh kosong.";
    }

    if (empty($errors)) {
        $success_message = "
        <h3 style='color:green;'>Data Berhasil Divalidasi!</h3>
        <p><strong>Nama:</strong> $name<br>
        <strong>Email:</strong> $email<br>
        <strong>Usia:</strong> $age<br>
        <strong>Website:</strong> $website<br>
        <strong>IP Address:</strong> $ip<br>
        <strong>Tanggal:</strong> $date</p>";
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Server-side Lanjutan</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        input, textarea { width: 300px; padding: 8px; margin-top: 5px; }
        label { font-weight: bold; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h2>Form Validasi Server-side (Eksplorasi Lanjutan)</h2>

    <?php
    if (!empty($success_message)) {
        echo "<div class='success'>$success_message</div>";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Isi Form Lagi</a>";
    } else {
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label>Nama:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <?php if(isset($errors['name'])) echo "<p class='error'>{$errors['name']}</p>"; ?><br>

        <label>Email:</label><br>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <?php if(isset($errors['email'])) echo "<p class='error'>{$errors['email']}</p>"; ?><br>

        <label>Usia:</label><br>
        <input type="text" name="age" value="<?php echo htmlspecialchars($age); ?>">
        <?php if(isset($errors['age'])) echo "<p class='error'>{$errors['age']}</p>"; ?><br>

        <label>Website:</label><br>
        <input type="text" name="website" value="<?php echo htmlspecialchars($website); ?>">
        <?php if(isset($errors['website'])) echo "<p class='error'>{$errors['website']}</p>"; ?><br>

        <label>Alamat IP:</label><br>
        <input type="text" name="ip" value="<?php echo htmlspecialchars($ip); ?>">
        <?php if(isset($errors['ip'])) echo "<p class='error'>{$errors['ip']}</p>"; ?><br>

        <label>Tanggal (YYYY-MM-DD):</label><br>
        <input type="text" name="date" value="<?php echo htmlspecialchars($date); ?>">
        <?php if(isset($errors['date'])) echo "<p class='error'>{$errors['date']}</p>"; ?><br>

        <input type="submit" value="Validasi">
    </form>

    <?php } ?>
</body>
</html>

<?php include_once('template_atas.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Awal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   <div class="container">
        <?php
            //session_start(); // Mulai atau lanjutkan sesi
            // Periksa apakah pengguna sudah login
            if(!isset($_SESSION["user"])){
                echo "<p>Sesi Sudah Habis! <br> <a href='login.php'>LOGIN LAGI</a></p>";
                exit;
            }
        ?>
        <h1>SELAMAT DATANG</h1>
        <div class="welcome-message">
            <p>USER : <?php echo htmlspecialchars($_SESSION["user"]); ?></p>
            <p>AKSES : <?php echo htmlspecialchars($_SESSION["akses"]); ?></p>
        </div>
        <hr>
    </div>
</body>
</html>

<?php include_once('template_bawah.php'); ?>

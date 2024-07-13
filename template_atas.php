<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pengguna = isset($_SESSION["user"]) ? $_SESSION["user"] : "";
$nama_lengkap = isset($_SESSION["nama_lengkap"]) ? $_SESSION["nama_lengkap"] : "";
$akses = isset($_SESSION["akses"]) ? $_SESSION["akses"] : "casis";

$nama_akses = ($akses == "admin") ? "Petugas" : "Casis";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PSB Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="wrap">
        <div id="header">
            <h1>PSB Online</h1>
            <div id="info_pengguna">
                <?php
                if (!empty($pengguna)) {
                    echo "Sedang Login Sebagai: $pengguna";
                    $tampil_login = "display:none";
                    $tampil_logout = "display:inline";
                } else {
                    echo "Tidak ada pengguna yang login saat ini."; 
                    $tampil_login = "display:inline";
                    $tampil_logout = "display:none";
                }
                ?>
                <br>Tanggal: <?php echo date("d F Y") ?>
            </div>
        </div>
        <div id="tengah" class="container">
            <div id="sidebar">
                <div id="menu">
                    <div id="menu_header">Menu</div>
                    <div id="menu_konten">
                        <ul>
                            <?php if ($akses == "petugas") { ?>
                                <li><a href="setup_sistem.php" class="btn">Setup Sistem</a></li>
                                <li><a href="verifikasi.php" class="btn">Verifikasi</a></li>
                            <?php } ?>
                            <li><a href="info_psb.php" class="btn">Informasi Pendaftaran</a></li>
                            <li><a href="form_daftar.php" class="btn">Pendaftaran</a></li>
                            <li><a href="hasilSeleksiSementara.php" class="btn">Hasil Seleksi Sementara</a></li>
                            <li><a href="logout.php" class="btn">Logout</a></li>
                            <li><a href="login.php" class="btn">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="konten_utama">

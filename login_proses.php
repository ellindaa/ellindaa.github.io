<?php
// Koneksi ke database
require 'koneksi.php'; // Asumsikan bahwa file ini berisi kelas Db

$pdo = Db::bukaKoneksi();

if ($pdo !== null) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Hash password dengan MD5

        // Cek kredensial
        $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = $stmt->fetch();

        if ($user) {
            // Inisialisasi atau lanjutkan sesi
            session_start();

            // Simpan informasi pengguna dalam sesi
            $_SESSION["user"] = $user['username'];
            $_SESSION["nama_lengkap"] = $user['nama_lengkap']; // Jika tersedia dalam tabel user
            $_SESSION["akses"] = $user['akses']; // Pastikan akses diset dengan benar

            // Redirect ke halaman awal setelah login berhasil
            header("Location: halaman_awal.php");
            exit;
        } else {
            // Login gagal
            echo "Username atau password salah!<br>";
        }
    }
} else {
    echo "Gagal membuat Koneksi ke database";
}
?>

<?php
$host = 'localhost';
$dbname = 'psb_online';
$username = 'admin';
$password = 'admin';
$port = '3307';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE calon_siswa SET
            nama = :nama,
            alamat = :alamat,
            jenis_kelamin = :jenis_kelamin,
            tanggal_lahir = :tanggal_lahir,
            agama = :agama,
            asal_sekolah = :asal_sekolah,
            nilai_bahasa_indonesia = :nilai_bahasa_indonesia,
            nilai_ipa = :nilai_ipa,
            nilai_matematika = :nilai_matematika,
            status = :status
            WHERE no_pendaftaran = :no_pendaftaran";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
    $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
    $stmt->bindParam(':agama', $agama);
    $stmt->bindParam(':asal_sekolah', $asal_sekolah);
    $stmt->bindParam(':nilai_bahasa_indonesia', $nilai_bahasa_indonesia);
    $stmt->bindParam(':nilai_ipa', $nilai_ipa);
    $stmt->bindParam(':nilai_matematika', $nilai_matematika);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':no_pendaftaran', $no_pendaftaran);
    $stmt->execute();
    echo "Data calon siswa dengan nomor pendaftaran $no_pendaftaran berhasil diubah.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>

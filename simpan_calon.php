<?php include_once('template_atas.php'); ?>
<?php
include_once 'tahunAjaran.php';
include_once 'koneksi.php';
$tahun_ajaran = ThAjaran::getTa();
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$tgl_lahir = $_POST['tgl_lahir'];
$jenis_kel = $_POST['jenis_kel'];
$asal_sekolah = $_POST['asal_sekolah'];
$agama = $_POST['agama'];
$nilai_ind = $_POST['nilai_ind'];
$nilai_ipa = $_POST['nilai_ipa'];
$nilai_mtk = $_POST['nilai_mtk'];

try {
    // Buat koneksi ke database
    $db = Db::bukaKoneksi();

    // Query SQL untuk insert data
    $sql = "INSERT INTO calon_siswa (tahun_ajaran, nama, alamat, tgl_lahir, jenis_kel, asal_sekolah, agama, nilai_ind, nilai_ipa, nilai_mtk)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Persiapkan statement
    $stmt = $db->prepare($sql);

    // Bind parameter ke statement
    $stmt->execute([$tahun_ajaran, $nama, $alamat, $tgl_lahir, $jenis_kel, $asal_sekolah, $agama, $nilai_ind, $nilai_ipa, $nilai_mtk]);

    // Mendapatkan ID terakhir yang di-insert
    $id = $db->lastInsertId();
    
} catch (PDOException $e) {
    // Tangani kesalahan jika query gagal
    echo "Error: " . $e->getMessage();
    die(); // Hentikan proses jika terjadi kesalahan
}

// Tampilkan hasil pendaftaran
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran Online</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Bukti Pendaftaran Online</h2>
    <table border="1">
        <tr>
            <td align="left">Nomor Pendaftaran </td><td>: <b><?php echo $id; ?></b></td>
        </tr>
        <tr>
            <td>Nama </td><td>: <?php echo htmlspecialchars($nama); ?></td>
        </tr>
        <tr>
            <td>Alamat </td><td>: <?php echo htmlspecialchars($alamat); ?></td>
        </tr>
        <tr>
            <td>Asal Sekolah </td><td>: <?php echo htmlspecialchars($asal_sekolah); ?></td>
        </tr>
    </table>
    <br>
    Silahkan Anda melakukan verifikasi pendaftaran ke panitia penerimaan siswa baru,
    dengan membawa: <br>
    <ol>
        <li>Akta Kelahiran Asli</li>
        <li>Transkrip Nilai</li>
        <li>Ijazah diligalisir</li>
        <li>Berkas dikemas dalam Map warna kuning</li>
    </ol>
</body>
</html>
<?php include_once('template_bawah.php'); ?>

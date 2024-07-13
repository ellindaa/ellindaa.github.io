<?php include_once('template_atas.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>HASIL SELEKSI SEMENTARA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include 'tahunAjaran.php';
include_once 'koneksi.php';

$tahun_ajaran = ThAjaran::getTa();
$daya_tampung = ThAjaran::getDayaTampung();
if (strpos($tahun_ajaran, '-') !== false) {
    list($tahun_awal, $tahun_akhir) = explode('-', $tahun_ajaran);
    $tahun_awal = is_numeric($tahun_awal) ? $tahun_awal : 0;
    $tahun_akhir = is_numeric($tahun_akhir) ? $tahun_akhir : 0;
} else {
    $tahun_awal = is_numeric($tahun_ajaran) ? $tahun_ajaran : 0;
    $tahun_akhir = $tahun_awal + 1; 
}
?>
<center>
    <h2>HASIL SELEKSI SEMENTARA</h2>
    <h3>Tahun Ajaran : <?php echo $tahun_awal . "-" . $tahun_akhir; ?></h3>
</center>
<?php
$db = Db::bukaKoneksi();
$sql = "SELECT
            calon_siswa.no_pendaftaran,
            calon_siswa.nama,
            calon_siswa.alamat,
            calon_siswa.asal_sekolah,
            calon_siswa.nilai_ind,
            calon_siswa.nilai_ipa,
            calon_siswa.nilai_mtk,
            calon_siswa.nilai_ind + calon_siswa.nilai_ipa + calon_siswa.nilai_mtk as jumlah
        FROM
            calon_siswa
        WHERE
            calon_siswa.kode_verifikasi = 1 AND calon_siswa.tahun_ajaran = '$tahun_ajaran'
        ORDER BY
            jumlah DESC
        LIMIT " . $daya_tampung;

$nilai = array();
$i = 0;
?>

<table>
    <tr>
        <th>No</th>
        <th>NP</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Asal Sekolah</th>
        <th>B IND</th>
        <th>IPA</th>
        <th>MTK</th>
        <th>Total</th>
    </tr>
<?php
foreach ($db->query($sql) as $data) {
    $i++;
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data['no_pendaftaran']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['asal_sekolah']; ?></td>
        <td><?php echo $data['nilai_ind']; ?></td>
        <td><?php echo $data['nilai_ipa']; ?></td>
        <td><?php echo $data['nilai_mtk']; ?></td>
        <td><?php echo $data['jumlah']; ?></td>
    </tr>
<?php
    $nilai[] = $data['jumlah'];
}
?>
</table>
<br>
<div class="center">Jumlah Daya Tampung : <?php echo $daya_tampung; ?></div>
<div class="center">Nilai Tertinggi : <?php echo !empty($nilai) ? max($nilai) : 'N/A'; ?></div>
<div class="center">Nilai Terendah : <?php echo !empty($nilai) ? min($nilai) : 'N/A'; ?></div>
<?php 

if (method_exists('ThAjaran', 'getTanggal')) {
    echo '<div class="center">Pendaftaran dibuka ' . ThAjaran::getTanggal() . '</div>';
} else {
    echo '<div class="center">Tanggal pendaftaran tidak tersedia</div>';
}
?>
</body>
</html>

<?php include_once('template_bawah.php'); ?>


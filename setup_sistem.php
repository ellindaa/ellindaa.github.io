<?php include_once('template_atas.php'); ?>
<?php
include 'tahunAjaran.php';
include_once 'koneksi.php';
$db = Db::bukaKoneksi();
$sql = "SELECT * FROM tahun_ajaran";
$result = $db->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Setup Sistem Penerimaan Siswa Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="wrap">
    <div id="header">
        <h1>SETUP SISTEM PENERIMAAN SISWA BARU</h1>
        <a href="tambah_rekaman.php">Tambah Rekaman</a>
        </div>
    <table border="1">
        <tr>
            <th>No</th>
            <th>TAHUN AJARAN</th>
            <th>TANGGAL AWAL</th>
            <th>TANGGAL AKHIR</th>
            <th>DAYA TAMPUNG</th>
            <th>STATUS</th>
            <th class="aksi">AKSI</th>
        </tr>
        <?php
        $i = 1;
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row['tahun_ajaran'] . "</td>";
            echo "<td>" . $row['tgl_awal_pendaf'] . "</td>";
            echo "<td>" . $row['tgl_akhir_pendaf'] . "</td>";
            echo "<td>" . $row['daya_tampung'] . "</td>";
            echo "<td>" . $row['active'] . "</td>";
            echo "<td class='aksi'><a href='ubah.php?tahun_ajaran="
             . $row['tahun_ajaran'] . "'>Ubah</a> | <a href='hapus.php?tahun_ajaran="
              . $row['tahun_ajaran'] . "'>Hapus</a></td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </table>
</div>
</body>
</html>
<?php include_once('template_bawah.php'); ?>



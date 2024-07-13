<?php include_once('template_atas.php'); ?>
<?php
include 'tahunAjaran.php';
include_once 'koneksi.php';

$tahun_ajaran = ThAjaran::getTa();
if ($tahun_ajaran && strpos($tahun_ajaran, '/') !== false) {
    list($tahun_awal, $tahun_akhir) = explode('/', $tahun_ajaran);
    $tahun_awal = is_numeric($tahun_awal) ? $tahun_awal : 0;
    $tahun_akhir = is_numeric($tahun_akhir) ? $tahun_akhir : 0;
} else {
    $tahun_awal = 2024;
    $tahun_akhir = 2025;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabel Verifikasi Data Pendaftaran</title>
</head>
<body>
    <center>
        <h3>TABEL VERIFIKASI DATA PENDAFTARAN</h3>
        <h4>Tahun Ajaran: <?php echo $tahun_awal . "/" . $tahun_akhir; ?></h4>
    </center>

    <?php
    $db = Db::bukaKoneksi();
    $sql = "SELECT 
                no_pendaftaran, 
                nama, 
                alamat, 
                asal_sekolah, 
                nilai_ind, 
                nilai_ipa, 
                nilai_mtk, 
                kode_verifikasi, 
                nilai_ind + nilai_ipa + nilai_mtk as jumlah 
            FROM 
                calon_siswa 
            WHERE 
                tahun_ajaran = '$tahun_ajaran' 
            ORDER BY 
                no_pendaftaran";

    $result = $db->query($sql);
    ?>

    <table>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">NP</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Asal Sekolah</th>
            <th style="text-align: center;" colspan="4">Nilai</th>
            <th rowspan="2">Verifikasi</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr style="height: 18px;">
            <th style="width: 10%; height: 18px;">Indonesia</th>
            <th style="width: 10%; height: 18px;">IPA</th>
            <th style="width: 10%; height: 18px;">Matematika</th>
            <th style="width: 10%; height: 18px;">Total</th>
        </tr>

        <?php
        $i = 0;
        while ($data = $result->fetch()) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['no_pendaftaran']; ?></td>
                <td style="width: 20%"><?php echo $data['nama']; ?></td>
                <td style="width: 15%"><?php echo $data['asal_sekolah']; ?></td>
                <td><?php echo $data['nilai_ind']; ?></td>
                <td><?php echo $data['nilai_ipa']; ?></td>
                <td><?php echo $data['nilai_mtk']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
                <td style="text-align: center;"><?php echo $data['kode_verifikasi']; ?></td>
                <td><a href="edit.php?no_pendaftaran=<?php echo $data['no_pendaftaran'];?>" target="content">Ubah | </a> 
                    <a href="hapus.php?no_pendaftaran=<?php echo $data['no_pendaftaran'];?>" target="content">Hapus</a> 
                </td>
            </tr>
        <?php
        }
        ?>
    </table>

    <br>
    <h3>Petugas Telah memeriksa dengan benar:</h3>
    <ol>
        <li>Tanda bukti nomor pendaftaran dari sistem.</li>
        <li>Calon menyerahkan berkas akta kelahiran asli,</li>
        <li>Transkrip Nilai Akhir</li>
        <li>Ijazah dilegalisir,</li>
        <li>Menstatus Verifikasi, calon akan tampil seleksi sementara</li>
    </ol>
</body>
</html>
<?php include_once('template_bawah.php'); ?>

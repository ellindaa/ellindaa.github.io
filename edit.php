<?php include_once('template_atas.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Siswa Baru Online</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
include 'tahunAjaran.php';
$dba = Db::bukaKoneksi();
$no_pendaftaran = isset($_GET['no_pendaftaran']) ? $_GET['no_pendaftaran'] : null;
if ($no_pendaftaran) {
    $sql = "SELECT * FROM calon_siswa WHERE no_pendaftaran=:no_pendaftaran";
    $stmt = $dba->prepare($sql);
    $stmt->execute(['no_pendaftaran' => $no_pendaftaran]);
    $dataSiswa = $stmt->fetch();
} else {
    echo "No pendaftaran tidak ditemukan.";
    exit; 
}
?>
<h3>Formulir Verifikasi Pendaftaran Tahun Ajaran : <?php echo intval(ThAjaran::getTa()) . "/" . (intval(ThAjaran::getTa()) + 1); ?></h3>
<form action="ubah_calon.php" method="post">
    <input type="hidden" name="no_pendaftaran" value="<?php echo $dataSiswa['no_pendaftaran'];?>">
    <table>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" value="<?php echo $dataSiswa['nama'];?>"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat" value="<?php echo $dataSiswa['alamat'];?>"></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>
                <select name="jenis_kel">
                    <option value="">---------pilih--------</option>
                    <option value="L" <?php echo $dataSiswa['jenis_kel'] == 'L' ? 'selected' : '';?>>Laki-laki</option>
                    <option value="P" <?php echo $dataSiswa['jenis_kel'] == 'P' ? 'selected' : '';?>>Perempuan</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td><input type="date" name="tgl_lahir" value="<?php echo $dataSiswa['tgl_lahir'];?>"></td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>
                <select name="agama">
                    <option value="">---------pilih--------</option>
                    <option value="1" <?php echo $dataSiswa['agama'] == 1 ? 'selected' : '';?>>Islam</option>
                    <option value="2" <?php echo $dataSiswa['agama'] == 2 ? 'selected' : '';?>>Protestan</option>
                    <option value="3" <?php echo $dataSiswa['agama'] == 3 ? 'selected' : '';?>>Katholik</option>
                    <option value="4" <?php echo $dataSiswa['agama'] == 4 ? 'selected' : '';?>>Hindhu</option>
                    <option value="5" <?php echo $dataSiswa['agama'] == 5 ? 'selected' : '';?>>Budha</option>
                    <option value="6" <?php echo $dataSiswa['agama'] == 6 ? 'selected' : '';?>>lainnya</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Asal Sekolah</td>
            <td><input type="text" name="asal_sekolah" value="<?php echo $dataSiswa['asal_sekolah'];?>"></td>
        </tr>
        <tr>
            <td>Nilai Bahasa Indonesia</td>
            <td><input type="number" name="nilai_ind" value="<?php echo $dataSiswa['nilai_ind'];?>"></td>
        </tr>
        <tr>
            <td>Nilai IPA</td>
            <td><input type="number" name="nilai_ipa" min="0" max="100" step="0.01" value="<?php echo $dataSiswa['nilai_ipa'];?>"/></td>
        </tr>
        <tr>
            <td>Nilai Matematika</td>
            <td><input type="number" name="nilai_mtk" min="0" max="100" step="0.01" value="<?php echo $dataSiswa['nilai_mtk'];?>"/></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="kode_verifikasi">
                    <option value="">---------pilih--------</option>
                    <option value="0" <?php echo $dataSiswa['kode_verifikasi'] == 0 ? 'selected' : '';?>>Mendaftar</option>
                    <option value="1" <?php echo $dataSiswa['kode_verifikasi'] == 1 ? 'selected' : '';?>>Diverifikasi</option>
                    <option value="2" <?php echo $dataSiswa['kode_verifikasi'] == 2 ? 'selected' : '';?>>Dicabut</option>
                    <option value="3" <?php echo $dataSiswa['kode_verifikasi'] == 3 ? 'selected' : '';?>>Diterima</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="login" value="Simpan"></td>
        </tr>
    </table>
</form>
</body>
</html>

<?php include_once('template_bawah.php'); ?>

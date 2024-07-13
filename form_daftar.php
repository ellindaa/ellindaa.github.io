<?php include_once('template_atas.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru Online</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
include 'koneksi.php'; 
include 'tahunAjaran.php';
?>
<div id="form-wrap">
    <h3>Formulir Pendaftaran Tahun Ajaran: <?php echo ThAjaran::getTa(); ?></h3>
    <form action="simpan_calon.php" method="post">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" required>
        </div>
        <div class="form-group">
            <label for="jenis_kel">Jenis Kelamin</label>
            <select name="jenis_kel" id="jenis_kel" required>
                <option value="">---------pilih--------</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" id="tgl_lahir" required>
        </div>
        <div class="form-group">
            <label for="agama">Agama</label>
            <select name="agama" id="agama" required>
                <option value="">---------pilih--------</option>
                <option value="1">Islam</option>
                <option value="2">Katholik</option>
                <option value="3">Protestan</option>
                <option value="4">Hindu</option>
                <option value="5">Budha</option>
                <option value="6">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="asal_sekolah">Asal Sekolah</label>
            <input type="text" name="asal_sekolah" id="asal_sekolah" required>
        </div>
        <div class="form-group">
            <label for="nilai_ind">Nilai Bahasa Indonesia</label>
            <input type="number" name="nilai_ind" id="nilai_ind" min="0" max="100" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="nilai_ipa">Nilai IPA</label>
            <input type="number" name="nilai_ipa" id="nilai_ipa" min="0" max="100" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="nilai_mtk">Nilai Matematika</label>
            <input type="number" name="nilai_mtk" id="nilai_mtk" min="0" max="100" step="0.01" required>
        </div>
        <div class="form-group">
            <input type="submit" name="login" value="Simpan" class="btn">
        </div>
    </form>
</div>
</body>
</html>
<?php include_once('template_bawah.php'); ?>

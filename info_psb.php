<?php include_once('template_atas.php'); ?>
<?php
include 'tahunAjaran.php';
include_once 'koneksi.php';

$tahun_ajaran = ThAjaran::getTa();
$db = Db::bukaKoneksi();
$sql = "SELECT tgl_awal_pendaf, tgl_akhir_pendaf FROM tahun_ajaran WHERE tahun_ajaran = '$tahun_ajaran'";
$result = $db->query($sql);
$tanggal = $result->fetch();

$tgl_awal_pendaf = date("d-m-Y", strtotime($tanggal['tgl_awal_pendaf']));
$tgl_akhir_pendaf = date("d-m-Y", strtotime($tanggal['tgl_akhir_pendaf']));
?>

<div id="content-wrap">
    <h2>Informasi Pendaftaran</h2>
    <h3>Waktu Pendaftaran</h3>
    <p>Pendaftaran secara online dibuka: Tanggal <?php echo $tgl_awal_pendaf; ?> Sampai <?php echo $tgl_akhir_pendaf; ?></p>

    <h3>Cara Pendaftaran</h3>
    <ol>
        <li>Calon siswa/wali mendaftarkan diri/anaknya lewat website yang disediakan oleh pihak sekolah secara online.</li>
        <li>Dengan mengisi nama, alamat, asal sekolah, nilai bahasa indonesia, ipa, matematika.</li>
        <li>Setelah selesai mendaftar calon akan mendapat tanda bukti nomor pendaftaran dari sistem.</li>
        <li>Calon menyerahkan berkas akta kelahiran asli, nilai ijazah dan nomor bukti pendaftaran lewat online ke pihak panitia seleksi, kemudian panitia akan melakukan verifikasi.</li>
        <li>Setelah diverifikasi calon bisa melihat hasil seleksi sementara di halaman web yang disediakan pihak sekolah.</li>
        <li>Jika tidak lolos pada seleksi sementara, dan calon akan mendaftar ke sekolah lain. Maka calon bisa mencabut berkas yang telah dikumpulkan di panitia.</li>
        <li>Selesai pendaftaran ditutup pihak sekolah akan menetapkan siswa yang lolos seleksi menjadi diterima.</li>
    </ol>
    </div>
<?php include_once('template_bawah.php'); ?>

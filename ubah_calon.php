<?php
include_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $db = Db::bukaKoneksi();
        $no_pendaftaran = $_POST['no_pendaftaran'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $jenis_kel = $_POST['jenis_kel'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $agama = $_POST['agama'];
        $asal_sekolah = $_POST['asal_sekolah'];
        $nilai_ind = $_POST['nilai_ind'];
        $nilai_ipa = $_POST['nilai_ipa'];
        $nilai_mtk = $_POST['nilai_mtk'];
        $kode_verifikasi = $_POST['kode_verifikasi'];
        $sql = "UPDATE calon_siswa SET 
                nama = :nama,
                alamat = :alamat,
                jenis_kel = :jenis_kel,
                tgl_lahir = :tgl_lahir,
                agama = :agama,
                asal_sekolah = :asal_sekolah,
                nilai_ind = :nilai_ind,
                nilai_ipa = :nilai_ipa,
                nilai_mtk = :nilai_mtk,
                kode_verifikasi = :kode_verifikasi
                WHERE no_pendaftaran = :no_pendaftaran";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':jenis_kel', $jenis_kel);
        $stmt->bindParam(':tgl_lahir', $tgl_lahir);
        $stmt->bindParam(':agama', $agama);
        $stmt->bindParam(':asal_sekolah', $asal_sekolah);
        $stmt->bindParam(':nilai_ind', $nilai_ind);
        $stmt->bindParam(':nilai_ipa', $nilai_ipa);
        $stmt->bindParam(':nilai_mtk', $nilai_mtk);
        $stmt->bindParam(':kode_verifikasi', $kode_verifikasi);
        $stmt->bindParam(':no_pendaftaran', $no_pendaftaran);
        $stmt->execute();
        header("Location: verifikasi.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Metode request tidak valid.";
}
?>

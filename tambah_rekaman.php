<?php include_once('template_atas.php'); ?>
<?php
include 'tahunAjaran.php';
include_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $tgl_awal_pendaf = $_POST['tgl_awal_pendaf'];
    $tgl_akhir_pendaf = $_POST['tgl_akhir_pendaf'];
    $daya_tampung = $_POST['daya_tampung'];
    $active = isset($_POST['active']) ? $_POST['active'] : 0; // Set default value to 0 if not selected

    try {
        $db = Db::bukaKoneksi();
        $sql = "INSERT INTO tahun_ajaran (tahun_ajaran, tgl_awal_pendaf, tgl_akhir_pendaf, daya_tampung, active) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$tahun_ajaran, $tgl_awal_pendaf, $tgl_akhir_pendaf, $daya_tampung, $active]);

        header("Location: setup_sistem.php");
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Error: Tahun ajaran already exists.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Rekaman</title>
</head>
<body>

<h2>Tambah Rekaman</h2>
<form method="post">
    <table>
        <tr>
            <td for="tahun_ajaran">Tahun Ajaran</td>
            <td><input type="text" id="tahun_ajaran" name="tahun_ajaran" required></td>
        </tr>
        <tr>
            <td for="tgl_awal_pendaf">Tanggal dibuka pendaftaran</td>
            <td><input type="date" id="tgl_awal_pendaf" name="tgl_awal_pendaf" required></td>
        </tr>
        <tr>
            <td for="tgl_akhir_pendaf">Tanggal ditutup pendaftaran</td>
            <td><input type="date" id="tgl_akhir_pendaf" name="tgl_akhir_pendaf" required></td>
        </tr>
        <tr>
            <td for="daya_tampung">Jumlah daya tampung</td>
            <td><input type="number" id="daya_tampung" name="daya_tampung" required></td>
        </tr>
        <tr>
            <td>Status Aktif/tidak aktif</td>
            <td>
                <select id="active" name="active" required>
                    <option value="">-----Pilih-----</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Tambah"></td>
        </tr>
    </table>
</form>

</body>
</html>
<?php include_once('template_bawah.php'); ?>

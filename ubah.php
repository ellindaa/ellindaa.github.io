<?php include_once('template_atas.php'); ?>
<?php
include 'tahunAjaran.php';
include_once 'koneksi.php';

$db = Db::bukaKoneksi();
$tahun_ajaran = $_GET['tahun_ajaran'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tgl_awal_pendaf = $_POST['tgl_awal_pendaf'];
    $tgl_akhir_pendaf = $_POST['tgl_akhir_pendaf'];
    $daya_tampung = $_POST['daya_tampung'];
    $active = $_POST['active'];

    $sql = "UPDATE tahun_ajaran SET tgl_awal_pendaf = ?, tgl_akhir_pendaf = ?, daya_tampung = ?, active = ? WHERE tahun_ajaran = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$tgl_awal_pendaf, $tgl_akhir_pendaf, $daya_tampung, $active, $tahun_ajaran]);

    header("Location: setup_sistem.php");
    exit();
}

$sql = "SELECT * FROM tahun_ajaran WHERE tahun_ajaran = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$tahun_ajaran]);
$data = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Rekaman</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Ubah Rekaman</h2>
<form method="post">
    <label for="tahun_ajaran">Tahun Ajaran:</label><br>
    <input type="text" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran']; ?>" readonly><br>
    <label for="tgl_awal_pendaf">Tanggal Awal:</label><br>
    <input type="date" id="tgl_awal_pendaf" name="tgl_awal_pendaf" value="<?php echo $data['tgl_awal_pendaf']; ?>" required><br>
    <label for="tgl_akhir_pendaf">Tanggal Akhir:</label><br>
    <input type="date" id="tgl_akhir_pendaf" name="tgl_akhir_pendaf" value="<?php echo $data['tgl_akhir_pendaf']; ?>" required><br>
    <label for="daya_tampung">Daya Tampung:</label><br>
    <input type="number" id="daya_tampung" name="daya_tampung" value="<?php echo $data['daya_tampung']; ?>" required><br>
    <label for="active">Status:</label><br>
    <input type="number" id="active" name="active" value="<?php echo $data['active']; ?>" required><br><br>
    <input type="submit" value="Ubah">
</form>

</body>
</html>
<?php include_once('template_bawah.php'); ?>

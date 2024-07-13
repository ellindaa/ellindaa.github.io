<?php
include 'tahunAjaran.php';
include_once 'koneksi.php';

$db = Db::bukaKoneksi();
$tahun_ajaran = $_GET['tahun_ajaran'];

$sql = "DELETE FROM tahun_ajaran WHERE tahun_ajaran = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$tahun_ajaran]);

header("Location: setup_sistem.php");
exit();
?>

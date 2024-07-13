<?php
include_once 'koneksi.php';

class ThAjaran {
    public static function getTa() {
        try {
            $dba = Db::bukaKoneksi();
            $sql = "SELECT tahun_ajaran FROM tahun_ajaran
                    WHERE CURRENT_DATE >= tgl_awal_pendaf
                    AND CURRENT_DATE <= tgl_akhir_pendaf";
            $tahunAjaran = $dba->query($sql);

            if ($tahunAjaran !== false) {
                $ta = $tahunAjaran->fetch();
                if ($ta !== false && isset($ta['tahun_ajaran'])) {
                    return $ta['tahun_ajaran']; 
                } else {
                    return 'Tidak ada tahun ajaran yang aktif';
                }
            } else {
                return 'Tidak dapat mengambil informasi tahun ajaran';
            }
        } catch (PDOException $e) {
            return 'Kesalahan: ' . $e->getMessage();
        }
    }

    public static function getTanggalPendaftaran() {
        try {
            $dba = Db::bukaKoneksi();
            $sql = "SELECT tgl_awal_pendaf, tgl_akhir_pendaf FROM tahun_ajaran
                    WHERE active = 1";
            $tahunAjaran = $dba->query($sql);

            if ($tahunAjaran !== false) {
                $ta = $tahunAjaran->fetch();
                if ($ta !== false && isset($ta['tgl_awal_pendaf']) && isset($ta['tgl_akhir_pendaf'])) {
                    return 'Tanggal : ' . $ta['tgl_awal_pendaf'] . ' Sampai : ' . $ta['tgl_akhir_pendaf'];
                } else {
                    return 'Tidak ada informasi tanggal pendaftaran yang aktif';
                }
            } else {
                return 'Tidak dapat mengambil informasi tanggal pendaftaran';
            }
        } catch (PDOException $e) {
            return 'Kesalahan: ' . $e->getMessage();
        }
    }

    public static function getTanggal() {
        try {
            $dba = Db::bukaKoneksi();
            $sql = "SELECT tgl_awal_pendaf FROM tahun_ajaran
                    WHERE active = 1";
            $tahunAjaran = $dba->query($sql);

            if ($tahunAjaran !== false) {
                $ta = $tahunAjaran->fetch();
                if ($ta !== false && isset($ta['tgl_awal_pendaf'])) {
                    return $ta['tgl_awal_pendaf']; 
                } else {
                    return 'Tidak ada informasi tanggal pendaftaran yang aktif';
                }
            } else {
                return 'Tidak dapat mengambil informasi tanggal pendaftaran';
            }
        } catch (PDOException $e) {
            return 'Kesalahan: ' . $e->getMessage();
        }
    }

    public static function getDayaTampung() {
        try {
            $dba = Db::bukaKoneksi();
            $sql = "SELECT daya_tampung FROM tahun_ajaran
                    WHERE active = 1";
            $tahunAjaran = $dba->query($sql);

            if ($tahunAjaran !== false) {
                $ta = $tahunAjaran->fetch();
                if ($ta !== false && isset($ta['daya_tampung'])) {
                    return $ta['daya_tampung'];
                } else {
                    return 'Tidak ada informasi daya tampung yang aktif';
                }
            } else {
                return 'Tidak dapat mengambil informasi daya tampung';
            }
        } catch (PDOException $e) {
            return 'Kesalahan: ' . $e->getMessage();
        }
    }
}
?>

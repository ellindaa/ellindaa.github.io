<?php
    class Db {
        public static function bukaKoneksi()
        {
            $server = "mysql:host=localhost;port=3307;dbname=psb_online";
            $user = "root";
            $pass = "";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            try {
                return new PDO($server, $user, $pass, $options);
            } catch (PDOException $e) {
                echo "Ada Kesalahan koneksi: " . $e->getMessage();
                return null;
            }
        }
    }
    // Membuka koneksi ke database
    $pdo = Db::bukaKoneksi();
    if ($pdo !== null) {
        // echo "Koneksi Database Berhasil<br>";

        // SQL untuk membuat tabel calon_siswa
        $sqlTabelCalon_Siswa = "CREATE TABLE IF NOT EXISTS calon_siswa (
            no_pendaftaran INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            tahun_ajaran VARCHAR(9) NOT NULL DEFAULT '0000-0000',
            nama VARCHAR(100) NOT NULL,
            alamat VARCHAR(100) NOT NULL,
            tgl_lahir DATE NOT NULL,
            jenis_kel CHAR(1) NOT NULL,
            asal_sekolah VARCHAR(100) NOT NULL,
            agama CHAR(1) NOT NULL,
            nilai_ind DECIMAL(8,2) NOT NULL,
            nilai_ipa DECIMAL(8,2) NOT NULL,
            nilai_mtk DECIMAL(8,2) NOT NULL,
            kode_verifikasi INT NOT NULL DEFAULT 0,
            user_id INT NOT NULL DEFAULT 0
        )";
        $pdo->exec($sqlTabelCalon_Siswa);

        // SQL untuk membuat tabel tahun_ajaran
        $sqlTabelTahun_Ajaran = "CREATE TABLE IF NOT EXISTS tahun_ajaran (
            tahun_ajaran VARCHAR(9) NOT NULL PRIMARY KEY,
            tgl_awal_pendaf DATE NOT NULL,
            tgl_akhir_pendaf DATE NOT NULL,
            daya_tampung INT NOT NULL DEFAULT 0,
            active INT NOT NULL DEFAULT 0
        )";
        $pdo->exec($sqlTabelTahun_Ajaran);

        // SQL untuk membuat tabel user dengan kolom akses
        $sqlTabelUser = "CREATE TABLE IF NOT EXISTS user (
            id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(64) NOT NULL,
            akses VARCHAR(50) NOT NULL
        )";
        $pdo->exec($sqlTabelUser);

        // Memeriksa dan memasukkan data ke dalam tabel user jika tabel kosong
        $sql = "SELECT COUNT(*) AS jumlah FROM user";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetch();
        $jumlah = $result['jumlah'];

        if ($jumlah == 0) {
            $sqlInsert = "INSERT INTO user (username, email, password, akses) VALUES 
                ('admin', 'admin@gmail.com', md5('admin'), 'petugas'),
                ('siswa', 'siswa@gmail.com', md5('siswa'), 'casis')";
            $pdo->exec($sqlInsert);
            echo "Data pengguna berhasil ditambahkan<br>";
        } else {
            // echo "Data pengguna sudah ada<br>";
        }

        // Memasukkan data ke dalam tabel tahun_ajaran
        $sqlInsertTahunAjaran = "INSERT INTO tahun_ajaran (tahun_ajaran, tgl_awal_pendaf, tgl_akhir_pendaf, daya_tampung, active) 
            VALUES 
            ('2023-2024', '2023-07-01', '2023-08-31', 200, 1),
            ('2024-2025', '2024-07-01', '2024-08-31', 250, 1)";

        try {
            $pdo->beginTransaction();

            // Contoh memeriksa apakah data sudah ada sebelum memasukkan
            $sqlCheck = "SELECT COUNT(*) AS count FROM tahun_ajaran WHERE tahun_ajaran IN ('2023-2024', '2024-2025')";
            $stmt = $pdo->query($sqlCheck);
            $result = $stmt->fetch();

            if ($result['count'] == 0) {
                // Memasukkan data jika belum ada
                $pdo->exec($sqlInsertTahunAjaran);
                $pdo->commit();
                echo "Data tahun ajaran berhasil ditambahkan<br>";
            } else {
                //echo "Data tahun ajaran sudah ada dalam basis data<br>";
            }
        } 
        catch (PDOException $e) 
        {
            $pdo->rollBack();
            echo "Gagal menambahkan data tahun ajaran: " . $e->getMessage();
        }
    } else 
    {
        echo "Gagal membuat Koneksi ke database";
    }
?>

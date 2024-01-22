<?php //perikksa login
require './function/loginsession.php'?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah kendaraan</title>
    <link rel="stylesheet" href="./css/tambah_kendaraan.css">
</head>

<body>

    <?php
    require "./function/koneksi.php";
    ?>

    <?php
    if (isset($_FILES['gambar'])) {
        $gambar = $_FILES['gambar'];

        // Dapatkan informasi file
        $namaFile = $gambar['name'];
        $ukuranFile = $gambar['size'];
        $error = $gambar['error'];
        $tmpName = $gambar['tmp_name'];

        // Periksa apakah tidak ada error saat upload
        if ($error === 0) {
            // Tentukan folder untuk menyimpan gambar
            $folderTujuan = 'uploaded/';

            // Buat nama unik untuk file gambar
            $namaFileBaru = uniqid() . '_' . $namaFile;

            // Tentukan path lengkap untuk menyimpan gambar
            $pathFile = $folderTujuan . $namaFileBaru;

            // Pindahkan file gambar ke folder tujuan
            move_uploaded_file($tmpName, $pathFile);

            // Simpan path gambar ke databasenya dibawah

            echo "Gambar berhasil diupload.";
        } else {
            echo "Error saat upload gambar.";
        }
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $jenis_kendaraan = $_POST["jenis_kendaraan"];
        $merek = $_POST["merek"];
        $tipe = $_POST["tipe"];
        $plat_nomor = $_POST["plat_nomor"];
        $foto = $pathFile;


        // Query untuk menyimpan data peminjaman ke tabel peminjaman
        $query_tambah = "INSERT INTO `kendaraan` (`id_Kendaraan`, `jenis`, `merek`, `tipe`, `plat_Nomor`, `foto`, `status_Kendaraan`) 
        VALUES ('', '$jenis_kendaraan', '$merek', '$tipe', '$plat_nomor', '$foto', '1');";
        $result_tambah = mysqli_query($conn, $query_tambah);

        if ($result_tambah) {
            echo "<script>
            alert('Kendaraan berhasil ditambah');
            window.location.href = 'daftar_kendaraan-Admin.php';
        </script>";
        } else {
            echo "Gagal menambah kendaraan.";
        }
    }
    ?>

    <div class="box">
    <a href="homepage-Admin.php"><img src="./img/arrow-left-circle.svg" alt=""></a>

        <h1>Tambah Kendaraan</h1>


        <form action="" method="post" enctype="multipart/form-data">

            <label for="jenis_kendaraan">jenis Kendaraan</label>
            <select name="jenis_kendaraan" id="jenis_kendaraan" required>
                <option value="Motor">Motor</option>
                <option value="Mobil">Mobil</option>
            </select>
            <br>

            <label for="merek">Merek</label>
            <input type="text" name="merek" id="merek" required>
            <br>

            <label for="tipe">Tipe</label>
            <input type="text" name="tipe" id="tipe" required>
            <br>

            <label for="plat_nomor">Plat Nomor</label>
            <input type="text" name="plat_nomor" id="plat_nomor" required>
            <br>

            <label for="gambar">Foto Kendaraan:</label>
            <input type="file" name="gambar" id="gambar" class="file" required>
            <br>

            <button type="submit" value="Upload">Tambah</button>
        </form>

    </div>

</body>

</html>
<?php //perikksa login
require './function/loginsession.php'?>

<?php
require './function/koneksi.php';

/*
//gambar
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
        $folderTujuan = 'uploaded/Kendaraan/';

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
//gambar
*/




// Periksa apakah parameter 'id' dan 'jenis' telah dikirim melalui URL
if (isset($_GET['id']) && isset($_GET['jenis'])) {
    $id_kendaraan = $_GET['id'];
    $jenis_kendaraan = $_GET['jenis'];

    // Query kendaraan
    $query_kendaraan = "SELECT * FROM kendaraan WHERE id_Kendaraan = $id_kendaraan";
    $result_kendaraan = mysqli_query($conn, $query_kendaraan);

    //if else query adaisinya atau ga
    if ($result_kendaraan && mysqli_num_rows($result_kendaraan) > 0) {
        $row_kendaraan = mysqli_fetch_assoc($result_kendaraan);

        // edit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Tangkap data dari form
            $jenis = $_POST["jenis"];
            $merek = $_POST["merek"];
            $tipe = $_POST["tipe"];
            $plat_Nomor = $_POST["plat_Nomor"];
            $foto = $row_kendaraan["foto"];
        

            /*
            // Gambar hanya diubah jika ada gambar baru yang dipilih
            if ($error === 0) {
                $foto = $pathFile;
            } else {
                // Gambar tidak diubah, tetap menggunakan nilai yang ada
                $foto = $row_kendaraan["foto"];
            }
            */



            // sanitasi data
            $merek = htmlspecialchars($merek);
            $tipe = htmlspecialchars($tipe);
            $plat_Nomor = htmlspecialchars($plat_Nomor);

            // Query update kendaraan
            $query_update_kendaraan = "UPDATE kendaraan SET jenis='$jenis', merek='$merek', tipe='$tipe', plat_Nomor='$plat_Nomor', foto='$foto' WHERE id_Kendaraan = $id_kendaraan";

            $result_update_kendaraan = mysqli_query($conn, $query_update_kendaraan);

            if ($result_update_kendaraan) {
                echo "<script>
                    alert('Data kendaraan berhasil diupdate');
                    window.location.href = 'daftar_kendaraan-Admin.php';
                    </script>";
            } else {
                echo "Gagal mengupdate data kendaraan.";
            }
        }
    } else {
        echo "Data kendaraan tidak ditemukan.";
    }
} else {
    echo "Parameter 'id' atau 'jenis' tidak ditemukan pada URL.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kendaraan</title>
    <link rel="stylesheet" href="./css/formprofil.css">
</head>

<body>
    <div class="box" style="max-width: 300px;">

    <h1>Edit Kendaraan</h1>
    <br>
    <form action="" method="post">

        <label for="jenis">Jenis Kendaraan</label>
        <select name="jenis" id="jenis">
            <option value="Motor">Motor</option>
            <option value="Mobil">Mobil</option>
        </select>

        <label for="merek">Merek:</label>
        <input type="text" name="merek" value="<?= $row_kendaraan["merek"]; ?>">
        <br>

        <label for="tipe">Tipe:</label>
        <input type="text" name="tipe" value="<?= $row_kendaraan["tipe"]; ?>">
        <br>

        <label for="plat_Nomor">Plat Nomor:</label>
        <input type="text" name="plat_Nomor" value="<?= $row_kendaraan["plat_Nomor"]; ?>">
        <br>

        <!-- <label for="gambar">Foto Kendaraan:</label>
        <input type="file" name="gambar" id="gambar">
        <br> -->

        <button type="submit">Update</button>
    </form>

    </div>

</body>

</html>
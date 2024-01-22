<?php
require './function/koneksi.php';
require './function/getid.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $nama = $_POST["nama"];
    $nik = $_POST["nik"];
    $jenis_Kelamin = $_POST["jenis_kelamin"];
    $email = $_POST["email"];
    $no_Hp = $_POST["no_Hp"];
    $tanggal_Lahir = $_POST["tanggal_Lahir"];


    // Query untuk menyimpan data peminjaman ke tabel peminjaman
    $query_tambah = "INSERT INTO `profil` (`id_User`, `nama`, `nik`, `jenis_Kelamin`, `tanggal_Lahir`, `email`, `no_Hp`) 
    VALUES ('$id_user', '$nama', '$nik', '$jenis_Kelamin', '$tanggal_Lahir', '$email', '$no_Hp');";
    $result_tambah = mysqli_query($conn, $query_tambah);

    if ($result_tambah) {
        echo "<script>
    alert('Data diri berhasil ditambah');
    window.location.href = 'profil.php';
</script>";
    } else {
        echo "Gagal menambah kendaraan.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form profil</title>
    <link rel="stylesheet" href="./css/formprofil.css">
</head>

<body>
    <div class="box">
        <a href="index.php"><img src="./img/arrow-left-circle.svg" alt=""></a>

        <h1>Masukkan</h1>
        <h1>Data Diri Anda</h1>
        <hr>
        <form action="" method="post">

            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
            <br>

            <label for="nik">NIK</label>
            <input type="number" name="nik" id="nik" minlength="16" maxlength="16" required>
            <br>

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <br>

            <label for="email">Email</label></label>
            <input type="email" name="email" id="email" required>
            <br>

            <label for="no_Hp">Nomor Hp</label></label>
            <input type="number" name="no_Hp" id="no_hp" minlength="10" maxlength="15" required>
            <br>

            <label for="tanggal_Lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_Lahir" name="tanggal_Lahir" required>


            <button type="submit" value="Upload">Tambah</button>
        </form>

    </div>
</body>

</html>
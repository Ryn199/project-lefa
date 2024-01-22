<?php //perikksa login
require './function/loginsession.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kendaraan</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/daftar_kendaraan.css">
    <script src="./js/sidebar.js"></script>

    <style>
        .button-container {
            position: fixed;
            top: 10px;
            right: 10px;
        }

        .button-container button {
            background-color: darkgreen;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    </style>

</head>

<?php
//koneksi database
require './function/koneksi.php';


// Query untuk data motor
$query_motor = "SELECT * FROM kendaraan where jenis = 'Motor'";
$result_motor = mysqli_query($conn, $query_motor);
$jumlah_motor = mysqli_num_rows($result_motor);

// Query untuk data mobil
$query_mobil = "SELECT * FROM kendaraan where jenis = 'Mobil'";
$result_mobil = mysqli_query($conn, $query_mobil);
$jumlah_mobil = mysqli_num_rows($result_mobil);

?>

<body>

    <div id="sidebar">
        <div><img src="./img/minori_logo-1-1.gif" alt="gifminori"></div>
        <a href="homepage-Admin.php">Beranda</a>
        <a href="daftar_kendaraan-Admin.php" class="sekarang">Daftar Kendaraan</a>
        <a href="daftar_peminjaman-Admin.php">Daftar Peminjam</a>
        <div id="logout">
            <a href="javascript:void(0);" onclick="konfirmasiLogout();"><img src="./img/log-out.svg" alt=""></a>
        </div>
        <a href="#" id="infoTrigger">Info</a>
        <div id="infoContainer" class="info-container">
            <a href="https://github.com" class="info" target="_blank"><img src="./img/github.svg" alt=""> Github</a>
            <a href="https://wa.me/+6285280028441" class="info" target="_blank"><img src="./img/phone-call.svg" alt=""> Whatsapp</a>
            <a href="https://facebook.com" class="info" target="_blank"><img src="./img/facebook.svg"> Facebook</a>
        </div>
        <script>
            function konfirmasiLogout() {
                var konfirmasi = confirm('Apakah Anda yakin ingin log out?');
                if (konfirmasi) {
                    window.location.href = 'logout.php';
                }
            }
        </script>
    </div>

    <div class="button-container">
        <button onclick="window.location='tambah_kendaraan.php'">Tambah Data Kendaraan</button>
    </div>

    <div id="content">
        <button id="toggleButton" onclick="toggleSidebar()">☰</button>

        <h2>Daftar Motor</h2>
        <table border="3" class="nomor">
            <tr>
                <th class="nomor">No</th>
                <th>Merk</th>
                <th>Tipe</th>
                <th>Plat Nomor</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php $no = 1;
            while ($row_motor = mysqli_fetch_assoc($result_motor)) : ?>
                <tr>
                    <td><?= $no ?>.</td>
                    <td><?= $row_motor['merek']; ?></td>
                    <td><?= $row_motor['tipe']; ?></td>
                    <td><?= $row_motor['plat_Nomor']; ?></td>
                    <td>
                        <?php
                        if ($row_motor['status_Kendaraan'] == 1) {
                            echo "Tersedia";
                        } elseif ($row_motor['status_Kendaraan'] == 0) {
                            echo ("<span style='color: red;'>Dipinjam</span>");
                        } elseif ($row_motor['status_Kendaraan'] == 2) {
                            echo ("<span style='color: red;'>Dinonaktifkan</span>");
                        }
                        ?>
                    </td>
                    <td>
                        <button onclick="location.href='<?= $row_motor['foto'] ?>';" class="detail">Foto</button>
                        <button onclick="location.href='edit_kendaraan.php?id=<?= $row_motor['id_Kendaraan']; ?>&jenis=Motor';" class="edit">Edit</button>
                        <button onclick="window.location='?id=<?= $row_motor['id_Kendaraan']; ?>'" class="delete">Hapus</button>
                    </td>
                </tr>
            <?php $no++;
            endwhile; ?>
        </table>

        <h2>Daftar Mobil</h2>

        <table border="3" class="nomor">
            <tr>
                <th class="nomor">No</th>
                <th>Merk</th>
                <th>Tipe</th>
                <th>Plat Nomor</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php $no = 1;
            while ($row_mobil = mysqli_fetch_assoc($result_mobil)) : ?>
                <tr>
                    <td><?= $no ?>.</td>
                    <td><?= $row_mobil['merek']; ?></td>
                    <td><?= $row_mobil['tipe']; ?></td>
                    <td><?= $row_mobil['plat_Nomor']; ?></td>
                    <td>
                        <?php
                        if ($row_mobil['status_Kendaraan'] == 1) {
                            echo "Tersedia";
                        } elseif ($row_mobil['status_Kendaraan'] == 0) {
                            echo ("<span style='color: red;'>Dipinjam</span>");
                        } elseif ($row_mobil['status_Kendaraan'] == 2) {
                            echo ("<span style='color: red;'>Dinonaktifkan</span>");
                        }
                        ?>
                    </td>
                    <td>
                        <button onclick="location.href='<?= $row_mobil['foto'] ?>';" class="detail">Foto</button>
                        <button onclick="location.href='edit_kendaraan.php?id=<?= $row_mobil['id_Kendaraan']; ?>&jenis=Mobil';" class="edit">Edit</button>
                        <button onclick="window.location='?id=<?= $row_mobil['id_Kendaraan']; ?>'" class="delete">Hapus</button>
                    </td>
                </tr>
            <?php $no++;
            endwhile; ?>
        </table>
    </div>



    <?php
    if (isset($_GET['id'])) {

        mysqli_query($conn, "Delete from kendaraan where id_Kendaraan='$_GET[id]'");
        echo "<script>
                    alert('Kendaraan berhasil dihapus');
                    window.location.href = 'daftar_kendaraan-Admin.php';
                </script>";
    }


    ?>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            var toggleButton = document.getElementById('toggleButton');

            if (sidebar.style.marginLeft === '-200px') {
                sidebar.style.marginLeft = '0';
                content.style.marginLeft = '200px';
                toggleButton.innerHTML = '☰';
            } else {
                sidebar.style.marginLeft = '-200px';
                content.style.marginLeft = '0';
                toggleButton.innerHTML = '☰';
            }
        }
    </script>


</body>

</html>
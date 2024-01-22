<!-- prosess penngajuan -->
<?php
require './function/koneksi.php';
require './function/getid.php';


$query_pengajuan = "SELECT * FROM `profil` LEFT JOIN peminjaman ON profil.id_User=peminjaman.id_Profil JOIN kendaraan ON peminjaman.id_Kendaraan=kendaraan.id_Kendaraan WHERE peminjaman.status_Peminjaman=1";
$result_pengajuan = mysqli_query($conn, $query_pengajuan);
$jumlah_pengajuan = mysqli_num_rows($result_pengajuan);

$query_riwayat_pengajuan = "SELECT * FROM `profil` LEFT JOIN peminjaman ON profil.id_User=peminjaman.id_Profil JOIN kendaraan ON peminjaman.id_Kendaraan=kendaraan.id_Kendaraan WHERE peminjaman.status_Peminjaman=2";
$result_riwayat_pengajuan = mysqli_query($conn, $query_riwayat_pengajuan);
$jumlah_riwayat_pengajuan = mysqli_num_rows($result_riwayat_pengajuan);

// query buat riwayat
$query_riwayat = "SELECT * FROM `profil` LEFT JOIN riwayat ON profil.id_User=riwayat.id_Profil JOIN kendaraan ON riwayat.id_Kendaraan=kendaraan.id_Kendaraan;";
$result_riwayat = mysqli_query($conn, $query_riwayat);
$jumlah_riwayat = mysqli_num_rows($result_riwayat);
// query buat riwayat
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pinjaman</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/pinjaman.css">
    <script src="./js/sidebar.js"></script>
    <style>
        .konfir-tolak {
            float: right;
            margin-left: 20px;
            margin-top: -60px;
        }

        .konfir {
            background-color: #52f06c;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: +20px;
        }

        .konfir:hover {
            background-color: #0a6108;
        }

        .tolak {
            background-color: rgb(253, 25, 25);
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .tolak:hover {
            background-color: rgb(107, 107, 107);
            color: black;
        }
    </style>

</head>


<body>
    <div id="sidebar">
        <div><img src="./img/minori_logo-1-1.gif" alt="gifminori"></div>
        <a href="homepage-Admin.php">Beranda</a>
        <a href="daftar_kendaraan-Admin.php">Daftar Kendaraan</a>
        <a href="daftar_peminjaman-Admin.php" class="sekarang">Daftar Peminjam</a>
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

    <div id="navbar">
        <a href="#" onclick="showContent('prosesPengajuan')">Menunggu konfirmasi</a>
        <a href="#" onclick="showContent('pinjamanSaya')">Daftar Pinjaman</a>
        <a href="#" onclick="showContent('riwayat')">Riwayat</a>

    </div>



    <div id="content">

        <!-- halaman proses pengajuan -->
        <div id="prosesPengajuan" class="content-section active-content">

            <?php
            if ($jumlah_pengajuan > 0) {
                echo ("<h2>Daftar Pengajuan</h2>");
                // Loop untuk menampilkan data
                while ($row_pengajuan = mysqli_fetch_assoc($result_pengajuan)) {
            ?>
                    <div class="pinjaman-box">
                        <div class="img-pinjam">
                            <img src="<?= $row_pengajuan['foto'] ?>" alt="">
                            <div class="clear"></div>
                        </div>
                        <h3><?= $row_pengajuan['merek'] . ' ' . $row_pengajuan['tipe']; ?></h3>
                        <table>
                            <!-- style="cursor: pointer;" onclick="window.location.href='detail_pinjaman.php?id=<?= $row_pengajuan['id_Kendaraan']; ?>'" -->
                            <tr>
                                <td>Nama Peminjam</td>
                                <td>: <?= $row_pengajuan['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>NIK Peminjam</td>
                                <td>: <?= $row_pengajuan['nik']; ?></td>
                            </tr>
                            <tr>
                                <td>Plat Nomor</td>
                                <td>: <?= $row_pengajuan['plat_Nomor']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan</td>
                                <td>: <?= $row_pengajuan['tanggal_Pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>: <?= $row_pengajuan['waktu']; ?> Hari</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:
                                    <?php
                                    if ($row_pengajuan['status_Peminjaman'] == 1) {
                                        echo "Menunggu konfirmasi";
                                    } else {
                                        echo ("Sedang Dipinjam ");
                                        echo ("(");
                                        echo ($row_pengajuan['waktu']);
                                        echo (" Hari");
                                        echo (")");
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Dokumen Pendukung</td>
                                <?php
                                if ($row_pengajuan['dokumen_Pendukung']) { ?>
                                    <td>: <a href="<?= $row_pengajuan['dokumen_Pendukung'] ?>" target="_blank" style="text-decoration: none;">Lihat...</a></td>
                                <?php } else { ?>
                                    <td>: Tidak ada</td>
                                <?php } ?>
                            </tr>
                        </table>

                        <div class="konfir-tolak">
                            <table>
                                <tr>
                                    <td>
                                        <button onclick="window.location='?konfir=<?= $row_pengajuan['id_Peminjaman']; ?>&kendaraan=<?= $row_pengajuan['id_Kendaraan']; ?>'" class="konfir">Konfirmasi</button>
                                    </td>
                                    <td>
                                        <button onclick="window.location='?tolak=<?= $row_pengajuan['id_Peminjaman']; ?>'" class="tolak">Tolak</button>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                <?php }
            } else { ?>
                <h2 style="text-align: center; margin: left 200px;">Saat ini tidak ada yang mengajukan pinjaman</h2>
            <?php } ?>

        </div>
        <!-- halaman proses pengajuan -->

        <div id="pinjamanSaya" class="content-section">


            <?php
            if ($jumlah_riwayat_pengajuan > 0) {
                echo ("<h2>Daftar Pinjaman</h2>
                ");
                // Loop untuk menampilkan data
                while ($row_riwayat_pengajuan = mysqli_fetch_assoc($result_riwayat_pengajuan)) {
            ?>


                    <div class="pinjaman-box">
                        <div class="img-pinjam">
                            <img src="<?= $row_riwayat_pengajuan['foto'] ?>" alt="<?= $row_riwayat_pengajuan['foto'] ?>">
                            <div class="clear"></div>
                        </div>
                        <h3><?= $row_riwayat_pengajuan['merek'] . ' ' . $row_riwayat_pengajuan['tipe']; ?></h3>
                        <table style="cursor: pointer;" onclick="window.location.href='detail_pinjaman.php?id=<?= $row_pengajuan['id_Kendaraan']; ?>'">
                            <tr>
                                <td>Nama</td>
                                <td>: <?= $row_riwayat_pengajuan['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>NIK Peminjam</td>
                                <td>: <?= $row_riwayat_pengajuan['nik']; ?></td>
                            </tr>
                            <tr>
                                <td>Plat Nomor</td>
                                <td>: <?= $row_riwayat_pengajuan['plat_Nomor']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan</td>
                                <td>: <?= $row_riwayat_pengajuan['tanggal_Pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td> :
                                    <?php
                                    if ($row_riwayat_pengajuan['status_Peminjaman'] == 1) {
                                        echo "Menunggu konfirmasi";
                                    } else {
                                        echo ("Sedang Dipinjam ");
                                        echo ("(");
                                        echo ($row_riwayat_pengajuan['waktu']);
                                        echo (" Hari");
                                        echo (")");
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php }
            } else { ?>
                <h2 style="text-align: center; margin: left 200px;">Anda belum mengajukan pinjaman</h2>
            <?php } ?>
        </div>




        <!-- halaman Riwayat -->
        <div id="riwayat" class="content-section">

            <?php
            if ($jumlah_riwayat > 0) {
                echo ("<h2>Daftar Riwayat</h2>");
                // Loop untuk menampilkan data
                while ($row_riwayat = mysqli_fetch_assoc($result_riwayat)) {
            ?>
                    <div class="pinjaman-box">
                        <div class="img-pinjam">
                            <img src="<?= $row_riwayat['foto'] ?>" alt="">
                            <div class="clear"></div>
                        </div>
                        <h3><?= $row_riwayat['merek'] . ' ' . $row_riwayat['tipe']; ?></h3>
                        <table onclick="window.location.href='detail_pinjaman.php?id=<?= $row_riwayat['id_Kendaraan']; ?>'">
                            <tr>
                                <td>Plat Nomor</td>
                                <td>: <?= $row_riwayat['plat_Nomor']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan</td>
                                <td>: <?= $row_riwayat['tanggal_Pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:
                                    <?php
                                    if ($row_riwayat['level_Riwayat'] == 1) {
                                        echo ('<span style="color: red;">Pengajuan Ditolak</span>');
                                    } elseif ($row_riwayat['level_Riwayat'] == 2) {
                                        echo ("Riwayat Peminjaman ");
                                        echo ("(");
                                        echo ($row_riwayat['waktu']);
                                        echo (" Hari");
                                        echo (")");
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                <?php }
            } else { ?>
                <h2 style="text-align: center; margin: left 200px;">Anda tidak memiliki riwayat</h2>
            <?php } ?>

        </div>






    </div><!--tutup div konten -->




    <!-- eksekusi konfirmasi pengajuan>peminjaman -->

    <?php



if (isset($_GET['konfir'])) {
    $tanggal_Dikonfirmasi = date("Y-m-d");

    mysqli_query($conn, "UPDATE peminjaman SET status_Peminjaman = 2  WHERE id_Peminjaman = '$_GET[konfir]'");
    mysqli_query($conn, "UPDATE peminjaman SET tanggal_Dikonfirmasi = '$tanggal_Dikonfirmasi' WHERE id_Peminjaman = '$_GET[konfir]'");
    mysqli_query($conn, "UPDATE kendaraan SET status_Kendaraan = 0 WHERE id_kendaraan = '$_GET[kendaraan]'");

    echo "<script>
        alert('Pengajuan Dikonfirmasi');
        window.location.href = 'daftar_peminjaman-Admin.php';
    </script>";
}

    if (isset($_GET['tolak'])) {

        // coba dulu
        // coba dulu
        // coba dulu
        $id_pemindahan = $_GET['tolak'];

        // Ambil data peminjaman yang akan dipindahkan ke tabel riwayat
        $query_select_peminjaman = "SELECT * FROM peminjaman WHERE id_Peminjaman = $id_pemindahan";
        $result_select_peminjaman = mysqli_query($conn, $query_select_peminjaman);

        if ($result_select_peminjaman && mysqli_num_rows($result_select_peminjaman) > 0) {
            $row_peminjaman = mysqli_fetch_assoc($result_select_peminjaman);


            // Query untuk menyimpan data ke tabel riwayat
            $query_move_to_riwayat = "INSERT INTO riwayat (id_Riwayat, id_Profil, id_Kendaraan, alasan, waktu, tanggal_Pengajuan, tanggal_Pengembalian, level_Riwayat) 
                                    VALUES ('', '{$row_peminjaman['id_Profil']}', '{$row_peminjaman['id_Kendaraan']}', '{$row_peminjaman['alasan']}', '{$row_peminjaman['waktu']}', '{$row_peminjaman['tanggal_Pengajuan']}', '{$row_peminjaman['tanggal_Pengembalian']}', 1)";

            $result_move_to_riwayat = mysqli_query($conn, $query_move_to_riwayat);

            // Cek apakah pengalihan ke tabel riwayat berhasil
            if ($result_move_to_riwayat) {
                // Lanjutkan dengan menghapus data dari tabel peminjaman
                $query_delete_from_peminjaman = "DELETE FROM peminjaman WHERE id_Peminjaman = $id_pemindahan";
                $result_delete_from_peminjaman = mysqli_query($conn, $query_delete_from_peminjaman);

                if ($result_delete_from_peminjaman) {
                    echo "Data peminjaman berhasil dipindahkan ke tabel riwayat dan dihapus dari tabel peminjaman.";
                } else {
                    echo "Gagal menghapus data peminjaman.";
                }
            } else {
                echo "Gagal memindahkan data ke tabel riwayat.";
            }
        } else {
            echo "Data peminjaman tidak ditemukan.";
        }

        echo "<script>
alert('Pengajuan Ditolak');
window.location.href = 'daftar_peminjaman-Admin.php';
</script>";
    }
    ?>
    <!-- // coba dulu
// coba dulu
// coba dulu -->



    <script>
        function showContent(contentId) {
            // Menghilangkan semua konten
            var allContents = document.getElementsByClassName('content-section');
            for (var i = 0; i < allContents.length; i++) {
                allContents[i].classList.remove('active-content');
            }

            // Menampilkan konten yang dipilih
            document.getElementById(contentId).classList.add('active-content');
        }
    </script>

</body>

</html>
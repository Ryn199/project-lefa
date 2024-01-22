
    <!-- prosess penngajuan --> 
<?php

require './function/koneksi.php';
require './function/getid.php';

// query buat pengajuan (status_peminjaman=1)
$query_pengajuan = "SELECT * FROM `profil` LEFT JOIN peminjaman ON profil.id_User=peminjaman.id_Profil JOIN kendaraan ON peminjaman.id_Kendaraan=kendaraan.id_Kendaraan WHERE peminjaman.status_Peminjaman=1 && id_User= $id_user;";
$result_pengajuan = mysqli_query($conn, $query_pengajuan);
$jumlah_pengajuan = mysqli_num_rows($result_pengajuan);
// query buat pengajuan (status_peminjaman=1)

// query buat peminjaman (status_peminjaman=2)
$query_peminjaman = "SELECT * FROM `profil` LEFT JOIN peminjaman ON profil.id_User=peminjaman.id_Profil JOIN kendaraan ON peminjaman.id_Kendaraan=kendaraan.id_Kendaraan WHERE peminjaman.status_Peminjaman=2 && id_User= $id_user;";
$result_peminjaman = mysqli_query($conn, $query_peminjaman);
$jumlah_peminjaman = mysqli_num_rows($result_peminjaman);
// query buat peminjaman (status_peminjaman=2)

// query buat riwayat pengajuan
$query_riwayat_pengajuan = "SELECT * FROM `profil` LEFT JOIN riwayat ON profil.id_User=riwayat.id_Profil JOIN kendaraan ON riwayat.id_Kendaraan=kendaraan.id_Kendaraan WHERE id_User= $id_user && level_RIwayat=1;";
$result_riwayat_pengajuan = mysqli_query($conn, $query_riwayat_pengajuan);
$jumlah_riwayat_pengajuan = mysqli_num_rows($result_riwayat_pengajuan);
// query buat riwayat pengajuan

// query buat riwayat peminjaman
$query_riwayat_peminjaman = "SELECT * FROM `profil` LEFT JOIN riwayat ON profil.id_User=riwayat.id_Profil JOIN kendaraan ON riwayat.id_Kendaraan=kendaraan.id_Kendaraan WHERE id_User= $id_user && level_RIwayat=2;";
$result_riwayat_peminjaman = mysqli_query($conn, $query_riwayat_peminjaman);
$jumlah_riwayat_peminjaman = mysqli_num_rows($result_riwayat_peminjaman);
// query buat riwayat peminjaman
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

</head>


<body>

    <div id="sidebar">
        <div><img src="./img/minori_logo-1-1.gif" alt="gifminori"></div>
        <a href="index.php">Beranda</a>
        <a href="daftar_kendaraan.php">Daftar Kendaraan</a>
        <a href="#" class="sekarang">Pinjaman Saya</a>
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

    <div id="toggleButton">&#9776; Menu</div>

    <div id="navbar">
        <a href="#" onclick="showContent('prosesPengajuan')">Proses Pengajuan</a>
        <a href="#" onclick="showContent('pinjamanSaya')">Pinjaman Saya</a>
        <a href="#" onclick="showContent('riwayatPengajuan')">Riwayat Pengajuan</a>
        <a href="#" onclick="showContent('riwayatPeminjaman')">Riwayat Peminjaman</a>
    </div>
    <!-- <div class="atas">
        <br>
    </div> -->



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
                            <tr>
                                <td>Nama Peminjam</td>
                                <td>: <?= $row_pengajuan['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Plat Nomor:</td>
                                <td>: <?= $row_pengajuan['plat_Nomor']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan:</td>
                                <td>: <?= $row_pengajuan['tanggal_Pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td>Status:</td>
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
                            <tr>
                                <td>Alasan Peminjaman</td>
                                <td>: </td>
                            </tr>
                        </table>
                        <p class="alasan"><?= $row_pengajuan['alasan']; ?></p>
                    </div>
                <?php }
            } else { ?>
                <h2 style="text-align: center; margin: left 200px;">Anda belum mengajukan pinjaman</h2>
            <?php } ?>

        </div>
        <!-- halaman proses pengajuan -->

        <div id="pinjamanSaya" class="content-section">



            <?php
            if ($jumlah_peminjaman > 0) {
                echo ("<h2>Daftar Pinjaman</h2>");
                // Loop untuk menampilkan data
                while ($row_peminjaman = mysqli_fetch_assoc($result_peminjaman)) {
            ?>


                    <div class="pinjaman-box">
                        <div class="img-pinjam">
                            <img src="<?= $row_peminjaman['foto'] ?>" alt="">
                            <div class="clear"></div>
                        </div>
                        <h3><?= $row_peminjaman['merek'] . ' ' . $row_peminjaman['tipe']; ?></h3>
                        <hr>
                        <table onclick="window.location.href='detail_pinjaman.php?id=<?= $row_peminjaman['id_Peminjaman']; ?>'" style="z-index: -1;">
                            <tr>
                                <td>Plat Nomor</td>
                                <td>: <?= $row_peminjaman['plat_Nomor']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan</td>
                                <td>: <?= $row_peminjaman['tanggal_Pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:
                                    <?php
                                    if ($row_peminjaman['status_Peminjaman'] == 1) {
                                        echo "Menunggu konfirmasi";
                                    } else {
                                        // Ambil nilai waktu peminjaman dari $row_peminjaman
                                        $waktuPeminjaman = is_numeric($row_peminjaman['waktu']) ? intval($row_peminjaman['waktu']) : 0;
                                        $tanggalPengajuan = strtotime($row_peminjaman['tanggal_Pengajuan']);

                                        // Hitung sisa hari berdasarkan nilai waktu
                                        $sisaHari = max(0, $waktuPeminjaman - floor((time() - $tanggalPengajuan) / (60 * 60 * 24)));

                                        echo "Dipinjam untuk ";
                                        echo $row_peminjaman['waktu'];
                                        echo " hari. ";
                                        echo "(";
                                        echo $sisaHari . " Hari tersisa";
                                        echo ")";
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
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                        <div class="kembalikan">
                            <table>
                                <tr>
                                    <!-- <td>
                                        <button  onclick="window.location.href='detail_pinjaman.php?id=<?= $row_peminjaman['id_Peminjaman']; ?>'" style="z-index: -1;" class="detail">Detail</button>
                                    </td> -->
                                    <td>
                                        <button onclick="window.location='?kembalikan=<?= $row_peminjaman['id_Peminjaman']; ?>&kendaraan=<?= $row_peminjaman['id_Kendaraan']; ?>'" class="tombol">Kembalikan</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <h2 style="text-align: center; margin: left 200px;">Anda tidak memiliki pinjaman</h2>
            <?php } ?>
        </div>


        <!-- halaman Riwayat pengajuan -->
        <div id="riwayatPengajuan" class="content-section">

            <?php
            if ($jumlah_riwayat_pengajuan > 0) {
                echo ("<h2>Daftar Riwayat Pengajuan</h2>");
                // Loop untuk menampilkan data
                while ($row_riwayat_pengajuan = mysqli_fetch_assoc($result_riwayat_pengajuan)) {
            ?>
                    <div class="pinjaman-box">
                        <div class="img-pinjam">
                            <img src="<?= $row_riwayat_pengajuan['foto'] ?>" alt="">
                            <div class="clear"></div>
                        </div>
                        <h3><?= $row_riwayat_pengajuan['merek'] . ' ' . $row_riwayat_pengajuan['tipe']; ?></h3>
                        <table>
                            <tr>
                                <td>Plat Nomor</td>
                                <td>: <?= $row_riwayat_pengajuan['plat_Nomor']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan</td>
                                <td>: <?= $row_riwayat_pengajuan['tanggal_Pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:
                                    <?php
                                    if ($row_riwayat_pengajuan['level_Riwayat'] == 1) {
                                        echo ('<span style="color: red;">Pengajuan Ditolak</span>');
                                    } elseif ($row_riwayat_pengajuan['level_Riwayat'] == 2) {
                                        echo ("Riwayat Peminjaman ");
                                        echo ("(");
                                        echo ($row_riwayat_pengajuan['waktu']);
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


        <!-- halaman Riwayat pengajuan -->
        <div id="riwayatPeminjaman" class="content-section">

            <?php
            if ($jumlah_riwayat_peminjaman > 0) {
                echo ("<h2>Daftar Riwayat Peminjaman</h2>");
                // Loop untuk menampilkan data
                while ($row_riwayat_peminjaman = mysqli_fetch_assoc($result_riwayat_peminjaman)) {
            ?>
                    <div class="pinjaman-box">
                        <div class="img-pinjam">
                            <img src="<?= $row_riwayat_peminjaman['foto'] ?>" alt="">
                            <div class="clear"></div>
                        </div>
                        <h3><?= $row_riwayat_peminjaman['merek'] . ' ' . $row_riwayat_peminjaman['tipe']; ?></h3>
                        <table>
                            <tr>
                                <td>Plat Nomor</td>
                                <td>: <?= $row_riwayat_peminjaman['plat_Nomor']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan</td>
                                <td>: <?= $row_riwayat_peminjaman['tanggal_Pengajuan']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Dikonfirmasi</td>
                                <td>: <?= $row_riwayat_peminjaman['tanggal_Dikonfirmasi']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengembalian</td>
                                <td>: <?= $row_riwayat_peminjaman['tanggal_Pengembalian']; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:
                                    <?php
                                    if ($row_riwayat_peminjaman['level_Riwayat'] == 1) {
                                        echo ('<span style="color: red;">Pengajuan Ditolak</span>');
                                    } elseif ($row_riwayat_peminjaman['level_Riwayat'] == 2) {
                                        echo ('<span style="color: green;">Peminjaman Selesai</span>');
                                        // echo ("(");
                                        // echo ($row_riwayat_peminjaman['waktu']);
                                        // echo (" Hari");
                                        // echo (")");
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

    </div>




    <!-- eksekusi tombol -->
    <?php
    if (isset($_GET['kembalikan'])) {

        // coba dulu
        // coba dulu
        // coba dulu
        $id_pemindahan = $_GET['kembalikan'];

        // Ambil data peminjaman yang akan dipindahkan ke tabel riwayat
        $query_select_peminjaman = "SELECT * FROM peminjaman WHERE id_Peminjaman = $id_pemindahan";
        mysqli_query($conn, "UPDATE kendaraan SET status_Kendaraan = 1 WHERE id_kendaraan = '$_GET[kendaraan]'");

        $result_select_peminjaman = mysqli_query($conn, $query_select_peminjaman);

        if ($result_select_peminjaman && mysqli_num_rows($result_select_peminjaman) > 0) {
            $row_peminjaman = mysqli_fetch_assoc($result_select_peminjaman);
            $tanggal_pengembalian = date("Y-m-d");
            // Query untuk menyimpan data ke tabel riwayat
            $query_move_to_riwayat = "INSERT INTO riwayat (id_Riwayat, id_Profil, id_Kendaraan, alasan, waktu, tanggal_Pengajuan, tanggal_Dikonfirmasi, tanggal_Pengembalian, level_Riwayat) 
                            VALUES ('', '{$row_peminjaman['id_Profil']}', '{$row_peminjaman['id_Kendaraan']}', '{$row_peminjaman['alasan']}', '{$row_peminjaman['waktu']}', '{$row_peminjaman['tanggal_Pengajuan']}','{$row_peminjaman['tanggal_Dikonfirmasi']}', '{$tanggal_pengembalian}', 2)";

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
            alert('Kendaraan anda telah dikembalikan');
            window.location.href = 'pinjaman.php';
            </script>";
    }
    ?>







    <script>
        document.getElementById('toggleButton').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var infoContainer = document.getElementById('infoContainer');

            if (sidebar.style.display === '' || sidebar.style.display === 'block') {
                sidebar.style.display = 'none';
                infoContainer.style.display = 'block';
            } else {
                sidebar.style.display = 'block';
                infoContainer.style.display = 'none';
            }
        });




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
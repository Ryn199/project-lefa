<?php
require './function/koneksi.php';
require './function/getid.php';

$id_peminjaman = $_GET['id'];

// query buat peminjaman (status_peminjaman=2)
$query_detail_peminjaman = "
SELECT * 
FROM `profil` 
LEFT JOIN peminjaman ON profil.id_User = peminjaman.id_Profil 
JOIN kendaraan ON peminjaman.id_Kendaraan = kendaraan.id_Kendaraan 
WHERE peminjaman.status_Peminjaman = 2 AND peminjaman.id_Peminjaman = $id_peminjaman AND profil.id_User = $id_user;
";
$result_detail_peminjaman = mysqli_query($conn, $query_detail_peminjaman);
$jumlah_detail_peminjaman = mysqli_num_rows($result_detail_peminjaman);
// query buat peminjaman (status_peminjaman=2)

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail peminjaman</title>
    <link rel="stylesheet" href="./css/detail.css">
</head>

<body>
    <div class="container">
        <a href="pinjaman.php" onclick="showContent('pinjamanSaya')"><img src="./img/arrow-left-circle.svg" alt=""></a>


        <h1>Detail Peminjaman</h1>
        <hr>
        <?php $row_detail = mysqli_fetch_assoc($result_detail_peminjaman); ?>
        <table>
            <tr>
                <td>Nama</td>
                <td>: <?= $row_detail['nama']; ?></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: <?= $row_detail['nik']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: <?= $row_detail['email']; ?></td>
            </tr>
            <tr>
                <td>Nomor Hp</td>
                <td>: <?= $row_detail['no_Hp']; ?></td>
            </tr>
            <tr>
                <td>Alasan Peminjaman</td>
                <td>: <?= $row_detail['alasan']; ?></td>
            </tr>
            <tr>
                <td>Dokumen Pendukung</td>
                <?php
                if ($row_detail['dokumen_Pendukung']) { ?>
                    <td>: <a href="<?= $row_detail['dokumen_Pendukung'] ?>" target="_blank" style="text-decoration: none;">Lihat...</a></td>
                <?php } else { ?>
                    <td>: Tidak ada</td>
                <?php } ?>
            </tr>
            <tr>
                <td>Waktu Peminjaman</td>
                <td>: <?= $row_detail['waktu']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Pengajuan</td>
                <td>: <?= $row_detail['tanggal_Pengajuan']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Dikonfirmasi</td>
                <td>: <?= $row_detail['tanggal_Dikonfirmasi']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:
                    <?php
                    if ($row_detail['status_Peminjaman'] == 1) {
                        echo "Menunggu konfirmasi";
                    } else {
                        // Ambil nilai waktu peminjaman dari $row_detail
                        $waktuPeminjaman = is_numeric($row_detail['waktu']) ? intval($row_detail['waktu']) : 0;
                        $tanggalPengajuan = strtotime($row_detail['tanggal_Pengajuan']);

                        // Hitung sisa hari berdasarkan nilai waktu
                        $sisaHari = max(0, $waktuPeminjaman - floor((time() - $tanggalPengajuan) / (60 * 60 * 24)));

                        echo "Dipinjam untuk ";
                        echo $row_detail['waktu'];
                        echo " hari. ";
                        echo "(";
                        echo $sisaHari . " Hari tersisa";
                        echo ")";
                    }
                    ?>
                </td>
            </tr>
        </table>
        <hr>
        Detail kendaraan
        <table>
            <tr>
                <td>Jenis</td>
                <td>: <?= $row_detail['jenis']; ?></td>
            </tr>
            <tr>
                <td>Merek</td>
                <td>: <?= $row_detail['merek'] . ' ' . $row_detail['tipe'] ?></td>
            </tr>
            <tr>
                <td>Plat Nomor</td>
                <td>: <?= $row_detail['plat_Nomor']; ?></td>
            </tr>
        </table>
        <div class="imgkendaraan">
            <img src="<?= $row_detail['foto'] ?>" alt="foto kendaraan">
        </div>
    </div>
</body>

</html>
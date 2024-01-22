<?php //perikksa login
require './function/loginsession.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/sidebar.js"></script>
</head>

<body>

    <div id="sidebar">
        <div><img src="./img/minori_logo-1-1.gif" alt="gifminori"></div>
        <a href="homepage-Admin.php" class="sekarang">Beranda</a>
        <a href="daftar_kendaraan-Admin.php">Daftar Kendaraan</a>
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
        <a href="profil.php" class="user">
            <img src="./img/user.svg" alt="">Profil
        </a>
    </div>


    <div class="tengah">
    <h1>Selamat Datang</h1>
    <h2>Website peminjaman kendaraan <span>PT Minori</span></h2>
</div>


<div class="foot">
    <small>Copyright &copy 2024 Ridho Yudiana~Lefa</small>
</div>



</body>

</html>
<?php


require './function/koneksi.php';
require './function/getid.php';

$query = "SELECT user.id_User, user.username, profil.nama, profil.nik, profil.jenis_Kelamin, profil.tanggal_Lahir, profil.email, profil.no_Hp, user.level
FROM user LEFT JOIN profil ON user.id_User = profil.id_User WHERE profil.id_User = $id_user;";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="./css/profil.css">
</head>


<body>


    <?php
    if ($row['nama'] != true) {
        echo ('<script>
    window.location="form_profil.php"
    </script>');
    } else { ?>




        <div class="container">

            <?php
            if ($row['level'] == 1) {
                echo '<a href="index.php"><img src="./img/arrow-left-circle.svg" alt=""></a>';
            } else {
                echo '<a href="homepage-Admin.php"><img src="./img/arrow-left-circle.svg" alt=""></a>';
            }
            ?>


            <h1>Profil</h1>


            <table>
                <tr>
                    <td>Nama</td>
                    <td>: <?= $row['nama'] ?></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: <?= $row['nik'] ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: <?= $row['jenis_Kelamin'] ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>: <?= $row['tanggal_Lahir'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: <?= $row['email'] ?></td>
                </tr>
                <tr>
                    <td>No hp</td>
                    <td>: <?= $row['no_Hp'] ?></td>
                </tr>
                <tr>
                    <td>Level</td>
                    <td>: <?= $row['level'] ?>
                        <?php
                        if ($row['level'] == 1) {
                            echo "User";
                        } elseif ($row['level'] == 2) {

                            echo "<span style='color: red;'>Admin</span>";
                        }
                        ?>
                    </td>
                </tr>
            </table>

            <button>Edit</button>

        </div>



    <?php } ?>


</body>

</html>
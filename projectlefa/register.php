<?php
require './function/koneksi.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                    alert('User Ditambahkan');
                    window.location.href = 'login.php';
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./css/register.css">

    <!-- JavaScript -->
    <script>
        function showError(message) {
            alert(message);
        }
    </script>
</head>

<body>

    <?php
    function registrasi($data)
    {
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        //cek username udah ada apa belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Username sudah terdaftar');
            </script>";
            return false;
        }

        if ($password !== $password2) {
            echo "<script>
                alert('Konfirmasi Password tidak sesuai');
            </script>";
            return false;
        }

        //enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //tambahkan user ke database
        mysqli_query($conn, "INSERT INTO `user` (`id_User`, `username`, `password`, `level`) VALUES (NULL, '$username', '$password', '1');");
        return mysqli_affected_rows($conn);
    }
    ?>


    <div class="login-container">
    <a href="awal.php"><img src="./img/arrow-left-circle.svg" alt=""></a>

        <h2>Registrasi</h2>
        <form class="box" onsubmit="return validateForm()" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="password2">Konfirmasi Password:</label>
                <input type="password" id="password2" name="password2" required>

                <input type="submit" name="register" value="Daftar">
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var password2 = document.getElementById("password2").value;

            if (password !== password2) {
                showError("Konfirmasi Password tidak sesuai.");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>
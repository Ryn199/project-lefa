<?php
require 'koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);

    // periksa usernya
    $query = "SELECT * FROM user WHERE level=2 && username = '$username'";
    $result = mysqli_query($conn, $query);
    $jumlahdata = mysqli_num_rows($result);


    if ($jumlahdata > 0) {
        //kalo ketemu
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            session_start();

            $_SESSION['username'] = $username;
            $_SESSION['status_login'] = true;
            header("Location: homepage-Admin.php");
            exit();
        } else {//pw gak valid
            echo "<script>
                alert('Password tidak valid');
            </script>";
        }
    } else{//klo gak ketemu (<0)
            echo "<script>
        alert('Username dan password salah');
    </script>";
    }
}

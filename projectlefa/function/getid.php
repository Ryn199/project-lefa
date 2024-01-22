<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak, arahkan ke halaman login atau berikan pesan kesalahan
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Query untuk mendapatkan informasi pengguna berdasarkan username
$query_user = "SELECT * FROM user WHERE username = '$username'";
$result_user = mysqli_query($conn, $query_user);

// Periksa apakah query berhasil dijalankan dan mendapatkan data
if ($result_user && mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $id_user = $row_user['id_User'];
} else {
    // Handle jika data pengguna tidak ditemukan
    echo "Data pengguna tidak ditemukan.";
    exit();
}
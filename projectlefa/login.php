<?php
require './function/proseslogin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <form action="" method="post">
        <a href="awal.php"><img src="./img/arrow-left-circle.svg" alt=""></a>
        <h1>Login</h1>
        <label for="username">Username: </label>
        <input type="text" name="username" id="" required>
        <label for="password">Password: </label>
        <input type="password" name="password" id="" required>
        <button type="submit" name="login">Login</button><a href="loginAdmin.php"><span style="font-size: x-small; margin-left: 10rem;">Anda admin?</span></a>
    </form>
</body>

</html>
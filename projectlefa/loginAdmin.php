<?php
require './function/prosesloginAdmin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loginAdmin</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <form action="" method="post">
        <a href="awal.php"><img src="./img/arrow-left-circle.svg" alt=""></a>
        <h1>Login <span style="color: red;">Admin</span></h1>
        <label for="username">Username: </label>
        <input type="text" name="username" id="" required>
        <label for="password">Password: </label>
        <input type="password" name="password" id="" required>
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>
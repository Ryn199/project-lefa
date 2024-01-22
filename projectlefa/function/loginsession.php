<?php
session_start();
$id_user= $_SESSION['username'];

if ($_SESSION['status_login'] != true) {
    echo ('<script>
        window.location="login.php"
    </script>');
}

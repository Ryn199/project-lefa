<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Awal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #dcdcdc;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
        }

        h2 {
            color: #3498db;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #login {
            background-color: #3498db;
        }

        #adminLogin {
            background-color: #e74c3c;
            margin-right: 1rem;
            margin-left: 1rem;
        }

        #signup {
            background-color: #2ecc71;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Selamat Datang!</h2>
        <p>Silakan pilih salah satu opsi di bawah ini:</p>

        <div class="button-container">
            <button id="login" class="button" onclick="location.href='login.php';">Login</button>
            <button id="signup" class="button" onclick="location.href='register.php';">Signup</button>
        </div>
    </div>
</body>



</html>
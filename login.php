<?php
// Mengecek apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Koneksi ke database "kedaikopi"
    $host = 'localhost';
    $username = 'root';
    $passwordDb = '';
    $database = 'kedaikopi';

    $conn = new mysqli($host, $username, $passwordDb, $database);

    // Memeriksa apakah koneksi berhasil
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Koneksi ke database "kedaikopi"
        $host = 'localhost';
        $username = 'root';
        $passwordDb = '';
        $database = 'kedaikopi';
    
        $conn = new mysqli($host, $username, $passwordDb, $database);
    
        // Memeriksa apakah koneksi berhasil
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
    
        // Mengeksekusi query untuk memeriksa login
        $query = "SELECT * FROM logon WHERE email='$email' AND password='$password'";
        $result = $conn->query($query);
    
        if ($result->num_rows === 1) {
            // Jika login berhasil
            if ($email === 'admin' && $password === 'admin') {
                // Jika email dan password adalah "admin", alihkan ke admin.php
                header('Location: admin.php');
                exit();
            } else {
                // Jika bukan email dan password admin, alihkan ke index.html
                header('Location: index.html');
                exit();
            }
        }
    
        // Jika login gagal, lakukan tindakan yang sesuai (misalnya, tampilkan pesan kesalahan)
        echo 'Login failed. Please check your credentials.';
    
        // Menutup koneksi database
        $conn->close();
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HALAMAN LOGIN PAGE</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="login">
            <form action="" method="POST">
                <h1>Login</h1>
                <hr>
                <p>MANGGARAI ARABIKA & ROBUSTA</p>
                <label for="">Email</label>
                <input type="text" name="email" placeholder="example@gmail.com" required>
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <p>
                    <a href="#">Forgot Password?</a>
                </p>
            </form>
        </div>
        <div class="right">
            <img src="img/login/image.png" alt="Product 1">
        </div> 
    </div>
</body>
</html>
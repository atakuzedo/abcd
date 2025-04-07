<?php
require 'koneksi.php';

if(isset($_GET['pesan'])){
  if($_GET['pesan'] == "gagal"){
    echo "<script>alert('Username atau Password Salah');location.href='index.php';</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Toko Iqbal</title>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: rgb(20, 20, 20);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    background-color: rgb(40, 40, 40);
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
    width: 300px;
}

h2 {
    text-align: center;
    color: #fff;
    margin-bottom: 30px;
}

.input-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #bbb;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 8px;
    background-color: rgb(30, 30, 30);
    border: 1px solid #555;
    color: #fff;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="text"]:focus,
input[type="password"]:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

button {
    width: 100%;
    padding: 10px;
    background: linear-gradient(90deg, #ff512f, #dd2476, #8a1c4a);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #004494;
}

.error-message {
    color: #ff6b6b;
    font-size: 14px;
    margin-top: 10px;
    display: none;
}

.show-password {
    margin-top: 10px;
    font-size: 14px;
    color: #bbb;
}

</style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form  action="ceklogin.php" method="POST" id="loginForm">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
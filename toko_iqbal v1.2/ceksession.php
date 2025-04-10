<?php

require 'koneksi.php';
// Misalkan Anda sudah melakukan proses login dan menyimpan level pengguna di session
// Contoh: $_SESSION['level'] = 'admin'; // atau 'pelanggan'

if (isset($_SESSION['level'])) {
    if ($_SESSION['level'] == 'admin') {
        $redirectPage = 'admin_halaman.php';
    } elseif ($_SESSION['level'] == 'pelanggan') {
        $redirectPage = 'pelanggan_halaman.php';
    } else {
        $redirectPage = 'index.php'; // Halaman default jika level tidak dikenali
    }
} else {
    $redirectPage = 'index.php'; // Halaman default jika session tidak ada
}
?>
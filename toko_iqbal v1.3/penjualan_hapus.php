<?php
require 'koneksi.php';
$id_penjualan = $_GET['id_penjualan'];
$query = mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_penjualan='$id_penjualan'");
if($query) {
    echo "<script>alert('Data Berhasil di Hapus!'); location.href='penjualan.php';</script>";
} else {
    echo "<script>alert('Data Gagal di Hapus!');</script>";
}


?>
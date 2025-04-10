<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_penjualan=$id ");
$query = mysqli_query($koneksi, "DELETE FROM detailpenjualan WHERE id_penjualan=$id ");
if($query) {
    echo "<script>alert('Data Berhasil di Hapus!'); location.href='?page=pembelian';</script>";
} else {
    echo "<script>alert('Data Gagal di Hapus!');</script>";
}


?>
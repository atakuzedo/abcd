<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan=$id  ");
if($query) {
    echo "<script>alert('Data Berhasil di Hapus!'); location.href='?page=pelanggan';</script>";
} else {
    echo "<script>alert('Data Gagal di Hapus!');</script>";
}


?>
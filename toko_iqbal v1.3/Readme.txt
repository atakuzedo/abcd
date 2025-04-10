list fitur yang blm ada

penjualan:
- penjualan.php
- detailpenjualan (nyampur di penjualan.php)

admin:
- datapelanggan.php


    $query=mysqli_query($koneksi, "INSERT INTO penjualan VALUES (NULL,'$tanggal', '$total', '$idpelanggan')");
    if ($query) {
        echo "<script>alert('Data Berhasil ditambahkan !')
        window.location.href='penjualan.php'; </script>";
    } else {
        echo "<script>alert('Data Gagal ditambahkan!'); </script>";
    }

}


                        <a href="barang_edit.php?id_barang=<?=$nama['id_barang']?>" 
                           class="button warning">Edit</a>
                        <a href="barang_hapus.php?id_barang=<?=$nama['id_barang']?>" 
                           class="button danger" 
                           onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
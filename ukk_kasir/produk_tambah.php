<?php
    if (isset($_POST['nama_produk'])) {
        $id_produk=$_POST['id_produk'];
        $nama=$_POST['nama_produk'];
        $harga=$_POST['harga'];
        $stok=$_POST['stok'];

        $query=mysqli_query($koneksi, "INSERT INTO produk (id_produk, nama_produk, harga, stok) VALUES ('$id_produk','$nama', '$harga', '$stok')");
        if ($query) {
            echo "<script>alert('Data Berhasil di tambahkan!')
            window.location.href='index.php?page=produk'; </script>";
        } else {
            echo "<script>alert('Data Gagal di tambahkan!'); </script>";
        }
    
    }
    
?>
<div class="container-fluid">
                        <h1 class="mt-4">Produk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                        <a href="?page=produk" class="btn btn-danger">kembali</a>
                        <hr>

                        <form method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="200">ID Produk</td>
                                    <td width="1"> :</td>
                                    <td><input type="text" class="form-control" name="id_produk" required></td>
                                </tr>
                                <tr>
                                    <td width="200">Nama Produk</td>
                                    <td width="1"> :</td>
                                    <td><input type="text" class="form-control" name="nama_produk" required></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" step="0" name="harga" required></td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" step="0" name="stok" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" name="simpan" class="btn btn-primary">Simpan</button></td>
                                    <td><button type="reset" name="simpan" class="btn btn-danger">Reset</button></td>
                                </tr>
                                <table>
                        </form>
                    </div>
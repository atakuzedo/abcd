<?php
$id= $_GET['id_produk'];
    if (isset($_POST['nama_produk'])) {
        $id_produk=$_POST['id_produk'];
        $nama=$_POST['nama_produk'];
        $harga=$_POST['harga'];
        $stok=$_POST['stok'];

        $query = mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id_produk='$id'"); ;
        if ($query) {
            echo "<script>alert('Data Berhasil di ubah!')
            location.href='?page=produk';</script>";
        } else {
            echo '<script>alert("Data Gagal di ubah!")</script>';
        }
    
    }
        

    $query = mysqli_query($koneksi, "SELECT*FROM produk WHERE id_produk='$id'");
    $data = mysqli_fetch_array($query);
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
                                    <td><input type="text" class="form-control" value="<?php echo $data['id_produk']; ?> " name="id_produk" readonly></td>
                                </tr>
                                <tr>
                                    <td width="200">Nama Produk</td>
                                    <td width="1"> :</td>
                                    <td><input type="text" class="form-control" value="<?php echo $data['nama_produk']; ?> " name="nama_produk"></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="number"  step="0" value="<?php echo $data['harga']; ?>" name="harga"></td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="number" step="0" value="<?php echo $data['stok']; ?>" name="stok"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" name="simpan" class="btn btn-primary">Simpan</button></td>
                                    <td><button type="reset" name="simpan" class="btn btn-danger">Reset</button></td>
                                </tr>
                                <table>
                        </form>
                    </div>
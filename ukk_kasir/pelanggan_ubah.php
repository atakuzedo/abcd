<?php
$id=$_GET['id'];
    if (isset($_POST['nama_pelanggan'])) {
        $id_pelanggan=$_POST['id_pelanggan'];
        $nama=$_POST['nama_pelanggan'];
        $alamat=$_POST['alamat'];
        $no_telepon=$_POST['no_telepon'];

        $query=mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama', alamat_pelanggan='$alamat', no_telepon='$no_telepon' WHERE id_pelanggan='$id'"); ;
        if ($query) {
            echo "<script>alert('Data Berhasil di ubah!')
             window.location.href='index.php?page=pelanggan'; </script>";
            
        } else {
            echo "<script>alert('Data Gagal di tambahkan!'); </script>";
        }
    
    }

    $query=mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
    $data=mysqli_fetch_array($query); 
?>
<div class="container-fluid">
                        <h1 class="mt-4">Pelanggan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Pelanggan</li>
                        </ol>
                        <a href="?page=pelanggan" class="btn btn-danger">kembali</a>
                        <hr>

                        <form method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="200">ID pelanggan</td>
                                    <td width="1"> :</td>
                                    <td><input type="text" class="form-control" value="<?php echo $data['id_pelanggan']; ?>" name="id_pelanggan"></td>
                                </tr>
                                <tr>
                                    <td width="200">Nama pelanggan</td>
                                    <td width="1"> :</td>
                                    <td><input type="text" class="form-control" value="<?php echo $data['nama_pelanggan']; ?>" name="nama_pelanggan"></td>
                                </tr>
                                 <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>
                                    <textarea name="alamat" rows="5" class="form-control"><?php echo $data['alamat_pelanggan']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. Telephone</td>
                                    <td>:</td>
                                    <td><input ty   e="text" class="form-control" value=<?php echo $data['no_telepon']; ?> name="no_telepon"></td>
                                </tr>
                                <tr> 
                                    <td></td>
                                    <td><button type="submit" name="simpan" class="btn btn-primary">Simpan</button></td>
                                    <td><button type="reset" name="simpan" class="btn btn-danger">Reset</button></td>
                                </tr>
                                <table>
                        </form>
                    </div>
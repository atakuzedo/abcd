<?php
    if (isset($_POST['nama_pelanggan'])) {
        $id_pelanggan=$_POST['id_pelanggan'];
        $nama=$_POST['nama_pelanggan'];
        $alamat=$_POST['alamat'];
        $no_telepon=$_POST['no_telepon'];

        $query=mysqli_query($koneksi, "INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, alamat, no_telepon) VALUES ('$id_pelanggan','$nama', '$alamat', '$no_telepon')");
        if ($query) {
            echo "<script>alert('Data Berhasil di tambahkan!')
            window.location.href='index.php?page=pelanggan';</script>";
        } else {
            echo "<script>alert('Data Gagal di tambahkan!'); </script>";
        }
    
    }

    $current_date = date("y"); // Menggunakan dua digit terakhir tahun
    $sql = "SELECT MAX(id_pelanggan) AS last_id FROM pelanggan WHERE id_pelanggan LIKE '{$current_date}%'";
    $result = $koneksi->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (isset($row['last_id']) && $row['last_id'] !== null) {
            // Ambil angka terakhir dari ID dan tambahkan 1
            $last_number = intval(substr($row['last_id'], 4)); // Potong bagian tanggal (6 karakter pertama, yaitu 'YYMMDD')
            $next_number = $last_number + 1;
        } else {
            $next_number = 1; // Jika belum ada data di tanggal hari ini
        }
    } else {
        $next_number = 1; // Jika tidak ada data sama sekali
    }
    
    // Format next_number dengan 4 digit (misalnya: 0001, 0023, 1234)
    $next_id_pelanggan = $current_date . str_pad($next_number, 6, '0', STR_PAD_LEFT);
    
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
                                    <td><input type="text" class="form-control" name="id_pelanggan" required value="<?= $next_id_pelanggan ?>" readonly ></td>
                                </tr>
                                <tr>
                                    <td width="200">Nama pelanggan</td>
                                    <td width="1"> :</td>
                                    <td><input type="text" class="form-control" name="nama_pelanggan" required oninput="this.value = this.value.replace(/[^A-Za-z\s]/g,'')"></td>
                                </tr>
                                 <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>
                                    <textarea name="alamat" rows="5" class="form-control" required></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. Telephone</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" step="0" name="no_telepon" required oninput="this.value = this.value.replace(/[^0-9\s]/g,'')"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" name="simpan" class="btn btn-primary">Simpan</button></td>
                                    <td><button type="reset" name="simpan" class="btn btn-danger">Reset</button></td>
                                </tr>
                                <table>
                        </form>
                    </div>
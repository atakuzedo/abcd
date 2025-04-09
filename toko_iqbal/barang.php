<?php
require 'koneksi.php';
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
if (isset($_POST['nama_barang'])) {
    $nama=$_POST['nama_barang'];
    $harga=$_POST['harga'];
    $stok=$_POST['stok'];

    $query=mysqli_query($koneksi, "INSERT INTO barang VALUES (NULL,'$nama', '$harga', '$stok')");
    if ($query) {
        echo "<script>alert('Data Berhasil di tambahkan!')
        window.location.href='barang.php'; </script>";
    } else {
        echo "<script>alert('Data Gagal di tambahkan!'); </script>";
    }

}
 $search = isset($_GET['search']) ? $_GET['search'] : '';

// Query dengan pencarian
$query = "SELECT * FROM barang";
if ($search) {
    $query .= " WHERE nama_barang LIKE '%$search%'";
}
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Barang | Toko Iqbal</title>
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            color: #bbb;
            margin: 20px;
            background-color: rgb(20, 20, 20);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px; 
            background-color: rgb(40, 40, 40);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
            border-radius: 8px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        input[type="text"], 
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #555;
            border-radius: 4px;
            background-color: rgb(30, 30, 30);
            color: white;
        }
        
        .button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
            text-decoration: none;
        }
        
        .primary {
            background: linear-gradient(90deg, #ff512f, #dd2476, #8a1c4a);
            color: white;
        }
        
        .secondary {
            background: #dc3545;
            color: white;
        }
        
        .warning {
            background: #ffc107;
            color: black;
        }
        
        .danger {
            background: #dc3545;
            color: white;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .table th, 
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #555;
        }
        
        .table tr:hover {
            background-color: rgb(50, 50, 50);
        }
        
        .card {
            border: 1px solid #555;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .card-header {
            padding: 15px;
            background-color: rgb(40, 40, 40);
            border-bottom: 1px solid #555;
            font-weight: bold;
        }
        
        .card-body {
            padding: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 style="margin-bottom: 20px;">Manajemen Barang</h2>
    
    <!-- Form Input -->
    <div class="card">
        <div class="card-header">
            Tambah/Edit Barang
        </div>
        <div class="card-body">
            <form action="barang.php" method="post" id="formBarang">
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" required>
                    </div>
                    <div style="flex: 1;">
                        <label>Harga</label>
                        <input type="number" name="harga" id="harga" required>
                    </div>
                    <div style="flex: 1;">
                        <label>Stok</label>
                        <input type="number" name="stok" id="stok" required>
                    </div>
                </div>
                <button type="submit" name="submit" class="button primary">Simpan</button>
                <button type="button" name="button" class="button secondary" onclick="resetForm()">Batal</button>
            </form>
        </div>
    </div>
    <button onclick="window.location.href='halamanadmin.php'" class='button primary'>Kembali Ke Halaman Admin</button>
        <!-- Tabel Daftar Barang -->
        <div class="card">
    <div class="card-header">
        Daftar Barang
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="daftarBarang">
                <?php while($data = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?= $data['id_barang'] ?></td>
                    <td><?= $data['nama_barang'] ?></td>
                    <td><?= number_format($data['harga'], 0, ',', '.') ?></td>
                    <td><?= $data['stok'] ?></td>
                    <td>
                        <a href="?page=produk_ubah&id_barang=<?= $data['id_barang'] ?>" 
                           class="button warning">Edit</a>
                        <a href="baranghapus.php?id_barang=<?=$data['id_barang']?>" 
                           class="button danger" 
                           onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<script>
    function resetForm() {
  // Add form reset logic here
  document.querySelector('form').reset(); // Example basic
    }   
</script>
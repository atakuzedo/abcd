<?php
require 'koneksi.php';
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
if (isset($_POST['nama_barang'])) {
    $idbarang='NULL';
    $nama=$_POST['nama_barang'];
    $harga=$_POST['harga'];
    $stok=$_POST['stok'];

    $query=mysqli_query($koneksi, "INSERT INTO barang VALUES (NULL,'$nama', '$harga', '$stok')");
    if ($query) {
        echo "<script>alert('Data Berhasil ditambahkan !')
        window.location.href='barang.php'; </script>";
    } else {
        echo "<script>alert('Data Gagal ditambahkan!'); </script>";
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
            border-radius: 8px;animation: formAppear 0.8s ease-out;
        }   
            
        @keyframes formAppear {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
        }

        .form-group {
            margin-bottom: 15px;
        }
        input{
            color: wheat;
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
            margin-bottom: 15px;
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
        
        .card-header{
            padding: 15px;
            background-color: rgb(40, 40, 40);
            border-bottom: 1px solid #555;
            font-weight: bold;
        }
        
        .card-body{
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
            Tambah Barang
        </div>
        <div class="card-body">
            <form action="barang.php" method="post" id="formBarang">
                <div style="display: flex; gap: 15px; margin-bottom: 15px; margin-right: 15px;">
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
    <button onclick="window.location.href='admin_halaman.php'" class='button primary'>Kembali Ke Halaman Admin</button>
        <!-- Tabel Daftar Barang -->
        <div class="card">
    <div class="card-header">
        Daftar Barang
    </div>
    <div class="card-body">
    <div style="display: flex; gap: 15px; margin-bottom: 15px;">
    <input type="text" id="searchBarang" placeholder="Cari barang...">
    </div>
        <br>
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
            <?php
            $pro = mysqli_query($koneksi, "SELECT*FROM barang");
            while($nama = mysqli_fetch_array($pro)) {
            ?>
            <tbody id="daftarBarang">
            <tr class="barangRow">
                    <td><?= $nama['id_barang'] ?></td>
                    <td><?= $nama['nama_barang'] ?></td>
                    <td><?= number_format($nama['harga'], 0, ',', '.') ?></td>
                    <td><?= $nama['stok'] ?></td>
                    <td>
                        <a href="barang_edit.php?id_barang=<?=$nama['id_barang']?>" 
                           class="button warning">Edit</a>
                        <a href="barang_hapus.php?id_barang=<?=$nama['id_barang']?>" 
                           class="button danger" 
                           onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    
</div>
<script>
    function resetForm() {
  // Add form reset logic here
  document.querySelector('form').reset(); // Example basic
    }   
    

document.getElementById("searchBarang").addEventListener("keyup", function() {
    var input = this.value.toLowerCase();
    var rows = document.querySelectorAll(".barangRow");
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
});

</script>
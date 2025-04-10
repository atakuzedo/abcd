<?php
require 'koneksi.php';

 $search = isset($_GET['search']) ? $_GET['search'] : '';

// Query dengan pencarian
$query = "SELECT * FROM pelanggan";
if ($search) {
    $query .= " WHERE nama_pelanggan LIKE '%$search%'";
}
$result = mysqli_query($koneksi, $query);

$querys = "SELECT * FROM pelanggan";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian | Toko Iqbal</title>
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
        
        .detail{
            background:#42c3ff;
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
    <h2 style="margin-bottom: 20px;">Manajemen Pembelian</h2>
    
    <!-- Form Input -->
    <div class="card">
        <div class="card-header">
            Pembelian
        </div>
        <div class="card-body">
        <button onclick="window.location.href='penjualan_tambah.php'" class='button primary'>Tambah Penjualan</button>
        </div>
    <div class="card">
    <div class="card-body">
    <div style="display: flex; gap: 15px; margin-bottom: 15px;">
    <input type="text" id="searchNamaPelanggan" placeholder="Cari nama pelanggan...">
    </div>
        <br>
        <table class="table">
        <thead>
                <tr>
                    <th>Tanggal Penjualan</th>
                    <th>Nama Barang</th>
                    <th>Total Harga</th>
                    <th>Id Pelanggan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $pro = mysqli_query($koneksi, "SELECT*FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan");
            while($nama = mysqli_fetch_array($pro)) {
            ?>
            <tbody id="daftarBarang">
            <tr class="barangRow">
                    <td><?= $nama['tanggal_penjualan'] ?></td>
                    <td><?= $nama['nama_pelanggan'] ?></td>
                    <td><?= number_format($nama['total_harga'], 0, ',', '.') ?></td>
                    <td><?= $nama['id_pelanggan'] ?></td>
                    <td>
                    <a href="penjualan_detail.php?id_penjualan=<?=$nama['id_penjualan']?>" 
                           class="button detail">Detail</a>
                        <a href="penjualan_hapus.php?id_penjualan=<?=$nama['id_penjualan']?>" 
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
            </form>
        </div>
        <button onclick="window.location.href='admin_halaman.php'" class='button primary'>Kembali Ke Halaman Admin</button>
     
    </div>
       <!-- Tabel Daftar Barang -->
        
<script>
    function resetForm() {
  // Add form reset logic here
  document.querySelector('form').reset(); // Example basic
    }   
    

document.getElementById("searchNamaPelanggan").addEventListener("keyup", function() {
    var input = this.value.toLowerCase();
    var rows = document.querySelectorAll(".barangRow");
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
});

</script>
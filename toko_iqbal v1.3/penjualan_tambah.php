<?php
require 'koneksi.php';

if (isset($_POST['id_pelanggan'])) {
    $id_penjualan='NULL';
    $barang = $_POST['barang'];
    $tanggal=date('dmy');
    $total= 0;
    $id_pelanggan = $_POST['id_pelanggan'];

    $query = mysqli_query($koneksi, "INSERT INTO penjualan (id_penjualan, tanggal_penjualan, id_pelanggan) VALUES(NULL, CURDATE(), '$id_pelanggan')");

    foreach ($barang as $key => $val) {
        $pr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$key'"));

        if ($val > 0) {
            $sub = $val * $pr['harga'];
            $total += $sub;
            $query = mysqli_query($koneksi, "INSERT INTO detailpenjualan VALUES(NULL,'$id_penjualan', '$key', '$val', '$sub')");

            $updateBarang = mysqli_query($koneksi, "UPDATE barang SET stok = stok - $val WHERE id_barang = '$key'");
        }
    }

    $query = mysqli_query($koneksi, "UPDATE penjualan SET total_harga = $total WHERE id_penjualan = '$id_penjualan'");

    if ($query) {
        echo "<script>alert('Tambah data berhasil')
        location.href='pembelian.php';</script>";
    } else {
        echo '<script>alert("Tambah data gagal")</script>';
    }
}

 $search = isset($_GET['search']) ? $_GET['search'] : '';

// Query dengan pencarian
$query = "SELECT * FROM pelanggan";
if ($search) {
    $query .= " WHERE nama_pelanggan LIKE '%$search%'";
}
$result = mysqli_query($koneksi, $query);
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
            <form action="penjualan.php" method="post" id="formBarang">
                <div>
                    <div style="flex: 1;">
                        <label>Nama Pelanggan</label>
                        <select class="form-control form-select" name="id_pelanggan">
                        <?php
                        $p = mysqli_query($koneksi, "SELECT*FROM pelanggan");
                        while($pel = mysqli_fetch_array($p)) {
                        ?>
                        <option value="<?php echo $pel['id_pelanggan']; ?>">
                            <?php echo $pel['nama_pelanggan']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="card-header">
                        <div class="card-body">
                            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                            <input type="text" id="searchBarang" placeholder="Cari barang...">
                            </div>
                            <table class="table">
                                <tbody id="daftarBarang">
                                    <?php
                                    $pro = mysqli_query($koneksi, "SELECT*FROM barang");
                                    while($barang = mysqli_fetch_array($pro)) {
                                    ?>
                                    <tr class="barangRow">
                                        <td><?php echo $barang['nama_barang'] .' (Stok: '.$barang['stok'].')'; ?></td>
                                        <td>:</td>
                                        <td>
                                            <input class="form-control" type="number" step="1" value="0" max="<?php echo $barang['stok']; ?>" name="barang[<?php echo $barang['id_barang']; ?>]">
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>  
                            <button type="submit" name="submit" class="button primary">Simpan</button>
                            <button type="button" name="button" class="button secondary" onclick="resetForm()">Batal</button>
                    </div>
                </div>
        

            </form>

    </div>
    <button onclick="window.location.href='penjualan.php'" class='button primary'>Kembali Ke Halaman Penjualan</button>

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
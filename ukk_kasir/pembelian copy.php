<?php
// HANDLE SEARCH
$search = isset($_GET['search']) ? $_GET['search'] : '';

// QUERY DENGAN PENCARIAN
$query = "SELECT * FROM penjualan 
          LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan";
          
if ($search) {
    $query .= " WHERE nama_pelanggan LIKE '%$search%'";
}
$result = mysqli_query($koneksi, $query);

$querys = "SELECT * FROM pelanggan";

?>

<div class="container-fluid">
    <h1 class="mt-4">Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pembelian</li>
    </ol>

    <!-- SEARCH BAR & TOMBOL TAMBAH -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" action="" class="form-inline">
                <input type="hidden" name="page" value="pembelian">
                <input type="text" id="seacrhPelanggan" class="form-control" placeholder="Cari Pelanggan...">
            </form>
        </div>
        <div class="col-md-6 text-right">
            <a href="?page=pembelian_tambah" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Pembelian
            </a>
        </div>
    </div>

    <!-- TABEL -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tanggal Pembelian</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($data = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?= $data['tanggal_penjualan'] ?></td>
                            <td><?= $data['nama_pelanggan'] ?></td>
                            <td>Rp. <?= number_format($data['total_harga'], 0, ',', '.') ?></td>
                            <td>
                            <a href="?page=penjualan_detail&id=<?= $data['id_penjualan'] ?>" 
                            class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <a href="?page=penjualan_hapus&id=<?= $data['id_penjualan'] ?>" 
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus data pembelian ini?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            </td>
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById("searchPelanggan").addEventListener("keyup", function() {
    var input = this.value.toLowerCase();
    var rows = document.querySelectorAll(".pelangganRow");
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
});
</script>
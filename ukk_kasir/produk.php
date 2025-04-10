<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query dengan pencarian
$query = "SELECT * FROM produk";
if ($search) {
    $query .= " WHERE nama_produk LIKE '%$search%'";
}
$result = mysqli_query($koneksi, $query);
?>

<div class="container-fluid">
    <h1 class="mt-4">Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Produk</li>
    </ol>

    <!-- Search Bar -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" action="" class="form-inline">
                <input type="hidden" name="page" value="produk">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Cari nama produk..." 
                           value="<?php echo htmlspecialchars($search); ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-right">
            <a href="?page=produk_tambah" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>
    </div>

    <!-- Tabel -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($data = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?= $data['id_produk'] ?></td>
                            <td><?= $data['nama_produk'] ?></td>
                            <td><?= number_format($data['harga'], 0, ',', '.') ?></td>
                            <td><?= $data['stok'] ?></td>
                            <td>
                                <a href="?page=produk_ubah&id_produk=<?= $data['id_produk'] ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=produk_hapus&id_produk=<?= $data['id_produk'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
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
<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query dengan pencarian
$query = "SELECT * FROM pelanggan";
if ($search) {
    $query .= " WHERE nama_pelanggan LIKE '%$search%'"; // Diubah ke nama kolom yang benar
}
$result = mysqli_query($koneksi, $query);
?>

<div class="container-fluid">
    <h1 class="mt-4">Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pelanggan</li>
    </ol>
    
    <!-- Search Bar yang Diperbaiki -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" action="" class="form-inline">
                <input type="hidden" name="page" value="pelanggan">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Cari nama pelanggan..." 
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
            <a href="?page=pelanggan_tambah" class="btn btn-success">
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
                            <th scope="col">ID Pelanggan</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No Telephone</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?= ($data['id_unikpelanggan']) ?></td>
                            <td><?= ($data['nama_pelanggan']) ?></td>
                            <td><?= ($data['alamat_pelanggan']) ?></td>
                            <td><?= ($data['no_telepon']) ?></td>
                            <td>
                                <a href="?page=pelanggan_ubah&id=<?= $data['id_pelanggan'] ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=pelanggan_hapus&id=<?= $data['id_pelanggan'] ?>" 
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
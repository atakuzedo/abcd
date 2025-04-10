<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT penjualan.*, pelanggan.nama_pelanggan, pelanggan.alamat_pelanggan, pelanggan.no_telepon
    FROM penjualan 
    LEFT JOIN pelanggan ON pelanggan.id_unikpelanggan = penjualan.id_unikpelanggan 
    WHERE id_penjualan=$id");
$data = mysqli_fetch_array($query);

$detailpelanggan = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE id_pelanggan=$id");
$detailpelanggans = mysqli_fetch_array($detailpelanggan);

?>
<div class="container-fluid">
    <style>
        @media print {
            .breadcrumb, .btn, .mt-4, footer{ display: none; }
            table { width: 100%!important; }
            h1 { font-size: 24px!important; }
        }
    </style>
    
    <h1 class="mt-4">Detail Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Detail Pembelian</li>
    </ol>
    <a href="?page=pembelian" class="btn btn-danger">Kembali</a>
    <button onclick="window.print()" class="btn btn-primary ml-2">Cetak</button>
    <hr>

    <form method="post">
        <table class="table table-bordered">
            <tr>
                <td width="200">Tanggal Transaksi</td>
                <td width="1">:</td>
                <td><?= date('d/m/Y', strtotime($data['tanggal_penjualan'])) ?></td>
            </tr>
            <tr>
                <td>ID Penjualan</td>
                <td>:</td>
                <td><?= $data['id_penjualan'] ?></td>
            </tr>
            <tr>
                <td>ID Pelanggan</td>
                <td>:</td>
                <td><?= $data['id_unikpelanggan'] ?></td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td>:</td>
                <td><?= $data['nama_pelanggan'] ?></td>
            </tr>
            
            <tr>
                <td>Alamat Pelanggan</td>
                <td>:</td>
                <td><?= $data['alamat_pelanggan'] ?></td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>:</td>
                <td><?= $data['no_telepon'] ?></td>
            </tr>
            <?php
            $pro = mysqli_query($koneksi, "SELECT produk.nama_produk, produk.harga, 
                detailpenjualan.jumlah_produk, detailpenjualan.sub_total 
                FROM detailpenjualan 
                LEFT JOIN produk ON produk.id_produk = detailpenjualan.id_produk 
                WHERE id_penjualan = $id");
            
            while ($produk = mysqli_fetch_array($pro)) {
            ?>
            <tr>
            <td>Detail Produk</td>
            <td>:</td>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-4">Nama Produk: <?= $produk['nama_produk'] ?> </div>
                        <div class="col-md-4">Harga Satuan: Rp. <?= number_format($produk['harga']) ?></div>
                        <div class="col-md-4">Jumlah Produk: <?= $produk['jumlah_produk'] ?></div>
                        <div class="col-md-4">Sub Total: Rp. <?= number_format($produk['sub_total']) ?></div>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td><strong>Total Pembelian</strong></td>
                <td>:</td>
                <td><strong>Rp. <?= number_format($data['total_harga']) ?></strong></td>
            </tr>
        </table>
    </form>
</div>
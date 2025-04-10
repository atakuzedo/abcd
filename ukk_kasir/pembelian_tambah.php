<?php
if (isset($_POST['id_pelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $produk = $_POST['produk'];
    $total = 0;
    $tanggal = date('dmy');

    $queryUrutan = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM penjualan WHERE tanggal_penjualan = CURDATE()");
    $dataUrutan = mysqli_fetch_array($queryUrutan);
    $nomorUrut = str_pad($dataUrutan['jumlah'] + 1, 2, '0', STR_PAD_LEFT);

    $id_penjualan = $tanggal . $nomorUrut;

    $query = mysqli_query($koneksi, "INSERT INTO penjualan(id_penjualan, tanggal_penjualan, id_pelanggan) VALUES('$id_penjualan', CURDATE(), '$id_pelanggan')");

    foreach ($produk as $key => $val) {
        $pr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$key'"));

        if ($val > 0) {
            $sub = $val * $pr['harga'];
            $total += $sub;
            $query = mysqli_query($koneksi, "INSERT INTO detailpenjualan(id_penjualan, id_produk, jumlah_produk, sub_total) VALUES('$id_penjualan', '$key', '$val', '$sub')");

            $updateProduk = mysqli_query($koneksi, "UPDATE produk SET stok = stok - $val WHERE id_produk = '$key'");
        }
    }

    $query = mysqli_query($koneksi, "UPDATE penjualan SET total_harga = $total WHERE id_penjualan = '$id_penjualan'");

    if ($query) {
        echo "<script>alert('Tambah data berhasil')
        location.href='?page=pembelian';</script>";
    } else {
        echo '<script>alert("Tambah data gagal")</script>';
    }
}
?>

<div class="container-fluid px">
    <h1 class="mt-4">Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pembelian</li>
    </ol>
    <a href="?page=pembelian" class="btn btn-danger">Kembali</a>
    <hr>

    <form method="post">
        <table class="table table-bordered">
            <tr>
                <td width="200">Nama Pelanggan</td>
                <td width="1">:</td>
                <td>
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
                </td>
            </tr>
        </table>

        <input type="text" id="searchProduk" class="form-control" placeholder="Cari Produk...">
        <br>
        <table class="table table-bordered" id="produkTable">
            <?php
            $pro = mysqli_query($koneksi, "SELECT*FROM produk");
            while($produk = mysqli_fetch_array($pro)) {
            ?>
            <tr class="produkRow">
                <td><?php echo $produk['nama_produk'] .' (Stock: '.$produk['stok'].')'; ?></td>
                <td>:</td>
                <td>
                    <input class="form-control" type="number" step="1" value="0" max="<?php echo $produk['stok']; ?>" name="produk[<?php echo $produk['id_produk']; ?>]">
                </td>
            </tr>
            <?php
            }
            ?>
        </table>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
</div>

<script>
document.getElementById("searchProduk").addEventListener("keyup", function() {
    var input = this.value.toLowerCase();
    var rows = document.querySelectorAll(".produkRow");
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
});
</script>

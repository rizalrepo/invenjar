<div class="table-responsive">
    <table id="example1" class="table table-bordered table-hover table-striped dataTable">
        <thead class="bg-primary">
            <tr align="center">
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Vendor</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include "../../../../app/config.php";
            $nos = 1;
            $dt = $con->query("SELECT * FROM barang b LEFT JOIN kategori c ON b.id_kategori = c.id_kategori LEFT JOIN vendor d ON b.id_vendor = d.id_vendor WHERE b.stok > 0 ORDER BY b.id_barang DESC");
            while ($row = $dt->fetch_array()) {
            ?>
                <tr>
                    <td align="center" width="5%"><?= $nos++ ?></td>
                    <td align="center"><?= $row['kd_barang'] ?></td>
                    <td><?= $row['nm_barang'] ?></td>
                    <td align="center"><?= $row['nm_kategori'] ?></td>
                    <td align="center"><?= $row['nm_vendor'] ?></td>
                    <td align="center"><?= $row['stok'] . ' ' . $row['satuan'] ?></td>
                    <td align="center" width="14%">
                        <button class="btn btn-xs btn-success" id="select" data-id_barang="<?= $row['id_barang'] ?>" data-nm_barang="<?= $row['nm_barang'] ?>" data-kd_barang="<?= $row['kd_barang'] ?>" data-kat_barang="<?= $row['nm_kategori'] ?>" data-satuan="<?= $row['satuan'] ?>" data-stok="<?= $row['stok'] ?>">
                            <i class="fas fa-check-circle"></i> Pilih
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    $(function() {
        $("#example1").DataTable();
    });
</script>
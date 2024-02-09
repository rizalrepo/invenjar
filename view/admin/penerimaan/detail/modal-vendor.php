<div class="table-responsive">
    <table id="example1" class="table table-bordered table-hover table-striped dataTable">
        <thead class="bg-primary">
            <tr align="center">
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Kategori</th>
                <th>Vendor</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include "../../../../app/config.php";
            $nos = 1;
            $ids = $_POST['ids'];
            $data = $con->query("SELECT * FROM barang a LEFT JOIN vendor b ON a.id_vendor = b.id_vendor LEFT JOIN kategori c ON a.id_kategori = c.id_kategori WHERE a.id_vendor = '$ids' ORDER BY a.id_barang DESC");
            while ($row = $data->fetch_array()) {
            ?>
                <tr>
                    <td align="center" width="5%"><?= $nos++ ?></td>
                    <td align="center"><?= $row['kd_barang'] ?></td>
                    <td><?= $row['nm_barang'] ?></td>
                    <td align="center"><?= $row['satuan'] ?></td>
                    <td align="center"><?= $row['nm_kategori'] ?></td>
                    <td align="center"><?= $row['nm_vendor'] ?></td>
                    <td align="center" width="14%">
                        <button class="btn btn-xs btn-success" id="select" data-nm_barang="<?= $row['nm_barang'] ?>" data-satuan="<?= $row['satuan'] ?>" data-id_barang="<?= $row['id_barang'] ?>" data-kd_barang="<?= $row['kd_barang'] ?>" data-kat_barang="<?= $row['nm_kategori'] ?>">
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
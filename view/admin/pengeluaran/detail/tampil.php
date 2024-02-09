<table id="tbl" class="table table-striped table-bordered">
    <thead class="bg-primary">
        <tr align="center">
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        <?php
        include "../../../../app/config.php";
        $no1 = 1;
        $id1 = $_POST['id'];

        $jml = mysqli_query($con, "SELECT SUM(jumlah) FROM pengeluaran_detail WHERE id_pengeluaran = '$id1' ")->fetch_array();

        $data1 = mysqli_query($con, "SELECT * FROM pengeluaran_detail a LEFT JOIN barang b ON a.id_barang = b.id_barang LEFT JOIN kategori c ON b.id_kategori = c.id_kategori WHERE a.id_pengeluaran = '$id1' ");
        while ($tampil1 = mysqli_fetch_array($data1)) {
        ?>
            <tr>
                <td align="center" width="5%"><?= $no1++; ?></td>
                <td align="center"><?= $tampil1['kd_barang'] ?></td>
                <td><?= $tampil1['nm_barang'] ?></td>
                <td align="center"><?= $tampil1['nm_kategori'] ?></td>
                <td align="center"><?= $tampil1['jumlah'] . ' ' . $tampil1['satuan'] ?></td>
                <td align="center" width="8%">
                    <span class="btn btn-xs btn-info" id="edit" data-id="<?= $tampil1[0]; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"> <i class="fas fa-edit"></i></span>
                    <span class="btn btn-xs btn-danger" id="hapus" data-id="<?= $tampil1[0]; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"> <i class="fas fa-trash"></i></span>
                </td>
            </tr>
        <?php } ?>
        <tr class="bg-light">
            <td align="center" colspan="4" class="fw-bold">Jumlah Pengeluaran</td>
            <td align="center" class="fw-bold"><?= $jml['SUM(jumlah)'] ? $jml['SUM(jumlah)'] . ' Item' : '-' ?></td>
            <td align="center" class="fw-bold">#</td>
        </tr>
    </tbody>

</table>
<hr>
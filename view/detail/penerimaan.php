<?php
require '../../../app/configtables.php';
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
?>

<div id="id<?= $id = $row[0]; ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="custom-width-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="bi bi-building-fill-down me-2"></i>Detail Data Penerimaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM penerimaan a LEFT JOIN vendor b ON a.id_vendor = b.id_vendor WHERE a.id_penerimaan = '$id'");
            $d = $q->fetch_array();
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <dl class="row text-start my-3">
                                <dt class="col-sm-2">Kode</dt>
                                <dd class="col-sm-10">: <?= $d['id_penerimaan'] ?></dd>
                                <dt class="col-sm-2">Tanggal</dt>
                                <dd class="col-sm-10">: <?= tgl($d['tanggal']) ?></dd>
                                <dt class="col-sm-2">Vendor</dt>
                                <dd class="col-sm-10">: <?= $d['nm_vendor'] ?></dd>
                                <dt class="col-sm-2">No. Invoice</dt>
                                <dd class="col-sm-10">: <?= $d['no_invoice'] ?></dd>
                            </dl>
                        </div>

                        <table id="tbl" class="table table-striped table-bordered mt-0">
                            <thead class="bg-primary">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori Barang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no1 = 1;
                                $jml = mysqli_query($con, "SELECT SUM(jumlah) FROM penerimaan_detail WHERE id_penerimaan = '$id' ")->fetch_array();

                                $data1 = mysqli_query($con, "SELECT * FROM penerimaan_detail a LEFT JOIN barang b ON a.id_barang = b.id_barang LEFT JOIN kategori c ON b.id_kategori = c.id_kategori WHERE a.id_penerimaan = '$id' ");
                                while ($tampil1 = mysqli_fetch_array($data1)) {
                                ?>
                                    <tr>
                                        <td align="center" width="5%"><?= $no1++; ?></td>
                                        <td align="center"><?= $tampil1['kd_barang'] ?></td>
                                        <td><?= $tampil1['nm_barang'] ?></td>
                                        <td align="center"><?= $tampil1['nm_kategori'] ?></td>
                                        <td align="center"><?= $tampil1['jumlah'] . ' ' . $tampil1['satuan'] ?></td>
                                    </tr>
                                <?php } ?>
                                <tr class="bg-light">
                                    <td align="center" colspan="4" class="fw-bold">Total Penerimaan</td>
                                    <td align="center" class="fw-bold"><?= $jml['SUM(jumlah)'] ? $jml['SUM(jumlah)'] . ' Item' : '-' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
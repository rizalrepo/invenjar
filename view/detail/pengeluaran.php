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
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="fas fa-building-circle-arrow-right me-2"></i>Detail Data Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM pengeluaran a LEFT JOIN teknisi b ON a.id_teknisi = b.id_teknisi LEFT JOIN keperluan c ON a.id_keperluan = c.id_keperluan WHERE a.id_pengeluaran = '$id'");
            $d = $q->fetch_array();
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <dl class="row text-start my-3">
                                <dt class="col-sm-3">Kode</dt>
                                <dd class="col-sm-9">: <?= $d['id_pengeluaran'] ?></dd>
                                <dt class="col-sm-3">Tanggal</dt>
                                <dd class="col-sm-9">: <?= tgl($d['tanggal']) ?></dd>
                                <dt class="col-sm-3">Teknisi</dt>
                                <dd class="col-sm-9">: <?= $d['kd_teknisi'] ?> | <?= $d['nm_teknisi'] ?></dd>
                                <dt class="col-sm-3">Keperluan</dt>
                                <dd class="col-sm-9">: <?= $d['nm_keperluan'] ?></dd>
                                <dt class="col-sm-3">Keterangan</dt>
                                <dd class="col-sm-9">: <?= $d['ket'] ?></dd>
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
                                $jml = mysqli_query($con, "SELECT SUM(jumlah) FROM pengeluaran_detail WHERE id_pengeluaran = '$id' ")->fetch_array();

                                $data1 = mysqli_query($con, "SELECT * FROM pengeluaran_detail a LEFT JOIN barang b ON a.id_barang = b.id_barang LEFT JOIN kategori c ON b.id_kategori = c.id_kategori WHERE a.id_pengeluaran = '$id' ");
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
                                    <td align="center" colspan="4" class="fw-bold">Total Pengeluaran</td>
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
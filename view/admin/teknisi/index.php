<?php
require '../../../app/config.php';
$page = 'teknisi';
include_once '../../layout/topbar.php';
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-clipboard-user me-2"></i>Data Teknisi</h4>

                <div class="page-title-right">
                    <a href="tambah" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                </div>
            </div>
            <div class="card card-body border border-danger">

                <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                    <div id="notif" class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>
                            <b><?= $_SESSION['pesan'] ?></b>
                        </div>
                    </div>
                <?php $_SESSION['pesan'] = '';
                } ?>


                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped dataTable">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Kode Teknisi</th>
                                <th>Nama Teknisi</th>
                                <th>NIK</th>
                                <th>Nomor HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM teknisi ORDER BY id_teknisi DESC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td align="center"><?= $row['kd_teknisi'] ?></td>
                                    <td><?= $row['nm_teknisi'] ?></td>
                                    <td align="center"><?= $row['nik'] ?></td>
                                    <td align="center"><?= $row['hp'] ?></td>
                                    <td align="center" width="11%">
                                        <span data-bs-target="#id<?= $row[0]; ?>" data-bs-toggle="modal" class="btn bg-success btn-xs text-white">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i></span>
                                        </span>
                                        <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                                        <?php include('../../detail/teknisi.php'); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- row  -->
</div>

<?php include_once '../../layout/footer.php'; ?>
<script src="<?= base_url() ?>/app/js/app.js"></script>
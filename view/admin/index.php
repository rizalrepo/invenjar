<?php
require '../../app/config.php';
$page = 'dashboard';
include_once '../layout/topbar.php';

$a = $con->query("SELECT COUNT(*) AS total FROM barang WHERE stok != 0")->fetch_array();
?>
<div class="page-content">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="mdi mdi-airplay me-2"></i>Dashboard</h4>

                <div class="page-title-right">
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-danger text-danger rounded">
                                    <i class="fas fa-box"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Barang Tersedia</h5>
                            <p class="text-truncate mb-0"><?= $a['total'] ?> Data</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<!-- End Page-content -->

<?php include_once '../layout/footer.php'; ?>
<script src="<?= base_url() ?>/app/js/app2.js"></script>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="text-center txt-footer fw-bold">
                <script>
                    document.write(new Date().getFullYear())
                </script> © Sistem Informasi Inventory Jaringan Telkom Banjarbaru
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

</div>
<!-- end container-fluid -->

<div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-body rightbar">
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title px-3 py-4">
                    <a href="javascript:void(0);" class="right-bar-toggle float-end" data-bs-dismiss="offcanvas" aria-label="Close">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                    <h5 class="m-0">Settings</h5>
                </div>


                <hr class="mt-0" />
                <h6 class="text-center mb-0">Pilih Mode</h6>

                <div class="p-4">
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" />
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- /Right-bar -->
<?php
include 'modal.php';
?>
<script src="<?= base_url() ?>/assets/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/node-waves/waves.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<script src="<?= base_url() ?>/assets/libs/swal2/dist/sweetalert2.min.js"></script>

<script src="<?= base_url() ?>/assets/libs/datatable/datatables.min.js"></script>

<script src="<?= base_url() ?>/assets/libs/select2/js/select2.min.js"></script>

<script src="<?= base_url() ?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

<!-- form advanced init -->
<script src="<?= base_url() ?>/assets/js/pages/form-advanced.init.js"></script>

<script src="<?= base_url() ?>/assets/js/custom.min.js"></script>

</body>

</html>
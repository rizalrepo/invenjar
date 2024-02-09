<?php
require '../../app/config.php';
$page = 'dashboard';
include_once '../layout/topbar.php';
?>

<div class="page-content">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="bx bx-key me-2"></i>Ubah Password</h4>

                <div class="page-title-right">
                    <?php
                    if ($_SESSION['level'] == 3) {
                        $url = base_url() . '/view/penduduk/index';
                    } else {
                        $url = base_url() . '/view/admin/index';
                    }
                    ?>
                    <a href="<?= $url ?>" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>

            <div class="card card-body border border-danger">
                <form class="needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password Lama</label>
                        <div class="input-group">
                            <input type="password" id="passlama" class="form-control" name="passlama" required>
                            <div class="input-group-text" id="lihatpasslama"><span class="fas fa-eye-slash" title="Lihat Password" onclick="change1();"></span></div>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password Baru</label>
                        <div class="input-group">
                            <input type="password" id="passbaru" class="form-control" name="passbaru" required>
                            <div class="input-group-text" id="lihatpassbaru"><span class="fas fa-eye-slash" title="Lihat Password" onclick="change2();"></span></div>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" id="confirm" class="form-control" name="confirm" required>
                            <div class="input-group-text" id="lihatconfirm"><span class="fas fa-eye-slash" title="Lihat Password" onclick="change3();"></span></div>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mt-4 text-end">
                        <div class="col-sm-12">
                            <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fa fa-times-circle"></i> Batal</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-save"></i> Ubah Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php
include_once '../layout/footer.php';
?>

<script src="<?= base_url() ?>/app/js/app2.js"></script>

<?php
$user = $_SESSION['id_user'];
if (isset($_POST['submit'])) {
    $passlama     = $_POST['passlama'];
    $passbaru     = $_POST['passbaru'];
    $confirmpass  = $_POST['confirm'];

    $enc = md5($passbaru);

    // $data = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]'")->fetch_array();
    $cek = $con->query("SELECT * FROM user WHERE id_user = '$user'")->fetch_array();
    // if ($cek['password'] == $lama) {

    if (md5($passlama) == $cek['password']) {

        if ($passbaru == $confirmpass) {
            $submit = $con->query("UPDATE user SET password = '$enc' WHERE id_user = '$user'");
            if ($submit) {
                echo "
                <script type='text/javascript'>
                    setTimeout(function () {    
                        Swal.fire({
                            title: 'Ubah Password Berhasil',
                            text:  'Silahkan Login Menggunakan Password Baru ! ',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });     
                    },10);  
                    window.setTimeout(function(){ 
                        window.location.replace('logout');
                    } ,2000);   
                </script>";
            }
        } else {
            echo "
            <script type='text/javascript'>
                setTimeout(function () {    
                    Swal.fire({
                        title: 'Ubah Password Gagal',
                        text:  'Password Baru Tidak Sama !',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });     
                },10);  
                window.setTimeout(function(){ 
                    window.history.back();
                } ,2000);   
            </script>";
        }
    } else {
        echo "
        <script type='text/javascript'>
            setTimeout(function () {    
                Swal.fire({
                    title: 'Ubah Password Gagal',
                    text:  'Password Lama Salah !',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });     
            },10);  
            window.setTimeout(function(){ 
                window.history.back();
            } ,2000);   
        </script>";
    }
}
?>
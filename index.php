<?php require 'app/config.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login Sistem Inventory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <?php include_once 'view/layout/css.php'; ?>
</head>

<body>
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0 min-vh-100">
            <div class="col-12 col-md-4 col-lg-4 col-xxl-4">
                <!-- Card -->
                <div class="card overflow-hidden">
                    <!-- Card body -->
                    <div class="text-center">
                        <img class="mt-3" src="<?= base_url() ?>/assets/images/logo-sm-dark.png" alt="" height="160">
                    </div>
                    <div class="card-body">
                        <div class="p-2">
                            <form method="POST" action="" class="needs-validation" novalidate>
                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="username" class="form-label mb-1">Username</label>
                                    <input type="text" id="username" class="form-control text-black" name="username" required>
                                    <div class="invalid-feedback">Input Username !</div>
                                </div>
                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="pw" class="form-label mb-1">Password</label>
                                    <div class="input-group has-validation">
                                        <input type="password" name="password" id="pw" class="form-control text-black" required>
                                        <div class="input-group-text" id="lihat-pw"><span class="fas fa-eye-slash" title="Lihat Password" onclick="change();"></span></div>
                                        <div class="invalid-feedback">Input Password !</div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" name="log" class="btn btn-app fw-bold">Login <i class="bi bi-box-arrow-in-right"></i></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'view/layout/js.php'; ?>

</body>

</html>

<?php
if (isset($_POST['log'])) {
    $user = $con->real_escape_string($_POST['username']);
    $pass = $con->real_escape_string($_POST['password']);

    $pass = md5($pass);
    $query = $con->query("SELECT * FROM user WHERE username = '$user' AND password='$pass'");
    $data = $query->fetch_array();
    $username = $data['username'];
    $password = $data['password'];
    $id = $data['id_user'];
    $level = $data['level'];
    $usr = $data['nm_user'];

    if ($user == $username && $pass == $password) {

        $_SESSION["login"] = true;
        $_SESSION['id_user'] = $id;
        $_SESSION['level'] = $level;
        $_SESSION['nm_user'] = $usr;

        $url = 'view/admin/';

        echo "
        <script type='text/javascript'>
            setTimeout(function () {    
                Swal.fire({
                    title: 'Login Berhasil',
                    text:  'Anda Login Sebagai $usr',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });     
            },10);  
            window.setTimeout(function(){ 
                window.location.replace('$url');
            } ,2000);   
        </script>";
    } else {
        echo "
        <script type='text/javascript'>
            setTimeout(function () {    
                Swal.fire({
                    title: 'Login Gagal',
                    text:  'Username atau Password Tidak Ditemukan',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });     
            },10);  
            window.setTimeout(function(){ 
                window.location.replace('index');
            } ,2000);   
        </script>";
    }
}
?>
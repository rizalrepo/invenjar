<?php
require '../../../app/config.php';
$page = 'barang';
include_once '../../layout/topbar.php';

$id = $_GET['id'];
$query = $con->query(" SELECT * FROM barang WHERE id_barang ='$id'");
$row = $query->fetch_array();
?>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-box me-2"></i>Edit Data Barang</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-danger">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="<?= $row['kd_barang'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nm_barang" value="<?= $row['nm_barang'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="satuan" value="<?= $row['satuan'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori Barang</label>
                        <div class="col-sm-10">
                            <select name="id_kategori" class="form-select select2" style="width: 100%;" required>
                                <?php $data = $con->query("SELECT * FROM kategori ORDER BY id_kategori ASC"); ?>
                                <?php foreach ($data as $d) :
                                    if ($d['id_kategori'] == $row['id_kategori']) { ?>
                                        <option value="<?= $d['id_kategori']; ?>" selected="<?= $d['id_kategori']; ?>"><?= $d['nm_kategori'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $d['id_kategori'] ?>"><?= $d['nm_kategori'] ?></option>
                                <?php }
                                endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Vendor</label>
                        <div class="col-sm-10">
                            <select name="id_vendor" class="form-select select2" style="width: 100%;" required>
                                <?php $data = $con->query("SELECT * FROM vendor ORDER BY id_vendor ASC"); ?>
                                <?php foreach ($data as $d) :
                                    if ($d['id_vendor'] == $row['id_vendor']) { ?>
                                        <option value="<?= $d['id_vendor']; ?>" selected="<?= $d['id_vendor']; ?>"><?= $d['nm_vendor'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $d['id_vendor'] ?>"><?= $d['nm_vendor'] ?></option>
                                <?php }
                                endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mt-4 text-end">
                        <div class="col-sm-12">
                            <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fa fa-times-circle"></i> Batal</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- row  -->
</div>

<?php
include_once '../../layout/footer.php';
?>
<script src="<?= base_url() ?>/app/js/app.js"></script>
<?php
if (isset($_POST['submit'])) {
    $nm_barang = $_POST['nm_barang'];
    $satuan = $_POST['satuan'];
    $id_kategori = $_POST['id_kategori'];
    $id_vendor = $_POST['id_vendor'];

    $update = $con->query("UPDATE barang SET 
        nm_barang = '$nm_barang',
        satuan = '$satuan',
        id_kategori = '$id_kategori',
        id_vendor = '$id_vendor'
        WHERE id_barang = '$id'
    ");

    if ($update) {
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}


?>
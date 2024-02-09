<?php
require '../../../app/config.php';
$page = 'penerimaan';
include_once '../../layout/topbar.php';

$cek_result = $con->query("SELECT max(id_penerimaan) AS kode FROM penerimaan");

if ($cek_result) {
    $cek = $cek_result->fetch_array();

    if ($cek['kode'] !== null) {
        $nourut = (int) substr($cek['kode'], 4, 5);
        $nourut++;
    } else {
        $nourut = 1;
    }

    $a = "INV-";
    $kode = $a . sprintf('%05s', $nourut);
} else {
    echo "Error executing query: " . $con->error;
}
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="bi bi-building-fill-down me-2"></i>Tambah Data penerimaan</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>

            <div class="card card-body border border-danger">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="<?= $kode ?>" readonly>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Vendor</label>
                        <div class="col-sm-10">
                            <select name="id_vendor" id="id_vendor" class="form-select select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM vendor ORDER BY id_vendor ASC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_vendor'] ?>"><?= $row['nm_vendor'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Invoice</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_invoice" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <hr>
                    <span id="btn-tambah" data-bs-toggle="modal" data-bs-target="#modal-tambah" class="btn btn-sm btn-primary mb-2"><i class="fas fa-box me-2"></i>Input Barang</span>
                    <input type="hidden" id="dataid" value="<?= $kode; ?>">
                    <div id="data-barang">

                    </div>
                    <div class="form-group row mt-4 text-end">
                        <div class="col-sm-12">
                            <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fa fa-times-circle"></i> Batal</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- row  -->
</div>

<div class="modal fade" id="modal-tambah" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="fas fa-box me-2"></i>Input Data Barang</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" novalidate id="form-tambah" method="POST" enctype="multipart/form-data" action="detail/simpan.php">
                    <div class="card-body">
                        <input type="hidden" name="id_penerimaan" value="<?= $kode ?>">
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Kode Barang</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="hidden" class="form-control" name="id_barang" id="id_barang" required>
                                    <input type="text" class="form-control bg-light" id="kd_barang" required readonly>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-barang" class="btn text-white btn-info btn-flat"><i class="fa fa-search"></i></button>
                                    <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control bg-light" id="nm_barang" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Kategori Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control bg-light" id="kat_barang" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control bg-light" id="satuan" readonly>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fas fa-times-circle me-1"></i>Batal</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fas fa-save me-1"></i>Simpan</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="modal-barang" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-box me-2"></i>Pilih Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="data-vendor"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-box me-2"></i>Edit Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" novalidate id="form-edit" method="POST" enctype="multipart/form-data" action="detail/update.php">
                    <div id="data-edit"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include_once '../../layout/footer.php';
?>
<script src="<?= base_url() ?>/app/js/app.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var nm_barang = $(this).data('nm_barang');
            var satuan = $(this).data('satuan');
            var id_barang = $(this).data('id_barang');
            var kd_barang = $(this).data('kd_barang');
            var kat_barang = $(this).data('kat_barang');
            $('#nm_barang').val(nm_barang);
            $('#satuan').val(satuan);
            $('#id_barang').val(id_barang);
            $('#kd_barang').val(kd_barang);
            $('#kat_barang').val(kat_barang);
            $('#modal-barang').modal('hide');
            $('#modal-tambah').modal('show');
        });

        $('#btn-tambah').hide();

        $(document).on('change', '#id_vendor', function() {
            if ($("#id_vendor option:selected").val() == '') {
                $('#btn-tambah').hide();
            } else {
                $('#btn-tambah').show();
            }

            $.post('detail/modal-vendor.php', {
                    ids: $(this).val()
                },
                function(data) {
                    $("#data-vendor").html(data);
                }
            );
        });

    })

    function closeModal() {
        $('#modal-tambah').modal('hide');
        $('#id_barang').val(null);
        $('#kd_barang').val(null);
        $('#nm_barang').val(null);
        $('#satuan').val(null);
        $('#kat_barang').val(null);
        $('#jumlah').val(null);
    }

    muncul();
    var data = "detail/tampil.php";

    function muncul() {
        $.post('detail/tampil.php', {
                id: $("#dataid").val()
            },
            function(data) {
                $("#data-barang").html(data);
            }
        );
    }


    $("#form-tambah").submit(function(e) {
        e.preventDefault();

        var dataform = $("#form-tambah").serialize();
        $.ajax({
            url: "detail/simpan.php",
            type: "POST",
            data: dataform,
            success: function(result) {
                var hasil = JSON.parse(result);
                if (hasil.hasil == "sukses") {
                    $('#modal-tambah').modal('hide');

                    $('#id_barang').val(null);
                    $('#kd_barang').val(null);
                    $('#nm_barang').val(null);
                    $('#satuan').val(null);
                    $('#kat_barang').val(null);
                    $('#jumlah').val(null);

                    muncul();
                } else if (hasil.hasil == 'duplikat') {
                    Swal.fire({
                        title: 'Gagal !',
                        text: 'Data Barang sudah di input !',
                        icon: 'error'
                    });
                } else if (hasil.hasil == 'jumlah') {
                    Swal.fire({
                        title: '',
                        text: 'Jumlah tidak boleh Kosong !',
                        icon: 'error'
                    });
                    $('#jumlah').focus();
                }
            }
        });
    });

    $(document).on('click', '#hapus', function(e) {
        e.preventDefault();

        swal.fire({
                title: 'Konfirmasi Hapus Data !',
                html: 'Data Akan Dihapus, Lanjutkan ?',
                icon: "warning",
                showCancelButton: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.post('detail/hapus.php', {
                            id: $(this).attr('data-id')
                        },
                        function(html) {
                            muncul();
                        }
                    );
                }
            });
    });

    $(document).on('click', '#edit', function(e) {
        e.preventDefault();

        $('#modal-edit').modal('show');

        $.post('detail/edit.php', {
                id: $(this).attr('data-id')
            },
            function(data) {
                $("#data-edit").html(data);
            }
        );
    });

    $("#form-edit").submit(function(e) {
        e.preventDefault();

        var dataform = $("#form-edit").serialize();
        $.ajax({
            url: "detail/update.php",
            type: "POST",
            data: dataform,
            success: function(result) {
                var hasil = JSON.parse(result);
                if (hasil.hasil == "sukses") {
                    $('#modal-edit').modal('hide');

                    $('#id_penerimaan_detail').val(null);
                    $('#id_barang').val(null);
                    $('#kd_barang').val(null);
                    $('#nm_barang').val(null);
                    $('#satuan').val(null);
                    $('#kat_barang').val(null);
                    $('#jumlah').val(null);

                    muncul();
                } else if (hasil.hasil == 'jumlah') {
                    Swal.fire({
                        title: '',
                        text: 'Jumlah tidak boleh Kosong !',
                        icon: 'error'
                    });
                    $('#jumlah').focus();
                }
            }
        });
    });
</script>
<?php
if (isset($_POST['submit'])) {
    $tanggal = $_POST['tanggal'];
    $id_vendor = $_POST['id_vendor'];
    $no_invoice = $_POST['no_invoice'];

    $tambah = $con->query("INSERT INTO penerimaan VALUES (
        '$kode',
        '$tanggal',
        '$id_vendor',
        '$no_invoice'
    )");

    if ($tambah) {
        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=tambah'>";
    }
}

?>
<?php
include "../../../../app/config.php";
$id = $_POST['id'];

$ed = mysqli_query($con, "SELECT * FROM pengeluaran_detail a LEFT JOIN barang b ON a.id_barang = b.id_barang LEFT JOIN kategori c ON b.id_kategori = c.id_kategori WHERE a.id_pengeluaran_detail = '$id' ")->fetch_array();
?>

<div class="card-body">
    <input type="hidden" name="id_pengeluaran_detail" id="id_pengeluaran_detail" value="<?= $id ?>">
    <div class="form-group row mb-3">
        <label class="col-sm-2 col-form-label">Kode Barang</label>
        <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="kd_barang" value="<?= $ed['kd_barang'] ?>" readonly>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label class="col-sm-2 col-form-label">Nama Barang</label>
        <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="nm_barang" value="<?= $ed['nm_barang'] ?>" readonly>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label class="col-sm-2 col-form-label">Kategori Barang</label>
        <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="kat_barang" value="<?= $ed['nm_kategori'] ?>" readonly>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label class="col-sm-2 col-form-label">Stok Tersedia</label>
        <div class="col-sm-10">
            <input type="number" class="form-control bg-light" id="stok" value="<?= $ed['stok'] ?>" readonly>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label class="col-sm-2 col-form-label">Jumlah</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $ed['jumlah'] ?>" required>
            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label class="col-sm-2 col-form-label">Satuan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="satuan" value="<?= $ed['satuan'] ?>" readonly>
        </div>
    </div>
    <div class="text-end">
        <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fas fa-times-circle me-1"></i>Batal</button>
        <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fas fa-save me-1"></i>Update</button>
    </div>
</div>
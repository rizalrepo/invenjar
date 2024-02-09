<?php
$kondisi = [
    '' => '-- Pilih --',
    'Bagus' => 'Bagus',
    'Rusak' => 'Rusak',
];
?>

<div class="modal fade" id="lapPenerimaan" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Penerimaan Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/penerimaan') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Vendor</label>
                                <select name="vendor" class="form-select" id="selectVendor" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM vendor ORDER BY id_vendor ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_vendor'] ?>"><?= $row['nm_vendor'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label fw-semibold">Bulan</label>
                            <select name="bulan" class="form-select bulanPenerimaan">
                                <option value="">-- Pilih --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label fw-semibold">Tahun</label>
                            <input type="number" class="form-control tahunPenerimaan" name="tahun">
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-grid">
                            <button type="submit" class="btn bg-primary text-white"><i class="fa fa-print me-1"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapJual" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Penjualan Sales per Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/penjualan') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Pilih Barang</label>
                                <select name="barang" class="form-select" id="selectBarang" style="width: 100%;" required>
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM pengiriman_detail a LEFT JOIN stok s ON a.id_stok = s.id_stok LEFT JOIN barang b ON s.id_barang = b.id_barang GROUP BY s.id_barang ORDER BY s.id_barang ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_barang'] ?>"><?= $row['nm_barang'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label fw-semibold">Bulan</label>
                            <select name="bulan" class="form-select bulanJual">
                                <option value="">-- Pilih --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label fw-semibold">Tahun</label>
                            <input type="number" class="form-control tahunJual" name="tahun">
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-grid">
                                <button type="submit" class="btn bg-primary text-white"><i class="fa fa-print me-1"></i> Cetak</button>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-grid">
                                <button type="submit" formaction="<?= base_url('view/laporan/grafik-penjualan') ?>" class="btn bg-primary text-white"><i class="fa fa-chart-bar me-1"></i> Grafik</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapJualSup" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Penjualan Barang per Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/penjualan-supplier') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Pilih Supplier</label>
                                <select name="supplier" class="form-select" id="selectJualSup" style="width: 100%;" required>
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM pengiriman_detail a LEFT JOIN stok s ON a.id_stok = s.id_stok LEFT JOIN barang b ON s.id_barang = b.id_barang LEFT JOIN supplier c ON b.id_supplier = c.id_supplier GROUP BY b.id_supplier ORDER BY b.id_supplier ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_supplier'] ?>"><?= $row['nm_supplier'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label fw-semibold">Bulan</label>
                            <select name="bulan" class="form-select bulanJualSup">
                                <option value="">-- Pilih --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label fw-semibold">Tahun</label>
                            <input type="number" class="form-control tahunJualSup" name="tahun">
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-grid">
                            <button type="submit" class="btn bg-primary text-white"><i class="fa fa-print me-1"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapBiaya" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Biaya Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/biaya') ?>">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="col-form-label fw-semibold">Bulan</label>
                            <select name="bulan" class="form-select bulanBiaya">
                                <option value="">-- Pilih --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label fw-semibold">Tahun</label>
                            <input type="number" class="form-control tahunBiaya" name="tahun">
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-grid">
                            <button type="submit" class="btn bg-primary text-white"><i class="fa fa-print me-1"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapRetur" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Retur Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/retur') ?>">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="col-form-label fw-semibold">Bulan</label>
                            <select name="bulan" class="form-select bulanRetur">
                                <option value="">-- Pilih --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label fw-semibold">Tahun</label>
                            <input type="number" class="form-control tahunRetur" name="tahun">
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-grid">
                            <button type="submit" class="btn bg-primary text-white"><i class="fa fa-print me-1"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapStok" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Stok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/stok') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label fw-semibold">Pilih Kondisi Barang</label>
                            <?= form_dropdown('kondisi', $kondisi, '', 'class="form-select" required') ?>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="d-grid">
                                <button type="submit" class="btn bg-primary text-white"><i class="fa fa-print me-1"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapMenipis" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Stok Menipis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/menipis') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label fw-semibold">Jumlah Kurang Dari</label>
                            <input type="number" class="form-control" name="stok" required>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-grid">
                            <button type="submit" class="btn bg-primary text-white"><i class="fa fa-print me-1"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapExpired" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Barang Expired</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/expired') ?>">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="col-form-label fw-semibold">Bulan</label>
                            <select name="bulan" class="form-select bulanExpired">
                                <option value="">-- Pilih --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label fw-semibold">Tahun</label>
                            <input type="number" class="form-control tahunExpired" name="tahun">
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-grid">
                            <button type="submit" class="btn bg-primary text-white"><i class="fa fa-print me-1"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="<?= base_url() ?>/assets/libs/jquery/jquery.min.js"></script>

<script>
    $(function() {
        $('#selectVendor').select2({
            dropdownParent: $('#lapPenerimaan')
        });

        $(".bulanPenerimaan").change(function() {
            if ($(".bulanPenerimaan option:selected").val() != '') {
                $('.tahunPenerimaan').prop('required', true);
            } else {
                $('.tahunPenerimaan').removeAttr('required');
            }
        });

        $('#selectBarang').select2({
            dropdownParent: $('#lapJual')
        });

        $(".bulanJual").change(function() {
            if ($(".bulanJual option:selected").val() != '') {
                $('.tahunJual').prop('required', true);
            } else {
                $('.tahunJual').removeAttr('required');
            }
        });

        $('#selectJualSup').select2({
            dropdownParent: $('#lapJualSup')
        });

        $(".bulanJualSup").change(function() {
            if ($(".bulanJualSup option:selected").val() != '') {
                $('.tahunJualSup').prop('required', true);
            } else {
                $('.tahunJualSup').removeAttr('required');
            }
        });

        $(".bulanBiaya").change(function() {
            if ($(".bulanBiaya option:selected").val() != '') {
                $('.tahunBiaya').prop('required', true);
            } else {
                $('.tahunBiaya').removeAttr('required');
            }
        });
        $(".bulanRetur").change(function() {
            if ($(".bulanRetur option:selected").val() != '') {
                $('.tahunRetur').prop('required', true);
            } else {
                $('.tahunRetur').removeAttr('required');
            }
        });
        $(".bulanExpired").change(function() {
            if ($(".bulanExpired option:selected").val() != '') {
                $('.tahunExpired').prop('required', true);
            } else {
                $('.tahunExpired').removeAttr('required');
            }
        });
    });
</script>
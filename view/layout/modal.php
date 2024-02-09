<div class="modal fade" id="lapBarang" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/barang') ?>">
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
                                <select name="vendor" class="form-select" id="selectVendorPenerimaan" style="width: 100%;">
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

<div class="modal fade" id="lapPengeluaran" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Pengeluaran Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/pengeluaran') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Keperluan</label>
                                <select name="keperluan" class="form-select" id="selectKeperluan" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM keperluan ORDER BY id_keperluan ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_keperluan'] ?>"><?= $row['nm_keperluan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label fw-semibold">Bulan</label>
                            <select name="bulan" class="form-select bulanPengeluaran">
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
                            <input type="number" class="form-control tahunPengeluaran" name="tahun">
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

<div class="modal fade" id="lapRekap" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Rekapitulasi Pengeluaran Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate method="GET" target="_blank" action="<?= base_url('view/laporan/rekapitulasi-pengeluaran') ?>">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="col-form-label fw-semibold">Bulan</label>
                            <select name="bulan" class="form-select bulanRekap">
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
                            <input type="number" class="form-control tahunRekap" name="tahun">
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

<script src="<?= base_url() ?>/assets/libs/jquery/jquery.min.js"></script>

<script>
    $(function() {
        $('#selectVendor').select2({
            dropdownParent: $('#lapBarang')
        });
        $('#selectVendorPenerimaan').select2({
            dropdownParent: $('#lapPenerimaan')
        });

        $(".bulanPenerimaan").change(function() {
            if ($(".bulanPenerimaan option:selected").val() != '') {
                $('.tahunPenerimaan').prop('required', true);
            } else {
                $('.tahunPenerimaan').removeAttr('required');
            }
        });

        $('#selectKeperluan').select2({
            dropdownParent: $('#lapPengeluaran')
        });

        $(".bulanPengeluaran").change(function() {
            if ($(".bulanPengeluaran option:selected").val() != '') {
                $('.tahunPengeluaran').prop('required', true);
            } else {
                $('.tahunPengeluaran').removeAttr('required');
            }
        });

        $(".bulanRekap").change(function() {
            if ($(".bulanRekap option:selected").val() != '') {
                $('.tahunRekap').prop('required', true);
            } else {
                $('.tahunRekap').removeAttr('required');
            }
        });
    });
</script>
<?php
include '../../app/config.php';

$no = 1;

$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
$keperluan = $_GET['keperluan'];

$cekbulan = isset($bulan);
$cektahun = isset($tahun);
$cekkeperluan = isset($keperluan);

$bln = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
);

if ($bulan == $cekbulan && $tahun == $cektahun && $keperluan == null) {
    $sql = mysqli_query($con, "SELECT * FROM pengeluaran a LEFT JOIN teknisi b ON a.id_teknisi = b.id_teknisi LEFT JOIN keperluan c ON a.id_keperluan = c.id_keperluan WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' ORDER BY tanggal ASC");

    $label = 'LAPORAN PENGELUARAN BARANG <br> Bulan : ' . $bln[date($bulan)] . ' ' . $tahun;
} else if ($bulan == null && $tahun == null && $keperluan == $cekkeperluan) {
    $sql = mysqli_query($con, "SELECT * FROM pengeluaran a LEFT JOIN teknisi b ON a.id_teknisi = b.id_teknisi LEFT JOIN keperluan c ON a.id_keperluan = c.id_keperluan WHERE a.id_keperluan = '$keperluan' ORDER BY tanggal DESC");

    $dt = $con->query("SELECT * FROM keperluan WHERE id_keperluan = '$keperluan'")->fetch_array();

    $label = 'LAPORAN PENGELUARAN BARANG <br> Keperluan : ' . $dt['nm_keperluan'];
} else if ($bulan == $cekbulan && $tahun == $cektahun && $keperluan == $cekkeperluan) {
    $sql = mysqli_query($con, "SELECT * FROM pengeluaran a LEFT JOIN teknisi b ON a.id_teknisi = b.id_teknisi LEFT JOIN keperluan c ON a.id_keperluan = c.id_keperluan WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' AND a.id_keperluan = '$keperluan' ORDER BY tanggal ASC");

    $dt = $con->query("SELECT * FROM keperluan WHERE id_keperluan = '$keperluan'")->fetch_array();

    $label = 'LAPORAN PENGELUARAN BARANG <br> Bulan : ' . $bln[date($bulan)] . ' ' . $tahun . '<br> Keperluan : ' . $dt['nm_keperluan'];
} else {
    $sql = mysqli_query($con, "SELECT * FROM pengeluaran a LEFT JOIN teknisi b ON a.id_teknisi = b.id_teknisi LEFT JOIN keperluan c ON a.id_keperluan = c.id_keperluan ORDER BY tanggal DESC");
    $label = 'LAPORAN PENGELUARAN BARANG';
}

require_once '../../assets/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengeluaran Barang</title>
</head>

<style>
    th {
        color: white;
    }
</style>

<body>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center">
                    <img src="<?= base_url('assets/images/logo.png') ?>" align="left" width="100">
                </td>
                <td align="center">
                    <h1>PT. TELKOM AKSES BANJARBARU</h1>
                    <h6>Jl. PM Noor, Kemuning, Kec. Banjarbaru Selatan, Kota Banjar Baru, Kalimantan Selatan 70714</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/images/pelengkap.png') ?>" align="right" width="100">
                </td>
            </tr>
        </table>
    </div>
    <hr style="margin-top: -5px">

    <h4 align="center">
        <?= $label ?><br>
    </h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table border="1" cellspacing="0" cellpadding="6" width="100%">
                    <thead>
                        <tr bgcolor="#AA4B5B" align="center">
                            <th>No</th>
                            <th>Data pengeluaran</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" valign="top" width="5%"><?= $no++; ?></td>
                                <td>
                                    <b>Kode</b> : <?= $data['id_pengeluaran'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Tanggal</b> : <?= tgl($data['tanggal']) ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Teknisi</b> : <?= $data['kd_teknisi'] . ' / ' . $data['nm_teknisi'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Keperluan</b> : <?= $data['nm_keperluan'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Keterangan</b> : <?= $data['ket'] ?>
                                    <hr style="margin: 3px 0;">

                                    <table border="1" cellspacing="0" cellpadding="6" width="100%" style="margin: 15px;">
                                        <thead>
                                            <tr bgcolor="#AA4B5B" align="center">
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori Barang</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no1 = 1;
                                            $jml = mysqli_query($con, "SELECT SUM(jumlah) FROM pengeluaran_detail WHERE id_pengeluaran = '$data[id_pengeluaran]' ")->fetch_array();

                                            $data1 = mysqli_query($con, "SELECT * FROM pengeluaran_detail a LEFT JOIN barang b ON a.id_barang = b.id_barang LEFT JOIN kategori c ON b.id_kategori = c.id_kategori WHERE a.id_pengeluaran = '$data[id_pengeluaran]' ");
                                            while ($tampil1 = mysqli_fetch_array($data1)) {
                                            ?>
                                                <tr>
                                                    <td align="center" width="5%"><?= $no1++; ?></td>
                                                    <td align="center"><?= $tampil1['kd_barang'] ?></td>
                                                    <td><?= $tampil1['nm_barang'] ?></td>
                                                    <td align="center"><?= $tampil1['nm_kategori'] ?></td>
                                                    <td align="center"><?= $tampil1['jumlah'] . ' ' . $tampil1['satuan'] ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr class="bg-light">
                                                <td align="center" colspan="4" class="fw-bold">Total Pengeluaran</td>
                                                <td align="center" class="fw-bold"><?= $jml['SUM(jumlah)'] ? $jml['SUM(jumlah)'] . ' Item' : '-' ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <br>
    <br>

    <br>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center" width="85%">
                </td>
                <td align="center">
                    <h6>
                        <?= tgl_indo(date('Y-m-d')) ?><br>
                        Mengetahui <br>
                        Kepala Gudang
                        <br><br><br><br><br>
                        ______________________<br>
                        <br>
                    </h6>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>
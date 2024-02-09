<?php
include '../../app/config.php';

$no = 1;

$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];

$cekbulan = isset($bulan);
$cektahun = isset($tahun);

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

if ($bulan == $cekbulan && $tahun == $cektahun) {
    $sql = $con->query("SELECT a.id_barang, SUM(a.jumlah) AS total FROM pengeluaran_detail a LEFT JOIN pengeluaran b ON a.id_pengeluaran = b.id_pengeluaran WHERE MONTH(b.tanggal) = '$bulan' AND YEAR(b.tanggal) = '$tahun' GROUP BY a.id_barang ORDER BY total DESC");

    $label = 'REKAPITULASI PENGELUARAN BARANG <br> Bulan : ' . $bln[date($bulan)] . ' ' . $tahun;
} else {
    $sql = $con->query("SELECT a.id_barang, SUM(a.jumlah) AS total FROM pengeluaran_detail a LEFT JOIN pengeluaran b ON a.id_pengeluaran = b.id_pengeluaran GROUP BY a.id_barang ORDER BY total DESC");

    $label = 'REKAPITULASI PENGELUARAN BARANG';
}

require_once '../../assets/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Rekapitulasi Pengeluaran Barang</title>
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
                    <img src="<?= base_url('assets/images/logo.png') ?>" align="left" height="100">
                </td>
                <td align="center">
                    <h1>PT. Telkom Akses Banjarbaru</h1>
                    <h6>Jl. Ir. P. M. Noor, Sungai Ulin, Kec. Banjarbaru Utara, Kota Banjarbaru, Kalimantan Selatan 70714</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/images/pelengkap.png') ?>" align="right" height="100">
                </td>
            </tr>
        </table>
    </div>
    <hr size="2px" color="black">

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
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori Barang</th>
                            <th>Vendor</th>
                            <th>Total Pengeluaran</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <?php $dt = $con->query("SELECT * FROM barang a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN vendor c ON a.id_vendor = c.id_vendor WHERE id_barang = '$data[id_barang]'")->fetch_array(); ?>
                                <td align="center"><?= $dt['kd_barang'] ?></td>
                                <td><?= $dt['nm_barang'] ?></td>
                                <td align="center"><?= $dt['nm_kategori'] ?></td>
                                <td align="center"><?= $dt['nm_vendor'] ?></td>
                                <td align="center"><b><?= $data['total'] . ' ' . $dt['satuan'] ?></b></td>
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
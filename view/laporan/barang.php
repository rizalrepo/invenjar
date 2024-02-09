<?php
include '../../app/config.php';

$no = 1;

$vendor = $_GET['vendor'];
$cekvendor = isset($vendor);

if ($vendor == $cekvendor) {
    $sql = mysqli_query($con, "SELECT * FROM barang a LEFT JOIN vendor b ON a.id_vendor = b.id_vendor LEFT JOIN kategori c ON a.id_kategori = c.id_kategori WHERE a.id_vendor = '$vendor' ORDER BY a.id_barang DESC");

    $dt = $con->query("SELECT * FROM vendor WHERE id_vendor = '$vendor' ")->fetch_array();
    $label = 'LAPORAN BARANG <br>Vendor : ' . strtoupper($dt['nm_vendor']);
} else {
    $sql = mysqli_query($con, "SELECT * FROM barang a LEFT JOIN vendor b ON a.id_vendor = b.id_vendor LEFT JOIN kategori c ON a.id_kategori = c.id_kategori ORDER BY a.id_barang DESC");

    $label = 'LAPORAN BARANG';
}

require_once '../../assets/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang</title>
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
                            <th>Satuan</th>
                            <th>Kategori Barang</th>
                            <th>Vendor</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td align="center"><?= $data['kd_barang'] ?></td>
                                <td><?= $data['nm_barang'] ?></td>
                                <td align="center"><?= $data['satuan'] ?></td>
                                <td align="center"><?= $data['nm_kategori'] ?></td>
                                <td align="center"><?= $data['nm_vendor'] ?></td>
                                <td align="center"><?= $data['stok'] . ' ' . $data['satuan'] ?></td>
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
<?php
require '../../../app/config.php';
include_once '../../layout/topbar.php';
include_once '../../layout/footer.php';

$id = $_GET['id'];
$data  = $con->query("SELECT * FROM penerimaan_detail WHERE id_penerimaan = '$id'");

$query = $con->query(" DELETE FROM penerimaan WHERE id_penerimaan = '$id' ");

if ($query) {
    while ($rw = $data->fetch_assoc()) {
        $con->query("UPDATE barang SET 
            stok = stok - '$rw[jumlah]'
            WHERE id_barang = '$cek[id_barang]'
        ");
    }
    $con->query("DELETE FROM penerimaan_detail WHERE id_penerimaan = '$id'");
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    echo "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}

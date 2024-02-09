<?php
include '../../../../app/config.php';

$id = $_POST['id'];

$data = $con->query("SELECT * FROM pengeluaran_detail WHERE id_pengeluaran_detail = '$id' ")->fetch_array();
$query = $con->query("DELETE FROM pengeluaran_detail WHERE id_pengeluaran_detail = '$id' ");
if ($query) {
    $con->query("UPDATE barang SET 
        stok = stok + '$data[jumlah]'
        WHERE id_barang = '$data[id_barang]'
    ");
    echo "Data Berhasil Dihapus";
} else {
    echo "Data Gagal Dihapus";
}

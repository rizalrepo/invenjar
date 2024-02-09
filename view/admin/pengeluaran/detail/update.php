<?php

include '../../../../app/config.php';

$id_pengeluaran_detail    = $_POST['id_pengeluaran_detail'];
$jumlah   = $_POST['jumlah'];

$cek = $con->query("SELECT * FROM pengeluaran_detail WHERE id_pengeluaran_detail = '$id_pengeluaran_detail'")->fetch_array();
$cekBarang = $con->query("SELECT * FROM barang WHERE id_barang = '$cek[id_barang]'")->fetch_array();

if (!$jumlah) {
    $data['hasil'] = 'jumlah';
} else if (($cekBarang['stok'] + $cek['jumlah']) < $jumlah) {
    $data['hasil'] = 'lebih';
} else {
    $update = $con->query("UPDATE pengeluaran_detail SET 
        jumlah = '$jumlah'
        WHERE id_pengeluaran_detail = '$id_pengeluaran_detail'
    ");

    if ($update) {
        $con->query("UPDATE barang SET 
            stok = stok + '$cek[jumlah]'
            WHERE id_barang = '$cek[id_barang]'
        ");
        $con->query("UPDATE barang SET 
            stok = stok - '$jumlah'
            WHERE id_barang = '$cek[id_barang]'
        ");
        $data['hasil'] = 'sukses';
    } else {
        $data['hasil'] = 'gagal';
    }
}


echo json_encode($data);

<?php

include '../../../../app/config.php';

$id_penerimaan_detail    = $_POST['id_penerimaan_detail'];
$jumlah   = $_POST['jumlah'];

$data = $con->query("SELECT * FROM penerimaan_detail WHERE id_penerimaan_detail = '$id_penerimaan_detail' ")->fetch_array();

if (!$jumlah) {
    $data['hasil'] = 'jumlah';
} else {
    $update = $con->query("UPDATE penerimaan_detail SET 
        jumlah = '$jumlah'
        WHERE id_penerimaan_detail = '$id_penerimaan_detail'
    ");

    if ($update) {
        $con->query("UPDATE barang SET stok = stok - '$data[jumlah]' WHERE id_barang = '$data[id_barang]' ");
        $con->query("UPDATE barang SET stok = stok + '$jumlah' WHERE id_barang = '$data[id_barang]' ");
        $data['hasil'] = 'sukses';
    } else {
        $data['hasil'] = 'gagal';
    }
}

echo json_encode($data);

<?php

include '../../../../app/config.php';

$id_penerimaan    = $_POST['id_penerimaan'];
$id_barang   = $_POST['id_barang'];
$jumlah   = $_POST['jumlah'];

$cek = mysqli_num_rows(mysqli_query($con, "SELECT * FROM penerimaan_detail WHERE id_penerimaan = '$id_penerimaan' AND id_barang = '$id_barang' "));

if (!$jumlah) {
    $data['hasil'] = 'jumlah';
} else if ($cek > 0) {
    $data['hasil'] = 'duplikat';
} else {
    $tambah = $con->query("INSERT INTO penerimaan_detail VALUES (
        default,
        '$id_penerimaan', 
        '$id_barang',
        '$jumlah'
    )");

    if ($tambah) {

        $con->query("UPDATE barang SET stok = stok + '$jumlah' WHERE id_barang = '$id_barang' ");

        $data['hasil'] = 'sukses';
    } else {
        $data['hasil'] = 'gagal';
    }
}
echo json_encode($data);

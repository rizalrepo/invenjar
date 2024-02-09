<?php

include '../../../../app/config.php';

$id_pengeluaran    = $_POST['id_pengeluaran'];
$id_barang   = $_POST['id_barang'];
$jumlah   = $_POST['jumlah'];

$cek = mysqli_num_rows(mysqli_query($con, "SELECT * FROM pengeluaran_detail WHERE id_pengeluaran = '$id_pengeluaran' AND id_barang = '$id_barang' "));

$cekBarang = $con->query("SELECT * FROM barang WHERE id_barang = '$id_barang'")->fetch_array();

if (!$jumlah) {
    $data['hasil'] = 'jumlah';
} else if ($cek > 0) {
    $data['hasil'] = 'duplikat';
} else if ($cekBarang['stok'] < $jumlah) {
    $data['hasil'] = 'lebih';
} else {
    $tambah = $con->query("INSERT INTO pengeluaran_detail VALUES (
        default,
        '$id_pengeluaran', 
        '$id_barang',
        '$jumlah'
    )");

    if ($tambah) {
        $con->query("UPDATE barang SET 
            stok = stok - '$jumlah'
            WHERE id_barang = '$id_barang'
        ");
        $data['hasil'] = 'sukses';
    } else {
        $data['hasil'] = 'gagal';
    }
}
echo json_encode($data);

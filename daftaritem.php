<?php
require 'koneksi.php';

$barcode = $_GET["barcode"];
$cari_item = mysqli_query($konek,"SELECT * FROM item WHERE barcode='$barcode'");
$data_itemnya = mysqli_fetch_assoc($cari_item);
$data = array(
    'barcode_kode' => $data_itemnya["barcode"],
    'barcode_nama' => $data_itemnya["nama"]
);
echo json_encode($data);
?>

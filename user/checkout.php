<?php
session_start();

require_once('../koneksi.php');

$id_user = ($_POST['id_user'] != '' ? $_POST['id_user'] : '');

if(!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
	echo "Keranjang masih kosong.";
}

if(!empty($id_user)) {
	if(count($_SESSION['cart']) == 0) {
		echo "Keranjang masih kosong.";
	} else {
		$order = mysqli_query($koneksi, "INSERT INTO tb_order (id_user) VALUES ('$id_user')");
		$last_id = $koneksi->insert_id;

		foreach($_SESSION['cart'] as $key => $value) {
			$id_obat = $value['id_obat'];
			$qty = $value['qty'];

			mysqli_query($koneksi, "INSERT INTO detail_order (id_order, id_obat, jumlah) VALUES ($last_id, '$id_obat', '$qty')");
		
		}
			echo "Transaksi Berhasil";
		unset($_SESSION['cart']);
	}
} else {
	echo "Anda harus login terlebih dahulu.";
}
<?php
session_start();

foreach($_SESSION['cart'] AS $key => $value) {
	if(in_array($_POST['id_obat'], $value)) {
		if($value['id_obat'] === $_POST['id_obat']) {
			$_SESSION['cart'][$key]['qty'] = $_POST['qty'];
			echo "Keranjang berhasil diupdate.";
		}
	}
}
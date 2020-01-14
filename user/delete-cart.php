<?php
session_start();

foreach($_SESSION['cart'] AS $key => $value) {
	if(in_array($_POST['id_obat'], $value)) {
		if($value['id_obat'] === $_POST['id_obat']) {
			unset($_SESSION['cart'][$key]);
			echo "Keranjang berhasil dihapus.";
		}
	}
}
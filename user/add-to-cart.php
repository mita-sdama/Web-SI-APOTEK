<?php
session_start();

require_once('../koneksi.php');

$obat = mysqli_query($koneksi, "SELECT * FROM obat WHERE id_obat = '$_POST[id_obat]'");
$row = mysqli_fetch_array($obat);

if(!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}

$new = 1;

if(count($_SESSION['cart']) == 0) {
	array_push($_SESSION['cart'], array('id_obat' => $_POST['id_obat'], 'qty' => 1));
	echo "Berhasil ditambahkan ke keranjang.";
} else {
	foreach($_SESSION['cart'] as $key => $value) {
		if(in_array($_POST['id_obat'], $value)) {
			if($value['id_obat'] === $_POST['id_obat']) {
				$new = 0;

				if($value['qty'] >= $row['stok']) {
					$qty = $value['qty'];
				} else {
					$qty = $value['qty'] + 1;
				}

				$_SESSION['cart'][$key]['qty'] = $qty;
				echo "Berhasil ditambahkan ke keranjang.";
			}
		}
	}

	if($new) {
		array_push($_SESSION['cart'], array('id_obat' => $_POST['id_obat'], 'qty' => 1));
		echo "Berhasil ditambahkan ke keranjang.";
	}
}
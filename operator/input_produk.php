<?php
include("../koneksi.php");

$id_obat = $_POST['id_obat'];
$id_kategori = $_POST['id_kategori'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];
$nama_file = $_FILES['gambar']['name'];
$lokasi_gambar = $_FILES['gambar']['tmp_name'];
$produk_name = date('d-m-Y-H-i-s').$nama_file;
$folder = "../data_img/$produk_name";

if (!empty($_FILES['gambar']['name'])) {
if (move_uploaded_file($lokasi_gambar,"$folder")) {
	$query = "INSERT INTO obat VALUES ('$id_obat','$id_kategori','$nama','$produk_name','$harga','$stok','$deskripsi')";
}else{
	echo "gambar gagal diupload";
}
}else{
	$query = "INSERT INTO obat VALUES ('$id_obat','$id_kategori','$nama','$harga','$stok','$deskripsi')";
}
	$sql = mysqli_query($koneksi,$query);


	if ($sql) {
		header("location:produk.php");
	}else{
		echo "tambah data gagal";
	}

?>
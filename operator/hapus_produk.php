<?php
include("../koneksi.php");
$id = $_GET['id'];

$query = "SELECT FROM obat WHERE id_obat='$id'";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
if (is_file("../data_img/".$data['gambar'])) {
	unlink("../data_img/".$data['gambar']);
}

$hapus = "DELETE FROM obat WHERE id_obat='$id'";
$hasil2= mysqli_query($koneksi,$hapus);


if ($hasil2) {
	header("location:produk.php");
}else{
	echo "hapus data gagal";
}

?>
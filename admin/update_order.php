<?php
$koneksi= mysqli_connect("localhost","root","","gopotik");

$id_order = $_GET['id'];
$status = $_GET['status'];

mysqli_query($koneksi,"UPDATE tb_order SET status = '$status' WHERE id_order='$id_order'");
$query = mysqli_query($koneksi, "SELECT * FROM detail_order  INNER JOIN obat ON obat.id_obat = detail_order.id_obat WHERE id_order = $_GET[id]");
while($row = mysqli_fetch_array($query)){
$id_obat = $row['id_obat'];
if ($_GET['status'] == 'lunas') {
	
  $stok_akhir = $row['stok'] - $row['jumlah'];
	 
}
if ($_GET['status'] == 'baru') {
	
  $stok_akhir = $row['stok'] + $row['jumlah'];
	 
}

if ($_GET['status'] == '') {
	$stok_akhir=$row['stok'];
}
$update = mysqli_query($koneksi, "UPDATE obat SET stok ='$stok_akhir' WHERE id_obat = '$id_obat'");
echo "$stok_akhir";
}
header("location:order.php");



?>
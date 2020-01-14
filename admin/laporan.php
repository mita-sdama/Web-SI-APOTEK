<?php
$konek = mysqli_connect("localhost","root","","gopotik");

$content='
<style type="text/css">
.tabel{
	border-collapse:collapse;
}
.tabel th{ 
	padding-left:38px;
	padding-top:15px;
	padding-bottom:15px;
	padding-right:38px;
	background-color:#5bc0de; 
	color:#fff; 
}
.tabel td{
	padding:15px;
}
.tot{
	background-color:#5bc0de; 
}
.nil{
	background-color:orange; 
}
</style>
';


$content .= '
<page>
<div align="center">
<table width="100%">
<tr>
<td style="padding-left:50px; padding-top:15px;"><img src="images/hospitala.jpg"></td>
<td style="padding-left:50px;"> 
<h1> LAPORAN TRANSAKSI  </h1>
<img src="images/logo.jpg" style="width:200px;"> </td>
<td style="padding-left:50px; padding-top:20px;"><img src="images/ico.png"></td>
</tr>
</table>
<hr style="border:2px #5bc0de solid; ">

<div style="padding:5px;">
</div>

<table border="1px" class="tabel" align="center">
<tr>
	<th> No </th>
	<th> Tanggal </th>
	<th> nama </th>
	<th> jumlah</th>
	<th> Harga </th>
	<th> Total </th>
</tr>';

	$tampil = "SELECT * FROM detail_order INNER JOIN obat ON obat.id_obat=detail_order.id_obat INNER JOIN tb_order ON tb_order.id_order = detail_order.id_order WHERE tb_order.status='lunas'";
	$hasil = mysqli_query($konek, $tampil);
	$total = mysqli_num_rows($hasil);
	$jml=0;
	$no = 1;
	while ($data=mysqli_fetch_array($hasil)){
		$content .= '
			<tr>
				<td> '.$no.'</td>
				<td> '.$data['tanggal_transaksi'].'</td>
				<td> '.$data['nama'] .'</td>
				<td> '.$data['jumlah'].'</td>
				<td> Rp.'.$data['harga'].'</td>
				<td> Rp.'.$data['jumlah']*$data['harga'].'</td>
				</tr>

		';

		$no++;
		
		 $jml += ($data['jumlah']*$data['harga']);
	}
	
		$content .= '
		<tr>
		<td colspan="5" class="tot"> <b>Total</b> </td>
		<td class="nil"> <b>Rp.'.$jml.'</b></td>
		</tr>
		';
	
	$content .='
</table>
</div>
</page>';
require_once('html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF ('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('laporan_transaksi.pdf');
?>
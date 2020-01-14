<?php
include("../koneksi.php");
$id = $_GET['id_order'];
$edit = "SELECT * FROM tb_order WHERE id_order='$id'";
$hasil = mysqli_query($koneksi,$edit);
$data = mysqli_fetch_array($hasil);
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Detail Order</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="update_order.php" name="modal-popup" method="GET">
                <div class="form-group">
                    
                </div>
                
                <div class="form-group">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        ID Order
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        :
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <?php echo $id ?>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        Tanggal Transaksi
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        :
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        
                        <?php echo "$data[tanggal_transaksi]"; ?>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        Ubah Status
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        :
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        
                        <?php
                            if($data['status'] == "baru"){
                            ?>
                            <label>
                            <?php
                            echo "<input type='radio' name='status' value='lunas' checked='checked'>Lunas";
                            
                            ?>
                            </label>
                            <label>
                            <?php
                            // echo "<input type='radio' name='status' value='Y' checked='checked'>Y";
                            ?>
                            </label>
                            <?php
                            }else{
                                ?>
                            <label>
                            <?php
                            // echo "<input type='radio' name='status' value='N' checked='checked'> N";
                            ?>
                            </label>
                            <label>
                            <?php
                             echo "<input type='radio' name='status' value='baru' checked='checked'> Baru";
                           
                            ?>
                            </label>
                            <?php
                            }
                            ?>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        
                    </div>
                    
                </div>
                <p></p>
                <!-- tabel produk yang dbeli -->
                <table class="table table-bordered table-hover">
                    <thead style="background-color: #69aae0;color: #ffffff;">
                        <tr>
                            <th>Nama Poduk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Sub total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $detail = "SELECT obat.nama,detail_order.jumlah,harga FROM detail_order INNER JOIN obat ON obat.id_obat=detail_order.id_obat
                        INNER JOIN tb_order ON tb_order.id_order=detail_order.id_order WHERE tb_order.id_order=$id";
                        $has1 = mysqli_query($koneksi,$detail);
                        while ($dat1=mysqli_fetch_array($has1)) {
                        echo "
                        <tr style=\"font-size:11px;\">
                            
                            <td> $dat1[nama]</td>
                            <td> $dat1[jumlah]</td>
                            <td> Rp.$dat1[harga]</td>
                            <td> Rp.".($dat1['jumlah']*$dat1['harga'])."</td>
                            
                            
                            ";
                            $total = $total+($dat1['jumlah']*$dat1['harga']);
                            
                            }
                            
                            ?>
                            
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><b><?php echo "Total :Rp.".$total; ?></b></td>
                        </tr>
                        <table class="table table-bordered table-hover">
                            <thead  style="background-color: #69aae0;color: #ffffff;">
                                <tr>
                                    <th colspan="2">DATA KUSTOMER</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $kustomer = "SELECT * FROM user,tb_order WHERE user.id_user= tb_order.id_user AND id_order='$id'";
                                $has2 = mysqli_query($koneksi,$kustomer);
                                $dat2 = mysqli_fetch_array($has2);
                                ?>
                                <tr>
                                    <td>Nama </td>
                                    <td><?php echo "$dat2[nama]"; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat </td>
                                    <td><?php echo "$dat2[alamat]"; ?></td>
                                </tr>
                                <tr>
                                    <td>No.Telp </td>
                                    <td><?php echo "$dat2[no_telepon]"; ?></td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td> <?php echo "$dat2[email]"; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
";
?>
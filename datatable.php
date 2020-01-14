<html>
    <head>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">	
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h2 class="text-center">Data </h2>
            <div class="box-body table-responsive">
                <table id="dtbUser" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID User</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                           <?php
    include("koneksi.php");
    $tampil = "SELECT * FROM user ORDER BY id_user";
    $hasil = mysqli_query($koneksi,$tampil);
    while ($data=mysqli_fetch_array($hasil)) {
        echo "
        <tr>
            
            <td> $data[id_user]</td>
            <td> $data[username]</td>
            <td> $data[password]</td>
            <td> $data[nama]</td>
            <td> $data[jenis_kelamin]</td>
            <td> $data[email]</td>
            <td> $data[no_telepon]</td>
            <td> $data[alamat]</td>
            <td> $data[level]</td>
            <td> <a href=\"edit.php?id=$data[id_user]\">Edit</a>|<a href=\"hapus.php?id=$data[id_user]\">Hapus</a>
            </td>
        </tr>
        ";
        
    }  ?>                                      
                    </tbody>
                    <tfoot>
                        <!-- <tr>
                            <th>ID User</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr> -->
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div>	
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.js"></script>	
        <script type="text/javascript">
            $(function() {
                $('#dtbUser').dataTable();
            });
        </script>
    </body>
</html>
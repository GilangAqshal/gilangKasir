<?php
include 'config.php';

// Misalkan $currentUser adalah 'user' yang saat ini login
session_start();
if(isset($_SESSION['user'])) {
    $currentUser = $_SESSION['user']; // Mengambil 'user' yang sedang login dari session
} else {
    // Jika pengguna belum login, arahkan ke halaman login atau tampilkan pesan kesalahan
    echo "Anda belum login.";
    exit();
}

// Query untuk mengambil 'user' yang saat ini login dari tabel login
$sql = "SELECT user FROM login WHERE user = :user";

// Mempersiapkan statement SQL
$stmt = $config->prepare($sql);

// Bind parameter
$stmt->bindParam(':user', $currentUser, PDO::PARAM_STR);

// Menjalankan query
$stmt->execute();

// Mendapatkan hasil query
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Memeriksa apakah query berhasil dijalankan dan user yang saat ini login ditemukan
if ($result) {
    // Mendapatkan nilai user dari hasil query
    $user = $result['user'];
    // Menampilkan dashboard untuk user yang saat ini login
    echo "<h3>Dashboard $user</h3>";
} else {
    // Jika user yang saat ini login tidak ditemukan
    echo "User tidak ditemukan";
}
?>
<!-- <h3>DASHBOARD</h3> -->
<br/>
<?php 
	$sql=" select * from barang where stok <= 3";
	$row = $config -> prepare($sql);
	$row -> execute();
	$r = $row -> rowCount();
	if($r > 0){
?>

?>
<?php
		echo "
		<div class='alert alert-warning'>
			<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
			<span class='pull-right'><a href='petugas.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
		</div>
		";	
	}
?>
<?php $hasil_barang = $lihat -> barang_row();?>
<?php $hasil_kategori = $lihat -> kategori_row();?>
<?php $stok = $lihat -> barang_stok_row();?>
<?php $jual = $lihat -> jual_row();?>
<!-- INI DASHBOAADR GILANG -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nama Barang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($hasil_barang);?></div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-cubes fa-bold fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
            </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4"> 
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Stock</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($stok['jml']);?></div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-chart-bar fa-bold fa-2x text-gray-300"></i>
                    </div>
                </div>              
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Telah Terjual</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format($jual['stok']);?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 13%" aria-valuenow="13" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-upload fa-bold fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kategori Barang</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($hasil_kategori);?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bookmark fa-bold fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <!-- INI IMAGE BELUM NAMPIL -->

                         <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="admin/template/img/parfum.jpg" class="img-fluid rounded" alt="parfum">
                                </div>
                                <div class="col-md-3">
                                    <img src="admin/template/img/parfum.jpg" class="img-fluid rounded" alt="parfum">
                                </div>
                                <div class="col-md-3">
                                    <img src="admin/template/img/parfum.jpg" class="img-fluid rounded" alt="parfum">
                                </div>
                                <div class="col-md-3">
                                    <img src="admin/template/img/parfum.jpg" class="img-fluid rounded" alt="parfum">
                                </div>
                            </div>
                        </div> 

                    <!-- INI AKHIR IMAGE -->
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>
                    <?php echo date('Y');?> - SMK PRESTASI PRIMA |
                    BY <b><a href="http://localhost/GilangPortofolio/index.html" target="_blank">Gilang Aqsahl Ilham Safatulloh</a></b>
                </span>
            </div>
        </div>
    </footer>
<!-- INI AKHIR DASHBOARD -->

<!-- 
<div class="row">
    
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Nama Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_barang);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='petugas.php?page=barang'>Tabel
                    Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        
    </div> -->
    <!-- STATUS cardS -->
    <!-- <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Stok Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($stok['jml']);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='petugas.php?page=barang'>Tabel
                    Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        
    </div> -->
    <!-- STATUS cardS -->
    <!-- <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Telah Terjual</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($jual['stok']);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='petugas.php?page=laporan'>Tabel
                    laporan <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        
    </div>
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Kategori Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_kategori);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='petugas.php?page=kategori'>Tabel
                    Kategori <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
  
    </div>

</div>

    </div>
    
    <div class="container">
                    <img src="img/royal.jpg" class="rounded float-start mr-1" alt="parfum" style="margin-right: 10px;">
                    <img src="img/emperor.jpg" class="rounded center mx-1" alt="parfum" style="margin: 0 5px;">
                    <img src="img/flit.jpg" class="rounded float-end ml-1" alt="parfum" style="margin-left: 10px;">
                </div>
    </div> -->
    <!-- End of Main Content --> 
    <!-- Footer -->
    <!-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>
                    <?php echo date('Y');?> - SMK PRESTASI PRIMA |
                    BY <b><a href="https://github.com/GilangAqshal" target="_blank">Gilang Aqsahl Ilham Safatulloh</a></b>
                </span>
            </div>
        </div>
    </footer> -->
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin/js/sb-admin-2.min.js"></script>
    <script src="sb-admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="sb-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
    //datatable
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable();
    });
   </script>
   <?php
        $sql=" select * from barang where stok <=3";
        $row = $config -> prepare($sql);
        $row -> execute();
        $q = $row -> fetch();
            if($q['stok'] == 3){	
            if($q['stok'] == 2){	
            if($q['stok'] == 1){	
    ?>
   <script type="text/javascript">
    //template
    $(document).ready(function() {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Peringatan !',
            // (string | mandatory) the text inside the notification
            text: 'stok barang ada yang tersisa kurang dari 3 silahkan pesan lagi !',
            // (string | optional) the image to display on the left
            image: 'assets/img/seru.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'

        });

        return false;
    });
   </script>
   <?php }}}?>
   <script type="application/javascript">
    //angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-danger").fadeIn('slow');
        }, 500);
    });
    //angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
    setTimeout(function() {
        $(".alert-danger").fadeOut('slow');
    }, 5000);

    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-success").fadeIn('slow');
        }, 500);
    });
    setTimeout(function() {
        $(".alert-success").fadeOut('slow');
    }, 5000);

    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-warning").fadeIn('slow');
        }, 500);
    });
    setTimeout(function() {
        $(".alert-success").fadeOut('slow');
    }, 5000);
   </script>
   <script>
    $(".modal-create").hide();
    $(".bg-shadow").hide();
    $(".bg-shadow").hide();

    function clickModals() {
        $(".bg-shadow").fadeIn();
        $(".modal-create").fadeIn();
    }

    function cancelModals() {
        $('.modal-view').fadeIn();
        $(".modal-create").hide();
        $(".bg-shadow").hide();
    }
   </script>

   </body>

   </html>
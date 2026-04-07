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
			<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
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
            <img src="admin/template/img/royal.jpg" class="img-fluid rounded" alt="parfum">
        </div>
        <div class="col-md-3">
            <img src="admin/template/img/karma.jpg" class="img-fluid rounded" alt="parfum">
        </div>
        <div class="col-md-3">
            <img src="admin/template/img/rascal.jpg" class="img-fluid rounded" alt="parfum">
        </div>
        <div class="col-md-3">
            <img src="admin/template/img/flit.jpg" class="img-fluid rounded" alt="parfum">
        </div>
    </div>
</div>

                <!-- INI AKHIR IMAGE -->
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

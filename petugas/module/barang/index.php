        <h4>Data Barang</h4>
        <br />
        <?php if(isset($_GET['success-stok'])){?>
        <div class="alert alert-success">
            <p>Tambah Stok Berhasil !</p>
        </div>
        <?php }?>
        <?php if(isset($_GET['success'])){?>
        <div class="alert alert-success">
            <p>Tambah Data Berhasil !</p>
        </div>
        <?php }?>
        <?php if(isset($_GET['remove'])){?>
        <div class="alert alert-danger">
            <p>Hapus Data Berhasil !</p>
        </div>
        <?php }?>

        <?php 
			$sql=" select * from barang where stok <= 3";
			$row = $config -> prepare($sql);
			$row -> execute();
			$r = $row -> rowCount();
			if($r > 0){
				echo "
				<div class='alert alert-warning'>
					<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
					<span class='pull-right'><a href='petugas.php?page=barang&stok=yes'>Cek Barang <i class='fa fa-angle-double-right'></i></a></span>
				</div>
				";	
			}
		?>
        <!-- Trigger the modal with a button -->
        <!-- Ubah Form Pencarian Kategori menjadi AJAX -->
<div class="button-container">
    <div class="flex-start">
        <button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Insert Data</button>
        <a href="petugas.php?page=barang" class="btn btn-success btn-md mr-2">
            <i class="fa fa-refresh"></i> Refresh Data</a>
    </div>

    <div class="flex-end">
        <form id="searchForm" class="form-inline">
            <div class="form-group mr-2">
                <select class="form-control" id="kategori" name="kategori">
                    <option value="">Pilih Kategori</option>
                    <?php $kategori = $lihat->kategori(); ?>
                    <?php foreach ($kategori as $kat) : ?>
                        <option value="<?php echo $kat['id_kategori']; ?>"><?php echo $kat['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" id="btnSearch" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
        </form>
    </div>
</div>

<!-- Tabel untuk menampilkan hasil pencarian -->
<div id="hasilPencarian">
    <!-- Tampilkan data sesuai hasil pencarian di sini -->
</div>

<script>
    // Tangani klik tombol "Cari" dengan AJAX
    document.getElementById('btnSearch').addEventListener('click', function() {
        var selectedCategory = document.getElementById('kategori').value;
        // Kirim permintaan AJAX ke server
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Tangani respons dari server
                    document.getElementById('hasilPencarian').innerHTML = xhr.responseText;
                } else {
                    console.error('Terjadi kesalahan: ' + xhr.status);
                }
            }
        };
        // Buat dan kirim permintaan AJAX
        xhr.open('GET', 'proses_pencarian.php?kategori=' + selectedCategory, true);
        xhr.send();
    });
</script>

        <br />
        <!-- view barang -->
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="example1">
                    <thead>
                    <tr class="bg-primary text-white">
                            <th>No.</th>
                            <th>ID Barang</th>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Merk</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
						$totalBeli = 0;
						$totalJual = 0;
						$totalStok = 0;
						if($_GET['stok'] == 'yes')
						{
							$hasil = $lihat -> barang_stok();

						}else{
							$hasil = $lihat -> barang();
						}
						$no=1;
						foreach($hasil as $isi) {
					?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $isi['id_barang'];?></td>
                            <td><?php echo $isi['nama_kategori'];?></td>
                            <td><?php echo $isi['nama_barang'];?></td>
                            <td><?php echo $isi['merk'];?></td>
                            <td>
                                <?php if($isi['stok'] == '0'){?>
                                <button class="btn btn-danger"> Habis</button>
                                <?php }else{?>
                                <?php echo $isi['stok'];?>
                                <?php }?>
                            </td>
                            <td>Rp.<?php echo number_format($isi['harga_beli']);?>,-</td>
                            <td>Rp.<?php echo number_format($isi['harga_jual']);?>,-</td>
                            <td> <?php echo $isi['satuan_barang'];?></td>
                            <td>
                                <?php if($isi['stok'] <=  '3'){?>
                                <form method="POST" action="petugasfungsi/edit/edit.php?stok=edit">
                                    <input type="text" name="restok" class="form-control">
                                    <input type="hidden" name="id" value="<?php echo $isi['id_barang'];?>"
                                        class="form-control">
                                    <button class="btn btn-primary btn-sm">
                                        Restok
                                    </button>
                                    <a href="petugasfungsi/hapus/hapus.php?barang=hapus&id=<?php echo $isi['id_barang'];?>"
                                        onclick="javascript:return confirm('Hapus Data barang ?');">
                                        <button class="btn btn-danger btn-sm">Hapus</button></a>
                                </form>
                                <?php }else{?>
                            

                                <a href="petugas.php?page=barang/edit&barang=<?php echo $isi['id_barang'];?>"><button
                                        class="btn btn-warning btn-xs">Edit</button></a>
                                <a href="petugasfungsi/hapus/hapus.php?barang=hapus&id=<?php echo $isi['id_barang'];?>"
                                    onclick="javascript:return confirm('Hapus Data barang ?');"><button
                                        class="btn btn-danger btn-xs">Hapus</button></a>
                                <?php }?>
                        </tr>
                        <?php 
							$no++; 
							$totalBeli += $isi['harga_beli'] * $isi['stok']; 
							$totalJual += $isi['harga_jual'] * $isi['stok'];
							$totalStok += $isi['stok'];
						}
					?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">Total </td>
                            <th><?php echo $totalStok;?></td>
                            <th>Rp.<?php echo number_format($totalBeli);?>,-</td>
                            <th>Rp.<?php echo number_format($totalJual);?>,-</td>
                            <th colspan="2" style="background:#ddd"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
       
        <!-- end view barang -->
        <!-- tambah barang MODALS-->
        <!-- Modal -->

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style=" border-radius:0px;">
                <div class="modal-header" style="background:blue;color:#fff;">
                        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="petugasfungsi/tambah/tambah.php?barang=tambah" method="POST">
                        <div class="modal-body">
                            <table class="table table-striped bordered">
                                <?php
									$format = $lihat -> barang_id();
								?>
                                <tr>
                                    <td>ID Barang</td>
                                    <td><input type="text" readonly="readonly" required value="<?php echo $format;?>"
                                            class="form-control" name="id"></td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>
                                        <select name="kategori" class="form-control" required>
                                            <option value="#">Pilih Kategori</option>
                                            <?php  $kat = $lihat -> kategori(); foreach($kat as $isi){ 	?>
                                            <option value="<?php echo $isi['id_kategori'];?>">
                                                <?php echo $isi['nama_kategori'];?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Barang</td>
                                    <td><input type="text" placeholder="Nama Barang" required class="form-control"
                                            name="nama"></td>
                                </tr>
                                <tr>
                                    <td>Merk Barang</td>
                                    <td><input type="text" placeholder="Merk Barang" required class="form-control"
                                            name="merk"></td>
                                </tr>
                                <tr>
                                    <td>Harga Beli</td>
                                    <td><input type="number" placeholder="Harga beli" required class="form-control"
                                            name="beli"></td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td><input type="number" placeholder="Harga Jual" required class="form-control"
                                            name="jual"></td>
                                </tr>
                                <tr>
                                    <td>Satuan Barang</td>
                                    <td>
                                        <select name="satuan" class="form-control" required>
                                            <option value="Botol">Botol</option>
                                            <option value="PCS">PCS</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td><input type="number" required Placeholder="Stok" class="form-control"
                                            name="stok"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Input</td>
                                    <td><input type="text" required readonly="readonly" class="form-control"
                                            value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                                Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
<?php

session_start();

$koneksi = mysqli_connect("localhost","root","","tb_ldkom"); 

date_default_timezone_set('Asia/Jakarta');

if($_SESSION['role']!="Kepala Ldkom"){
	header("location:../login.php?pesan=logindulu");
}

// $tgl = date("Y-m-d");
$tgl = date("Y-m-d", strtotime("2021-08-16"));


// $jam = date("H:i:s");
$jam = date("H:i:s", strtotime("08:00:00"));
$j_batas = date("H:i:s", strtotime("07:46:00"));

if ($jam>=$j_batas) {
	// $hari = date('l');
	$hari = 'Monday';
	// $tgl = date("Y-m-d");
	$tgl = date("Y-m-d", strtotime("2021-08-16"));


	$harii = array('Monday' => '1', 'Tuesday' => '2', 'Wednesday' => '3', 'Thursday' => '4', 'Friday' => '5', 'Saturday' => '6', 'Sunday' => '7');

	$kode_hari = $harii[$hari];

	$query = mysqli_query($koneksi, "select * from jadwal_user where kode_hari='$kode_hari'");

	while ($tampil = mysqli_fetch_array($query)) {

		$no_anggota = $tampil['no_anggota'];

		$query1 = mysqli_query($koneksi, "select * from absen where no_anggota='$no_anggota' and tanggal='$tgl'");

		if (mysqli_affected_rows($koneksi) == 0) {
			$query2 = mysqli_query($koneksi, "insert into absen(tanggal, no_anggota, keterangan) values('$tgl','$no_anggota','Tidak Hadir')");		
		}else{
		}

	}	
}

if (isset($_POST['ubahketerangan'])) {
	$tanggal = $_POST['tanggal'];
	$no_anggota = $_POST['no_anggota'];
	$keterangan = $_POST['keterangan'];

	$query = mysqli_query($koneksi, "update absen set keterangan = '$keterangan' where tanggal='$tanggal' and no_anggota='$no_anggota'");

	if ($query) {
		$berhasil = "Keterangan telah diperbarui";
	}else{
		$gagal = "Gagak memperbarui keterangan";
	}	
}


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
	<title>Tamu</title>
</head>
<body style="background: url(../gambar/bggbr.jpg); background-size: cover; background-repeat: no-repeat;">
	<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
		<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
		</symbol>
		<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
		</symbol>
		<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
		</symbol>
	</svg>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #b3b3b3;" aria-label="Eleventh navbar example">
		<div class="container-fluid" style="background-color: white;">
			<div class="collapse navbar-collapse" style="background-color: white;">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<img src="../gambar/logoldkom1.png" style="width: 50px; height: 40px;">
					</li>
					<li class="nav-item">
						<h5 class="mt-2 me-3">LDKOM JSI</h5>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="home_admin.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tamu.php">Tamu</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="asisten.php">Asisten</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">Piket</a>
						<ul class="dropdown-menu" aria-labelledby="dropdown09">
							<li><a class="dropdown-item" href="jadwal.php">Jadwal</a></li>
							<li><a class="dropdown-item" href="absen.php">Absen</a></li>
						</ul>
					</li>					
				</ul>
				<form>
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"><img src="../gambar/<?php echo $_SESSION['foto']; ?>" class="me-2" style="width: 25px; height: 25px; border-radius: 30px;"><?php echo $_SESSION['nama']; ?></a>
							<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown09">
								<li><a class="dropdown-item" href="profil.php">Profil</a></li>
								<li><a class="dropdown-item" href="gpassword.php">Ganti Password</a></li>
								<li><a class="dropdown-item" href="../logout.php" onclick="return confirm('Apakah Anda yakin ingin Log Out?')">Log Out</a></li>
							</ul>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</nav>	
	<div class="container" style="background-color: white;	 border-radius: 30px; width: 80%;">
		<div class="row py-5 mt-4 align-items-center">

			<center>
				<h1 class="mb-5">Tabel Absen</h1>
<!-- 				<?php  

				if (isset($_POST['lihat'])) {
					$bulann = $_POST['bulan'];
					$tahunn = $_POST['tahun'];
					$no_anggota = $_POST['no_anggota'];	
					if (empty($_POST["no_anggota"]) && empty($_POST["bulan"]) && empty($_POST["tahun"])) {
						echo "<h5 class='mb-3'>Semua</h5>";
					}else{
						if (empty($_POST["no_anggota"])) {
							if (empty($_POST["bulan"]) || empty($_POST["tahun"])) {
								echo "<h5 class='mb-3'>Semua</h5>";
								$gagal = "Bulan dan tahun harus dipilih secara bersamaan!!";
							}else{
								echo "<h5 class='mb-3'>Tahun : ".$tahunn." Bulan : ".$bulann."</h5>";	
							}
						}else{
							if (empty($_POST["bulan"]) && empty($_POST["tahun"])) {
								
								echo "<h5 class='mb-3'>Nomor Anggota : ".$no_anggota."</h5>";
							}else if(empty($_POST["bulan"]) || empty($_POST["tahun"])){
								echo "<h5 class='mb-3'>Semua</h5>";
								$gagal = "Bulan dan tahun harus dipilih secara bersamaan!!";
							}else if(!empty($_POST["no_anggota"]) && !empty($_POST["bulan"]) && !empty($_POST["tahun"])){
								echo "<h5 class='mb-3'>Nomor Anggota : ".$no_anggota." Tahun : ".$tahunn." Bulan : ".$bulann."</h5>";
							}
						}
						

					}

				}else{
					echo "<h5 class='mb-3'>Semua</h5>";
				}

				?> -->
				<div class="col-md-5 col-lg-10 ml-auto">
					<?php 
					if (isset($berhasil)) {
						?>
						<div class="alert alert-success d-flex align-items-center" role="alert">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
							<div>
								<?php echo $berhasil; ?>
							</div>
						</div>
						<?php
					}
					if (isset($gagal)) {
						?>
						<div class="alert alert-danger d-flex align-items-center" role="alert">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
							<div>
								<?php echo $gagal; ?>
							</div>
						</div>
						<?php
					}
					?>
					<!-- <form class="row g-2" action="absen.php" method="post">
						<div class="col-md-4">
							<div class="form-floating">
								<select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="no_anggota">
									<option value="" selected>-----</option>
									<?php
									$query = mysqli_query($koneksi, "select * from user where role = 'Asisten'");
									while ($tampil = mysqli_fetch_array($query)) {
										?>
										<option value="<?php echo $tampil['no_anggota']; ?>"><?php echo $tampil['nama']; ?></option>
										<?php
									}
									?>
								</select>
								<label for="floatingSelect">Nama Asisten</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-floating">
								<select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="bulan">
									<option value="" selected>-----</option>
									<?php
									$bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
									$b = '01';
									foreach ($bulan as $bul) {
										?>
										<option value="<?php echo $b ?>"><?php echo $bul; ?></option>
										<?php 
										$b++;										
									}              
									?>
								</select>
								<label for="floatingSelect">Bulan</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-floating">
								<select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="tahun">
									<option value="" selected>-----</option>
									<?php
									$tahun = ['2019','2020','2021'];
									foreach ($tahun as $tah) {
										?>
										<option value="<?php echo $tah ?>"><?php echo $tah; ?></option>
										<?php 										
									}              
									?>
								</select>
								<label for="floatingSelect">Tahun</label>
							</div>
						</div>
						<div class="col-md-12 mb-5">							
							<button type="Submit" name="lihat" class="btn btn-primary btn-block">
								<span class="font-weight-bold">Lihat</span>
							</button>
						</div>
					</form> -->
					
					<table class="table table-striped table-hover" id="example">
						<thead>
							<tr class="table-info">
								<th>Tanggal</th>
								<th>Nama</th>
								<th>Jam Masuk</th>
								<th>Jam Keluar</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php  

							if (isset($_POST['lihat'])) {
								$bulann = $_POST['bulan'];
								$tahunn = $_POST['tahun'];
								$no_anggota = $_POST['no_anggota'];	

								if (empty($_POST["no_anggota"]) && empty($_POST["bulan"]) && empty($_POST["tahun"])) {
									$query = mysqli_query($koneksi, "select * from absen,user where absen.no_anggota=user.no_anggota order by tanggal desc");
								}else{
									if (empty($_POST["no_anggota"])) {
										if (empty($_POST["bulan"]) || empty($_POST["tahun"])) {
											$query = mysqli_query($koneksi, "select * from absen,user where absen.no_anggota=user.no_anggota order by tanggal desc");
										}else{
											$query = mysqli_query($koneksi, "select * from absen, user where user.no_anggota=absen.no_anggota and month(tanggal)='$bulann' and year(tanggal)='$tahunn' order by absen.tanggal desc");
										}
									}else{
										if (empty($_POST["bulan"]) && empty($_POST["tahun"])) {
											$query = mysqli_query($koneksi, "select * from absen, user where user.no_anggota=absen.no_anggota and absen.no_anggota='$no_anggota' order by absen.tanggal desc");
										}else if(empty($_POST["bulan"]) || empty($_POST["tahun"])){
											$query = mysqli_query($koneksi, "select * from absen,user where absen.no_anggota=user.no_anggota order by tanggal desc");
										}else if(!empty($_POST["no_anggota"]) && !empty($_POST["bulan"]) && !empty($_POST["tahun"])){
											$query = mysqli_query($koneksi, "select * from absen, user where user.no_anggota=absen.no_anggota and month(tanggal)='$bulann' and year(tanggal)='$tahunn' and absen.no_anggota='$no_anggota' order by absen.tanggal desc");
										}
									}


								}

							}else{
								$query = mysqli_query($koneksi, "select * from absen,user where absen.no_anggota=user.no_anggota order by tanggal desc");
							}

							while ($tampil = mysqli_fetch_array($query)) {

								?>

								<tr>
									<td><?php echo $tampil['tanggal']; ?></td>
									<td><?php echo $tampil['nama']; ?></td>
									<td><?php echo $tampil['jam_masuk']; ?></td>
									<td><?php echo $tampil['jam_keluar']; ?></td>
									<td>
										<?php
										$tanggall = $tampil['tanggal'];
										if ($tgl == $tanggall && $tampil['keterangan']=="Tidak Hadir") {
											?>
											<form action="absen.php" method="post">
												<input type="hidden" name="tanggal" value="<?php echo $tgl; ?>">
												<input type="hidden" name="no_anggota" value="<?php echo $tampil['no_anggota']; ?>">
												<select name="keterangan" class="form-select-sm mt-2 col-md-8">
													<?php

													$keterangan_arr = ['Tidak Hadir','Izin','Sakit'];

													foreach ($keterangan_arr as $ket) {
														if ($ket == $tampil['keterangan']) {
															echo "<option value='".$ket."' selected>".$ket."</option>";
														}else{
															echo "<option value='".$ket."'>".$ket."</option>";
														}
													}

													?>
												</select>
												<button type="submit" name="ubahketerangan" class="btn btn-outline-info btn-sm" onclick="return confirm('Keterangan hanya bisa diubah 1 kali, Anda yakin keterangan sudah benar?')">Ubah</button>
											</form>
											<?php 
										}else{
											echo $tampil['keterangan']; 
										}
										?>										
									</td>
								</tr>

								<?php
							}

							?>
						</tbody>
					</table>
				</div>
			</center>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<br>
</body>
</html>
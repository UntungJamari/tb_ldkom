<?php

session_start();

$koneksi = mysqli_connect("localhost","root","","tb_ldkom"); 

date_default_timezone_set('Asia/Jakarta');

// $hari = date('l');
$hari = 'Monday';
// $waktu = date("H:i:s");
$waktu = strtotime("16:00:00");
// $tanggal = date("Y-m-d");
$tanggal = date("Y-m-d", strtotime("2021-08-16"));
$no_anggota = $_SESSION['no_anggota'];

if($_SESSION['role']!="Asisten"){
	header("location:../login.php?pesan=logindulu");
}

if (isset($_GET['jam_masuk'])) {
	// $jam_masuk = date("H:i:s");
	$jam_masuk = strtotime("07:35:00");
	$j_masuk = strtotime("07:30:00");

	if ($jam_masuk <= $j_masuk) {
		$keterangan = "Hadir";
	}else{
		$keterangan = "Terlambat";
	}

	$jam_masuk = date("H:i:s", $jam_masuk);
	
	$query = mysqli_query($koneksi, "insert into absen(no_anggota, tanggal, jam_masuk, keterangan) values ('$no_anggota','$tanggal','$jam_masuk','$keterangan')");

	if ($query) {
		$berhasil = "Berhasil Absen";
	}else{
		$gagal = "Gagal Absen";
	}

}
if (isset($_GET['jam_keluar'])) {
	// $jam_keluar = date("H:i:s");
	$jam_keluar = strtotime("16:00:00");

	$jam_keluar = date("H:i:s", $jam_keluar);

	$query = mysqli_query($koneksi, "update absen set jam_keluar = '$jam_keluar' where tanggal='$tanggal' and no_anggota='$no_anggota'");

	if ($query) {
		$berhasil = "Berhasil Absen";
	}else{
		$gagal = "Gagal Absen";
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
	<title>Absen Piket</title>
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
						<a class="nav-link" href="home_asisten.php">Home</a>
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
							<li><a class="dropdown-item" href="tabel_absen.php">Tabel Absen</a></li>
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
				<?php 

				$harii = array('Monday' => '1', 'Tuesday' => '2', 'Wednesday' => '3', 'Thursday' => '4', 'Friday' => '5', 'Saturday' => '6', 'Sunday' => '7');

				$kode_hari = $harii[$hari];

				$no_anggota = $_SESSION['no_anggota'];

				$query = mysqli_query($koneksi, "select * from jadwal_user where kode_hari='$kode_hari' and no_anggota='$no_anggota'");

				if (mysqli_affected_rows($koneksi) == 0) {
					$info = "Hari ini bukan jadwal piket anda!!";
				}else{
					$piket = "yes";
				}

				?>
				<h1 class="mb-1">Absen Piket</h1>
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
					if (isset($info)) {
						?>
						<div class="alert alert-primary d-flex align-items-center" role="alert">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
							<div>
								<?php echo $info; ?>
							</div>
						</div>
						<?php
					}

					if (isset($piket)) {
						?>
						<table class="table table-striped table-hover mt-5">
							<thead>
								<tr class="table-info">
									<th>Nama</th>
									<th>Tanggal</th>
									<th>Jam Masuk</th>
									<th>Jam Keluar</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$query = mysqli_query($koneksi, "select * from absen where no_anggota='$no_anggota' and tanggal='$tanggal'");

								?>

								<tr>
									<td><?php echo $_SESSION['nama']; ?></td>
									<td><?php echo $tanggal; ?></td>
									<td>
										<?php

										$a_masuk = strtotime("07:15:00");
										$b_masuk = strtotime("07:45:00");

										if ($waktu >= $a_masuk && $waktu <= $b_masuk) {
											if (mysqli_affected_rows($koneksi) == 0) {
												echo "<a href=absen.php?jam_masuk=input>Absen Masuk</a>";
											}else{

												while ($tampil = mysqli_fetch_array($query)) {
													echo $tampil['jam_masuk'];
												}
											}
										}else{
											while ($tampil = mysqli_fetch_array($query)) {
												echo $tampil['jam_masuk'];
											}
										}
										
										?>
									</td>
									<td>
										<?php
										$query = mysqli_query($koneksi, "select * from absen WHERE tanggal = '$tanggal' and no_anggota='$no_anggota' AND jam_masuk IS NOT null");

										if (mysqli_affected_rows($koneksi) == 0) {
											echo "'Absen Masuk Terlebih Dahulu'";
										}else{
											$query = mysqli_query($koneksi, "select * from absen WHERE tanggal = '$tanggal' and no_anggota='$no_anggota' AND jam_masuk IS NOT null AND jam_keluar is not null");

											if (mysqli_affected_rows($koneksi) == 0) {
												$a_keluar = strtotime("15:45:00");
												$b_keluar = strtotime("16:15:00");
												if ($waktu >= $a_keluar && $waktu <=$b_keluar) {
													echo "<a href=absen.php?jam_keluar=input>Absen Keluar</a>";
												}else{
													while ($tampil = mysqli_fetch_array($query)) {
														echo $tampil['jam_keluar'];
													}
												}												
											}else{
												while ($tampil = mysqli_fetch_array($query)) {
													echo $tampil['jam_keluar'];
												}
											}
											
										}
										?>
									</td>
									<td>
										<?php

										$query = mysqli_query($koneksi, "select * from absen WHERE tanggal = '$tanggal' and no_anggota='$no_anggota'");

										while ($tampil = mysqli_fetch_array($query)) {
											echo $tampil['keterangan'];
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</center>

					<p style="margin-left: 100px;">*Tombol absen masuk akan muncul pada jam 07:15 - 07:45<br>*Tombol absen keluar akan muncul pada jam 15:45 - 16:15</p>
					<center>
						<?php

					}
					?>
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
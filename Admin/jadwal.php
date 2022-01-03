<?php

session_start();

$koneksi = mysqli_connect("localhost","root","","tb_ldkom"); 

if($_SESSION['role']!="Kepala Ldkom"){
	header("location:../login.php?pesan=logindulu");
}

if (isset($_POST['tambahpiket'])) {

	if (empty($_POST["no_anggota"])) {
		$gagal = "Silakah Pilih Nama Asisten Terlebih Dahulu!!";
	}else{
		$kode_hari =  $_POST['kode_hari'];
		$no_anggota = $_POST['no_anggota'];

		$query = mysqli_query($koneksi,"insert into jadwal_user values('$kode_hari','$no_anggota')");

		if ($query) {
			$berhasil = "Piket Berhasil Ditambahkan";
		}else{
			$gagal = "Piket Gagal Ditambahkan";
		}
	}
}
if (isset($_POST['hapuspiket'])) {

	$kode_hari =  $_POST['kode_hari'];
	$no_anggota = $_POST['no_anggota'];

	$query = mysqli_query($koneksi,"delete from jadwal_user where kode_hari='$kode_hari' and no_anggota='$no_anggota'");

	if ($query) {
		$berhasil = "Piket Berhasil Dihapus";
	}else{
		$gagal = "Piket Gagal Dihapus";
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
	<title>Jadwal Piket</title>
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
	<div class="container mt-4" style="background-color: white;	 border-radius: 30px;">
		<br>
		<center>
			<h1 class="mt-2">Jadwal Piket</h1>
		</center>
		<div class="mx-5 mb-4">
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
		</div>
		<div class="row g-3" style="margin-left: 70px;">
			<?php
			$kode_hari = 1;
			$hari = ['Senin','Selasa','Rabu'];

			foreach ($hari as $har) {
				?>
				<div class="col-md-4 m-1" style="border-radius: 30px; width: 30%;">
					<div class="m-4">
						<h3><?php echo $har; ?></h3>
						<h5></h5>
						<?php 

						$query = mysqli_query($koneksi,"select user.no_anggota,user.nama from user, jadwal_user where jadwal_user.no_anggota=user.no_anggota and jadwal_user.kode_hari='$kode_hari' order by user.nama");

						while ($tampil = mysqli_fetch_array($query)) {
							$no_anggota = $tampil['no_anggota'];
							$nama = $tampil['nama'];
							?>

							<form action="jadwal.php" method="post">
								<input type="hidden" name="kode_hari" value="<?php echo $kode_hari; ?>">
								<input type="hidden" name="no_anggota" value="<?php echo $no_anggota; ?>">
								<button type="submit" name="hapuspiket" style="border: none; background-color: white;"><img src="../gambar/delete.png" style="width: 20px; height: 20px;"></button><label><?php echo "".$tampil['nama'];?></label>
							</form>

							<?php
						}

						if (mysqli_affected_rows($koneksi) < 5) {

							$query = mysqli_query($koneksi,"select user.no_anggota, user.nama from user where user.role='Asisten' and user.nama not in(select user.nama from user, jadwal_user where jadwal_user.no_anggota=user.no_anggota and jadwal_user.kode_hari='$kode_hari') order by user.nama");

							?>

							<form action="jadwal.php" method="post">
								<input type="hidden" name="kode_hari" value="<?php echo $kode_hari; ?>">
								<select name="no_anggota" class="form-select-sm mt-2 col-md-8">
									<option value="" selected>--Tambah Piket--</option>
									<?php

									while ($tampil = mysqli_fetch_array($query)) {

										$no_anggota = $tampil['no_anggota'];

										$query2 = mysqli_query($koneksi,"select * from jadwal_user where no_anggota = '$no_anggota'");

										if (mysqli_affected_rows($koneksi) < 3) {
											echo "<option value='".$tampil['no_anggota']."'>".$tampil['nama']."</option>";
										}else{

										}
										
									}

									?>
								</select>
								<button type="submit" name="tambahpiket" class="btn btn-outline-info btn-sm">Tambah</button>
							</form>

							<?php
							
						}
						?>
					</div>
				</div>
				<?php	
				$kode_hari++;
			}
			?>
		</div>
		<div class="row g-3" style="margin-left: 70px;">
			<?php
			$kode_hari = 4;
			$hari = ['Kamis','Jumat'];

			foreach ($hari as $har) {
				?>
				<div class="col-md-4 m-1" style=" border-radius: 30px; width: 30%;">
					<div class="m-4">
						<h3><?php echo $har; ?></h3>
						<h5></h5>
						<?php 

						$query = mysqli_query($koneksi,"select user.no_anggota,user.nama from user, jadwal_user where jadwal_user.no_anggota=user.no_anggota and jadwal_user.kode_hari='$kode_hari' order by user.nama");

						while ($tampil = mysqli_fetch_array($query)) {
							$no_anggota = $tampil['no_anggota'];
							$nama = $tampil['nama'];
							?>

							<form action="jadwal.php" method="post">
								<input type="hidden" name="kode_hari" value="<?php echo $kode_hari; ?>">
								<input type="hidden" name="no_anggota" value="<?php echo $no_anggota; ?>">
								<button type="submit" name="hapuspiket" style="border: none; background-color: white;"><img src="../gambar/delete.png" style="width: 20px; height: 20px;"></button><label><?php echo "".$tampil['nama'];?></label>
							</form>

							<?php
						}

						if (mysqli_affected_rows($koneksi) < 5) {

							$query = mysqli_query($koneksi,"select user.no_anggota, user.nama from user where user.role='Asisten' and user.nama not in(select user.nama from user, jadwal_user where jadwal_user.no_anggota=user.no_anggota and jadwal_user.kode_hari='$kode_hari') order by user.nama");

							?>

							<form action="jadwal.php" method="post">
								<input type="hidden" name="kode_hari" value="<?php echo $kode_hari; ?>">
								<select name="no_anggota" class="form-select-sm mt-2 col-md-8">
									<option value="" selected>--Tambah Piket--</option>
									<?php

									while ($tampil = mysqli_fetch_array($query)) {

										$no_anggota = $tampil['no_anggota'];

										$query2 = mysqli_query($koneksi,"select * from jadwal_user where no_anggota = '$no_anggota'");

										if (mysqli_affected_rows($koneksi) < 3) {
											echo "<option value='".$tampil['no_anggota']."'>".$tampil['nama']."</option>";
										}else{

										}
										
									}

									?>
								</select>
								<button type="submit" name="tambahpiket" class="btn btn-outline-info btn-sm">Tambah</button>
							</form>

							<?php
							
						}
						?>
					</div>
				</div>
				<?php	
				$kode_hari++;
			}
			?>
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
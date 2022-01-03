<?php  

session_start(); 

$koneksi = mysqli_connect("localhost","root","","tb_ldkom"); 

if (isset($_GET['pesan'])) {
  if ($_GET['pesan'] == "logindulu") {
    $info = "Silakan Log In Terlebih Dahulu!!";
  }
}

if (isset($_POST['login'])) {

  if (empty($_POST["no_anggota"]) || empty($_POST["password"])) {
    $gagal = "Nomor Anggota dan Password tidak boleh kosong!!";
  }else{

    $no_anggota = mysqli_real_escape_string($koneksi, $_POST["no_anggota"]);  
    $password = mysqli_real_escape_string($koneksi, $_POST["password"]); 
    
    $query = mysqli_query($koneksi, "select * from user WHERE no_anggota = '$no_anggota'");
    if (mysqli_affected_rows($koneksi) == 0) {
      $gagal = "Nomor Anggota Atau Password Ada yang Tidak Cocok";
    }else{
      $result = mysqli_fetch_assoc($query);

      if(password_verify($password, $result["password"])){
        if($result['role']=="Kepala Ldkom"){
          $_SESSION['no_anggota'] = $no_anggota;
          $_SESSION['role'] = "Kepala Ldkom";
          $_SESSION['nama'] = $result["nama"];
          $_SESSION['foto'] = $result["foto"];
          header("location:Admin/home_admin.php");
        }else if($result['role']=="Asisten"){
          $_SESSION['no_anggota'] = $no_anggota;
          $_SESSION['role'] = "Asisten";
          $_SESSION['nama'] = $result["nama"];
          $_SESSION['foto'] = $result["foto"];
          header("location:Asisten/home_asisten.php");
        }else{
          $gagal = "Anda Harus Log In Terlebih Dahulu";
        }
      }else{
        $gagal = "Nomor Anggota Atau Password Ada yang Tidak Cocok";
      }
    }
  }

}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <title>log In</title>
</head>
<body style="background: url(gambar/bggbr.jpg); background-size: cover; background-repeat: no-repeat;">
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
            <img src="gambar/logoldkom1.png" style="width: 50px; height: 40px;">
          </li>
          <li class="nav-item">
            <h5 class="mt-2 me-3">LDKOM JSI</h5>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Tamu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Anggota</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>  <div>
    <div class="container" style="background: url(gambar/bg.png); border-radius: 30px; width: 50%;">
      <div class="row py-5 mt-4 align-items-center">

        <center>
          <h1 class="mb-4">Log In</h1>
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
            ?>
            <form action="login.php" method="post">
              <div class="row">

                <div class="input-group col-lg-6 mb-4">
                  <input id="firstName" type="text" name="no_anggota" placeholder="Nomor Anggota" class="form-control bg-white border-left-0 border-md">
                </div>

                <div class="input-group col-lg-6 mb-4">
                  <input id="firstName" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                </div>

                <div class="form-group col-lg-12 mx-auto mb-0">

                  <button type="Submit" name="login" class="btn btn-primary btn-block py-2">
                    <span class="font-weight-bold">Log In</span>
                  </button>

                </div>

              </div>
            </form>
          </div>
        </center>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>
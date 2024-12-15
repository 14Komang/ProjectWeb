<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pembayaran SPP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="header">
    <h1 id="title" class="text-center mt-5 display-4">WEB Pembayaran SPP </h1>
    <p id="sub-title" class="text-center display-4">SMK MANIKERS INDONESIA</p>
  </div>

  <div class="row mt-5">
    <div class="col-sm-8 offset-2">
      <div class="row">
        <div class="col-md-4">
          <div class="card shadow"> 
            <img src="assets/img/transaction.png" width="80px" class="mx-auto mt-3 mb-2">
            <a href="pembayaran/data-pembayaran.php" class="stretched-link"><h4 class="text-center mt-1">Pembayaran</h4></a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow">
            <img src="assets/img/report.png" width="80px" class="mx-auto mt-3 mb-2">
            <a href="laporan/laporan.php" class="stretched-link"><h4 class="text-center mt-1">Tunggakan</h4></a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow">
            <img src="assets/img/student.png" width="80px" class="mx-auto mt-3 mb-2">
            <a href="siswa/data-siswa.php" class="stretched-link"><h4 class="text-center mt-1">Data Siswa</h4></a>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-4">
          <div class="card shadow">
            <img src="assets/img/teacher.png" width="80px" class="mx-auto mt-3 mb-2">
            <a href="tahun_ajaran/data-tahun.php" class="stretched-link"><h4 class="text-center mt-1">Tahun Ajaran</h4></a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow">
            <img src="assets/img/student(1).png" width="80px" class="mx-auto mt-3 mb-2">
            <a href="user/data-user.php" class="stretched-link"><h4 class="text-center mt-1">Data User</h4></a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow">
            <img src="assets/img/student(2).png" width="80px" class="mx-auto mt-3 mb-2">
            <a href="kelas/data-kelas.php" class="stretched-link"><h4 class="text-center mt-1">Data Kelas</h4></a>
          </div>
        </div>
      </div>
      <div class="clearfixs">
        <div class="float-right">
          <a href="signout.php" class="btn mt-4"><i class="fa fa-sign-out"> Sign Out</i></a>
        </div>
      </div>
    </div>  
  </div>  
</div>
</body>
</html>

<?php 
  session_start();
	if (!isset($_SESSION['login'])) {
		header('location:../new_login.php');	
	}
  include '../koneksi.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tahun Ajaran</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/input-kelas.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="main col-md-6 offset-3">
        <h2 class="text-center mt-4">Tambah Data Kelas</h2>
        <form method="POST">
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Kelas Jurusan </label>
            </div>
            <div class="col-md-4">
              <input type="text" name="kelas_jurusan" class="form-control rounded-pill">
            </div>
          </div>
            <div class="col-md-12 text-center mt-2  ">
              <button class="submit" type="submit" name="simpan">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>


<!-- simpan data -->
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    
    //variabel untuk menampung inputan dari form
    $kelas   = $_POST['kelas_jurusan'];


    //proses simpan
    if($kelas==''){
      echo "Form belum lengkap...";
    }else{
      $simpan = mysqli_query($konek, "insert into kelas(kelas_jurusan)
          values('$kelas')");
          if ($simpan) {
            echo "<script>
                    alert('Data berhasil disimpan!');
                    window.location.href = 'data-kelas.php';
                  </script>";
          } else {
        //ambil data id siswa terakhir
        $ds=mysqli_fetch_array(mysqli_query($konek, "SELECT id FROM kelas ORDER BY id DESC LIMIT 1"));
        $id = $ds['id'];

        header('location:data-kelas.php');
      }
    }

  }
?>

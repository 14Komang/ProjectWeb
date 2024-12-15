<?php 
  session_start();
	if (!isset($_SESSION['login'])) {
		header('location:../new_login.php');	
	}
  include '../koneksi.php';
  $id = $_GET['id'];
  $tampilkelas = mysqli_query($konek,"SELECT * FROM kelas WHERE id = $id");

  while ($data = mysqli_fetch_array($tampilkelas)) {
    $id = $data['id'];
    $kelas = $data['kelas_jurusan'];
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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
        <h2 class="text-center mt-4">Update Kelas</h2>
        <form method="POST">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Kelas Jurusan </label>
            </div>
            <div class="col-md-7">
              <input type="text" name="kelas_jurusan" class="form-control rounded-pill" value="<?php echo $kelas ?>">
            </div>
            <div class="row">
            <div class="col-md-12 offset-11 text-center mt-4  ">
              <button class="submit" type="submit" name="simpan">Simpan</button>
            </div>
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
  $id   = $_POST['id'];
  $kelas  = $_POST['kelas_jurusan'];

  if($kelas==''){
    echo "Form Belum lengkap....";
  }else{
    $update = mysqli_query($konek, "UPDATE kelas SET kelas_jurusan='$kelas' WHERE id='$id'");

    if ($update) {
      echo "<script>
              alert('Data berhasil diupdate!');
              window.location.href = 'data-kelas.php';
            </script>";
    }else{
      header('location:data-kelas.php');
    }
  }
}
?>

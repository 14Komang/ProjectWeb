<?php 
  session_start();
	if (!isset($_SESSION['login'])) {
		header('location:../new_login.php');	
	}
  include '../koneksi.php';
  $id = $_GET['id_admin'];
  $tampiluser = mysqli_query($konek,"SELECT * FROM admin WHERE id_admin = $id");

  while ($data = mysqli_fetch_array($tampiluser)) {
    $id = $data['id_admin'];
    $role = $data['role'];
    $username = $data['username'];
    $namalengkap = $data['namalengkap'];
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/input-user.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="main col-md-6 offset-3">
        <h2 class="text-center mt-4">Update User</h2>
        <form method="POST">
          <input type="hidden" name="id_admin" value="<?php echo $id ?>">
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Role</label>
            </div>
            <div class="col-md-4">
              <input type="text" name="role" class="form-control rounded-pill" value="<?php echo $role ?>" readonly>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>username</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="username" class="form-control rounded-pill" value="<?php echo $username ?>">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Nama Lengkap</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="namalengkap" class="form-control rounded-pill" value="<?php echo $namalengkap ?>">
            </div>
          </div>
          <div class="row">
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
  $id   = $_POST['id_admin'];
  $role  = $_POST['role'];
  $username   = $_POST['username'];
  $namalengkap  = $_POST['namalengkap'];

  if($role=='' || $username =='' || $namalengkap==''){
    echo "Form Belum lengkap....";
  }else{
    $update = mysqli_query($konek, "UPDATE admin SET username='$username',role='$role',namalengkap='$namalengkap' WHERE id_admin='$id'");
    if ($update) {
      echo "<script>
          alert('Data berhasil diupdate!');
          window.location.href = 'data-user.php';
          </script>";
    }else{
      header('location:data-user.php');
    }
  }
}
?>

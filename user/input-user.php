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
        <h2 class="text-center mt-4">Tambah Data User</h2>
        <form method="POST">
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Role </label>
            </div>
            <div class="col-md-5">
              <select name="role" class="form-control rounded-pill">
                  <option value="" disabled>- Pilih Role -</option>
                    <option value="admin">Admin</option>
                  <option value="user">User</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Username</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="username" class="form-control rounded-pill">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Password</label>
            </div>
            <div class="col-md-5">
              <input type="password" name="password" class="form-control rounded-pill">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Nama Lengkap</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="namalengkap" class="form-control rounded-pill">
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
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $namalengkap = $_POST['namalengkap'];

    // Validasi inputan
    if ($role == '' || $username == '' || $password == '' || $namalengkap == '') {
      echo "<script>alert('Form belum lengkap!');</script>";
    } else {
      // cek duplikasi username
      $cek_username = mysqli_query($konek, "SELECT * FROM admin WHERE username = '$username'");
      if (mysqli_num_rows($cek_username) > 0) {
        // Jika username duplikat
        echo "<script>alert('Username sudah terdaftar!');</script>";
      } else {
        // Jika tidak ada duplikasi, simpan data
        $simpan = mysqli_query($konek, "INSERT INTO admin (role, username, password, namalengkap) 
          VALUES ('$role', '$username', '$password', '$namalengkap')");
        if ($simpan) {
          echo "<script>
                  alert('Data berhasil disimpan!');
                  window.location.href = 'data-user.php';
                </script>";
        } else {
          echo "<script>alert('Terjadi kesalahan saat menyimpan data!');</script>";
        }
      }
    }
  }
?>

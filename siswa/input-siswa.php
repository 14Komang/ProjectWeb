<?php 
  session_start();
	if (!isset($_SESSION['login'])) {
		header('location:../new_login.php');	
	}
  include '../koneksi.php';

  if(isset($_SESSION['simpan_berhasil'])) {
    echo "<script>alet('Data Berhasil disimpan');</script>";
    unset($_SESSION['simpan_berhasil']);
  }

 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Siswa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/input-siswa.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="main col-md-6 offset-3">
        <h2 class="text-center mt-4">Tambah Data Siswa</h2>
        <form method="POST">
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>NIS </label>
            </div>
            <div class="col-md-5">
              <input type="text" name="nis" class="form-control rounded-pill">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Nama Siswa</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="nama_siswa" class="form-control rounded-pill">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Kelas</label>
            </div>
            <div class="col-md-5">
            <select type="text" name="id_kelas" class="form-control rounded-pill">
                <option value="" selected>- Pilih Kelas -</option>
                <?php  
                  $kelas = mysqli_query($konek, "SELECT * FROM kelas ORDER BY kelas_jurusan ASC");
                  while ($data = mysqli_fetch_array($kelas)) {
                ?>
                  <option value="<?php echo $data['id']; ?>"><?php echo $data['kelas_jurusan']; ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Tahun Ajaran</label>
            </div>
            <div class="col-md-5">
            <select type="text" name="id_tahun_ajaran" class="form-control rounded-pill">
                <option value="" selected>- Pilih Tahun Ajaran -</option>
                <?php  
                  $tahun = mysqli_query($konek, "SELECT * FROM tahun_ajaran ORDER BY tahun_ajaran ASC");
                  while ($data = mysqli_fetch_array($tahun)) {
                ?>
                  <option value="<?php echo $data['id']; ?>"><?php echo $data['tahun_ajaran']; ?></option>
                <?php
                  }
                ?>
              </select>
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
    $nis  = $_POST['nis'];
    $nama   = $_POST['nama_siswa'];
    $kelas  = $_POST['id_kelas'];
    $tahun  = $_POST['id_tahun_ajaran'];

    //proses simpan
    if($nis=='' || $nama=='' || $kelas =='' || $tahun== ''){
      echo "Form belum lengkap...";
    }else{
      $simpan = mysqli_query($konek, "insert into siswa (nis,nama_siswa,id_kelas,id_tahun_ajaran)
          values('$nis','$nama','$kelas','$tahun')");
          if ($simpan) {
            echo "<script>
                    alert('Data berhasil disimpan!');
                    window.location.href = 'data-siswa.php';
                  </script>";
          } else {
        //ambil data id siswa terakhir
        $ds=mysqli_fetch_array(mysqli_query($konek, "SELECT id_siswa FROM siswa ORDER BY id_siswa DESC LIMIT 1"));
        $id_siswa = $ds['id_siswa'];

        header('location:data-siswa.php');
      }
    }

  }
?>

<?php
  session_start();
  if (!isset($_SESSION['login'])) {
    header('location:../new_login.php');
    exit; 
  }

  include '../koneksi.php';

  $id = $_GET['id'];

  $tampilSiswa = mysqli_query($konek, "SELECT * FROM siswa WHERE id_siswa = '$id'");
  $data_siswa = mysqli_fetch_assoc($tampilSiswa);

  $tahun_ajaran = mysqli_query($konek, "SELECT * FROM tahun_ajaran ORDER BY tahun_ajaran ASC");

  $kelas_list = mysqli_query($konek, "SELECT * FROM kelas ORDER BY kelas_jurusan ASC");
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
        <h2 class="text-center mt-4">Update Siswa</h2>
        <form method="POST">
          <input type="hidden" name="id_siswa" value="<?php echo $data_siswa['id_siswa']; ?>">
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>NIS </label>
            </div>
            <div class="col-md-5">
              <input type="text" name="nis" class="form-control rounded-pill" value="<?php echo $data_siswa['nis']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Nama Siswa</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="nama_siswa" class="form-control rounded-pill" value="<?php echo $data_siswa['nama_siswa']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Kelas</label>
            </div>
            <div class="col-md-5">
              <select name="id_kelas" class="form-control rounded-pill">
                <option value="" disabled>- Pilih Kelas -</option>
                <?php while ($row_kelas = mysqli_fetch_array($kelas_list)) { 
                  $selected_kelas = ($row_kelas['id'] == $data_siswa['id_kelas']) ? "selected" : "";
                ?>
                  <option value="<?php echo $row_kelas['id']; ?>" <?php echo $selected_kelas; ?>>
                    <?php echo $row_kelas['kelas_jurusan']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Tahun Ajaran</label>
            </div>
            <div class="col-md-5">
              <select name="id_tahun_ajaran" class="form-control rounded-pill">
                <option value="" disabled>- Pilih Tahun Ajaran -</option>
                <?php while ($row_tahun = mysqli_fetch_array($tahun_ajaran)) { 
                  $selected_tahun = ($row_tahun['id'] == $data_siswa['id_tahun_ajaran']) ? "selected" : "";
                ?>
                  <option value="<?php echo $row_tahun['id']; ?>" <?php echo $selected_tahun; ?> >
                    <?php echo $row_tahun['tahun_ajaran']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center mt-2">
              <button class="btn btn-primary rounded-pill" type="submit" name="simpan">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

<!-- Simpan data -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id_siswa'];
  $nis = $_POST['nis'];
  $nama = $_POST['nama_siswa'];
  $kelas = $_POST['id_kelas'];
  $tahun = $_POST['id_tahun_ajaran'];

  if ($nis == '' || $nama == '' || $kelas == '' || $tahun == '') {
    echo "<script>alert('Form belum lengkap!');</script>";
  } else {
    $update = mysqli_query($konek, "UPDATE siswa SET nis='$nis', nama_siswa='$nama', id_kelas='$kelas', id_tahun_ajaran='$tahun' WHERE id_siswa='$id'");
    if ($update) {
      echo "<script>
              alert('Data berhasil diupdate!');
              window.location.href = 'data-siswa.php';
            </script>";
    } else {
      echo "<script>alert('Update data gagal!');</script>";
    }
  }
}
?>

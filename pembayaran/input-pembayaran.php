<?php
  session_start();
  if (!isset($_SESSION['login'])) {
    header('location:../new_login.php');
  }
  include '../koneksi.php';

  // Proses pengambilan data siswa berdasarkan NIS (AJAX)
  if (isset($_POST['nis'])) {
    $nis = $_POST['nis'];
    $query = mysqli_query($konek, "SELECT * FROM detail_siswa WHERE nis = '$nis'");
    $siswa = mysqli_fetch_assoc($query);
    
    if ($siswa) {
      // Kirimkan data siswa dalam format JSON
      echo json_encode(array(
        'nama_siswa' => $siswa['nama_siswa'],
        'kelas_jurusan' => $siswa['kelas_jurusan'],
        'tahun_ajaran' => $siswa['tahun_ajaran'],
        'biaya' => $siswa['biaya']
      ));
    } else {
      echo json_encode(null);
    }
    exit;
  }

  // Proses menyimpan data pembayaran ketika form disubmit
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan'])) {
    // Ambil data yang diperlukan dari form
    $nis = $_POST['nis'];
    $tanggal_tagihan = $_POST['tanggal_tagihan'];
    $tenggat_bayar = $_POST['tenggat_bayar'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $id_admin = $_SESSION['id_admin'];

    // Ambil data siswa berdasarkan NIS
    $query = mysqli_query($konek, "SELECT * FROM detail_siswa WHERE nis = '$nis'");
    $siswa = mysqli_fetch_assoc($query);

    if ($siswa) {
      // Menyimpan data pembayaran
      $id_siswa = $siswa['id_siswa']; // id_siswa yang digunakan untuk foreign key
      $simpan = mysqli_query($konek, "INSERT INTO pembayaran (id_admin, id_siswa, tanggal_tagihan, tenggat_bayar, status_pembayaran)
                                       VALUES ('$id_admin', '$id_siswa', '$tanggal_tagihan', '$tenggat_bayar', '$status_pembayaran')");

      if ($simpan) {
        // Redirect ke halaman data-pembayaran.php setelah berhasil menyimpan data
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href = 'data-pembayaran.php'; // Redirect ke halaman yang sesuai
              </script>";
        exit; // Pastikan script dihentikan setelah redirect
      } else {
        echo "Gagal menyimpan data.";
      }
    } else {
      echo "Siswa tidak ditemukan.";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tambah Pembayaran</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/input-pembayaran.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="main col-md-6 offset-3">
        <h2 class="text-center mt-4">Tambah Data Pembayaran</h2>
        <form method="POST">
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Pilih NIS</label>
            </div>
            <div class="col-md-5">
              <select name="nis" id="nis" class="form-control rounded-pill" required>
                <option value="">-- pilih siswa --</option>
                <?php
                  $query = mysqli_query($konek, "SELECT nis FROM detail_siswa");
                  while ($row = mysqli_fetch_assoc($query)) {
                    echo "<option value='{$row['nis']}'>{$row['nis']}</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Nama Siswa</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="nama_siswa" id="nama_siswa" class="form-control rounded-pill" readonly>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Kelas Jurusan</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="kelas_jurusan" id="kelas_jurusan" class="form-control rounded-pill" readonly>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Tahun Ajaran</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control rounded-pill" readonly>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Biaya</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="biaya" id="biaya" class="form-control rounded-pill" readonly>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Tanggal Tagihan</label>
            </div>
            <div class="col-md-5">
              <input type="date" name="tanggal_tagihan" class="form-control rounded-pill" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Tenggat Bayar</label>
            </div>
            <div class="col-md-5">
              <input type="date" name="tenggat_bayar" class="form-control rounded-pill" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 offset-1 mt-1">
              <label>Status Pembayaran</label>
            </div>
            <div class="col-md-5">
              <select name="status_pembayaran" class="form-control rounded-pill" required>
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
              </select>
            </div>
          </div>
          <div class="col-md-12 text-center mt-2">
            <button class="submit" type="submit" name="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Mengambil data siswa berdasarkan NIS
    $('#nis').on('change', function() {
      var nis = $(this).val();
      
      $.ajax({
        type: 'POST',
        url: 'input-pembayaran.php',
        data: { nis: nis },
        success: function(response) {
          var data = JSON.parse(response);
          if (data) {
            $('#nama_siswa').val(data.nama_siswa);
            $('#kelas_jurusan').val(data.kelas_jurusan);
            $('#tahun_ajaran').val(data.tahun_ajaran);
            $('#biaya').val(data.biaya);
          } else {
            alert("Data siswa tidak ditemukan.");
          }
        }
      });
    });
  </script>
</body>
</html>

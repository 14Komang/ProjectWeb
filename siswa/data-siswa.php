<?php 
	include '../koneksi.php';
	$result = mysqli_query($konek,"SELECT * FROM detail_siswa ORDER BY nis ASC");
	session_start();
	if (!isset($_SESSION['login'])) {
		header('location:../new_login.php');
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
  <link rel="stylesheet" type="text/css" href="assets/css/data-siswa.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<h2 class="text-center mt-2">Data Siswa</h2>
	<div class="container">
		<div class="clearfixs">
			<div class="float-right">
				<a href="input-siswa.php" id="tambah" class="btn btn-primary shadow">Tambah Data</a>
			</div>
			<div class="float-left">
				<a href="../dashboard.php" id="tambah" class="btn btn-primary shadow">Kembali</a>
			</div>
		</div>
		<div class="text-center mt-2">
			<table class="table table-bordered shadow" border="1">
				<thead id="thead">
					<tr>
						<th>No</th>
						<th>NIS</th>
						<th>Nama Siswa</th>
						<th>Kelas Jurusan</th>
						<th>Tahun Ajaran</th>
						<th>Option</th>
					</tr>
				</thead>
				<tbody id="tbody">
					<?php  
						$no = 1;

						while ($data = mysqli_fetch_array($result)) {
							echo "
								<tr>
									<td>$no</td>
									<td>$data[nis]</td>
									<td>$data[nama_siswa]</td>
									<td>$data[kelas_jurusan]</td>
									<td>$data[tahun_ajaran]</td>
									<td><a href='edit-siswa.php?id=$data[id_siswa]''>Edit</a> | 
									<a href='delete-siswa.php?id=$data[id_siswa]' onclick='return confirm(\"Apakah anda yakin ingin menghapus siswa ini?\")' >Delete</a> </td>
								</tr>
							";
							$no++;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>

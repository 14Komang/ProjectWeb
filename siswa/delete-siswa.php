<?php  
	include '../koneksi.php';

	$id = $_GET['id'];
	$delete = mysqli_query($konek,"DELETE FROM siswa WHERE id_siswa = '$id'");
	if ($delete) {
		echo "<script>
				alert('Data berhasil dihapus!');
				window.location.href = 'data-siswa.php';
			  </script>";
	  }

?>
<?php  
	include '../koneksi.php';

	$id = $_GET['id'];
	$delete = mysqli_query($konek,"DELETE FROM tahun_ajaran WHERE id = '$id'");
    if ($delete) {
		echo "<script>
				alert('Data berhasil dihapus!');
				window.location.href = 'data-tahun.php';
			  </script>";
	  }
?>
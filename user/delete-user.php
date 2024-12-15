<?php  
	include '../koneksi.php';

	$id = $_GET['id_admin'];
	$delete = mysqli_query($konek,"DELETE FROM admin WHERE id_admin = '$id'");
    if ($delete) {
		echo "<script>
				alert('Data berhasil dihapus!');
				window.location.href = 'data-user.php';
			  </script>";
	  }
?>
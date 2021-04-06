<?php 
include 'config/proses.php';

$del_data = new Config_anggota();
$del_kas = new Config_uangkas();
$del_catatan = new Config_uangkas();
$del_user = new Config_User();


if(isset($_GET['num'])){
	$anggota = $_GET['num'];
		if($del_data->hapus_anggota($anggota) > 0){
			echo "<script>alert('Sukses Menghapus Data!'); 
						document.location.href = 'daftar_anggota.php';
						</script>";
				exit();
		}else{
			header("Location: daftar_anggota.php");
			exit();
		}
}

if (isset($_GET['code_keuangan'])) {
	$data_kas = $_GET['code_keuangan'];
	   if($del_kas->delete_kas($data_kas) > 0){
			echo "<script>alert('Sukses Menghapus Data!'); 
						document.location.href = 'daftar_keuangan.php';
						</script>";
				exit();
		}else{
			header("Location: daftar_keuangan.php");
			exit();
		}
}

if(isset($_GET['catatan'])) {
	$catatan = $_GET['catatan'];
		if($del_catatan->delete_catatan($catatan) > 0){
			echo "<script>alert('Sukses Menghapus Data!'); 
						document.location.href = ' daftar_pengeluaran.php';
						</script>";
				exit();
		}else{
			header("Location: daftar_pengeluaran.php");
			exit();
		}
}

if(isset($_GET['user'])){
	$user = $_GET['user'];
		if($del_user->delete_user($user) > 0){
			echo "<script>alert('Sukses Menghapus Data!'); 
						document.location.href = 'list_user.php';
						</script>";
				exit();
		}else{
			header("Location: list_user.php");
			exit();
		}
}



?>
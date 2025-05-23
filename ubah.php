<?php
include "koneksi.php";
$id=$_GET['id'];
$query=mysqli_query($koneksi,"SELECT * FROM data WHERE id='$id'");
$d=mysqli_fetch_assoc($query);
?>
<form action="" method="POST">
	<h2>Edit hari expired</h2>
	Tgl Expired: <?=$d['akhir'];?><p>
	Jumlah hari<br><input type="number" name="rentang" value="<?=$d['rentang'];?>" autocomplete="OFF" min="1" required><p>
	<input type="submit" name="ubah" value="Simpan perubahan"><p>
</form>

<?php
if(isset($_POST['ubah'])){
	$rentang=$_POST['rentang'];
	$akhir=date('Y-m-d H:i:s', strtotime('+' . $rentang . ' days'));
	$queri=mysqli_query($koneksi,"UPDATE data SET rentang = '$rentang', akhir = '$akhir' WHERE id='$id'");
	if($queri){echo "<script>alert('Berhasil diperbarui!');window.location.href='tambah.php';</script>";die();}
	if(!$queri){echo "<script>alert('Gagal diperbarui!');window.location.href='tambah.php';</script>";die();}
}
?>

<?php
if(isset($_POST['hapus'])){
	$id=$_POST['id'];
	$q=mysqli_query($koneksi,"SELECT * FROM data WHERE id='$id'");
	$d=mysqli_fetch_assoc($q);
	$dokumen=$d['dokumen'];
	
	if(file_exists("dokumen/".$dokumen)){
	unlink("dokumen/".$dokumen);
	$que=mysqli_query($koneksi,"DELETE FROM data WHERE id='$id'");
	if($que){echo "<script>alert('Berhasil dihapus!');window.location.href='tambah.php';</script>";die();}
	if(!$que){echo "<script>alert('Gagal dihapus!');window.location.href='tambah.php';</script>";die();}
	}
	
	if(!file_exists("dokumen/".$dokumen)){
	$quer=mysqli_query($koneksi,"DELETE FROM data WHERE id='$id'");
	if($quer){echo "<script>alert('Berhasil dihapus!');window.location.href='tambah.php';</script>";die();}
	if(!$quer){echo "<script>alert('Gagal dihapus!');window.location.href='tambah.php';</script>";die();}
	}
}
?>
<p>

<a href="tambah.php"><button>Kembali</button></a>
<form action="" method="POST">
	<input type="hidden" name="id" value="<?=$id;?>">
	<input type="submit" name="hapus" value="Hapus Data">
</form>
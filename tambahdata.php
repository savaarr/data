<?php
include "koneksi.php";
date_default_timezone_set("Asia/Jakarta");
if(isset($_POST['tambah'])){
	$dokumen=$_FILES['dokumen']['name'];
	$tmp=$_FILES['dokumen']['tmp_name'];
	$awal=date("Y-m-d");
	$rentang=$_POST['rentang'];
	$akhir=date('Y-m-d H:i:s', strtotime('+' . $rentang . ' days'));
	move_uploaded_file($tmp, "dokumen/".$dokumen);
	$query=mysqli_query($koneksi,"INSERT INTO data VALUES (NULL,'$dokumen','$awal','$rentang','$akhir')");
	if($query){echo "<script>alert('Berhasil ditambahkan!');window.location.href='tambah.php';</script>";die();}
	if(!$query){echo "<script>alert('Gagal ditambahkan!');window.location.href='tambah.php';</script>";die();}
}
?>
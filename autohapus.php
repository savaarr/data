<?php
include "koneksi.php";
$queri=mysqli_query($koneksi,"SELECT * FROM data WHERE awal >= akhir");
while($d=mysqli_fetch_assoc($queri)){
	$dokumen=$d['dokumen'];
	unlink("dokumen/".$dokumen);
}
$delete=mysqli_query($koneksi,"DELETE FROM data WHERE awal >= akhir");
?>
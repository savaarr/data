<?php include "autohapus.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tambah</title>
</head>
<body>
<form action="tambahdata.php" method="POST" enctype="multipart/form-data">
	<h2>Tambah data</h2>
	<input type="file" name="dokumen" required><p>
	<input type="number" name="rentang" placeholder="Expired hari" autocomplete="OFF" min="1" required><br>
	<small>Minimal 1 hari</small><p>
	<input type="submit" name="tambah" value="Tambah"><p>
</form>

	<?php
	include "koneksi.php";
	date_default_timezone_set("Asia/Jakarta");
	$query=mysqli_query($koneksi,"SELECT * FROM data");
	if(mysqli_num_rows($query) < 1){echo "Data tidak ditemukan<p>";}
	if(mysqli_num_rows($query) > 0){?>

<table border="1" cellpadding="8" cellspacing="0">
	<tr>
		<th>No</th>
		<th>Nama Data</th>
		<th>Upload</th>
		<th>Aktif</th>
		<th>Kadaluarsa</th>
	</tr>
	<?php
	$no=1;
	while($data=mysqli_fetch_assoc($query)){
	?>
	<tr>
		<td align="center"><?=$no++;?></td>
		<td><a href="download.php?id=<?=$data['id'];?>"><img src="download.png" height="15em"></a> 
			<a href="ubah.php?id=<?=$data['id'];?>" style="color:red;text-decoration:none;"><?=$data['dokumen'];?></a></td>
		<td><?=$data['awal'];?></td>
		<td align="center"><?=$data['rentang'];?> hari</td>
		<td align="center"><?=$data['akhir'];?></td>
	</tr>
<?php } ?>
</table>
<br>Untuk download klik ikon <img src="download.png" height="15em">,
Untuk ubah klik teks warna <span style="color:red;">Merah.</span><br>
Setelah masuk tanggal kadaluarsa, data akan otomatis terhapus.
<?php } ?>
</body>
</html>
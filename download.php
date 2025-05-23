<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include "koneksi.php";
    $result = mysqli_query($koneksi,"SELECT * FROM data WHERE id='$id'");

    $data = mysqli_fetch_assoc($result);
    $filepath = 'dokumen/' . $data['dokumen'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('dokumen/' . $data['dokumen']));
        readfile('dokumen/' . $data['dokumen']);
        exit;
    }
}
?>
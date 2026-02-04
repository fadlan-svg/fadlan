<?php 
include 'koneksi_fadlan.php';
 
$id_nilai = $_GET['id_nilai'];
 
mysqli_query($conn,"delete from nilai_fadlan where id_nilai='$id_nilai'");
 
header("location:read_fadlan_raport.php");
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="22.css">
</head>
<body>
    <style>
        table.rapot {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  font-size: 14px;
}


table.rapot,
table.rapot th,
table.rapot td {
  border: 1.5px solid #000;
}


table.rapot th {
  background-color: #f2f2f2;
  text-align: center;
  font-weight: bold;
  padding: 8px;
}


table.rapot td {
padding: 8px;
 }



    </style>
    <center>
    <div class="container">
    <?php
        include 'koneksi_fadlan.php';
        $nilai = $_GET['id_nilai'];
        $datanilai = mysqli_query($conn, "SELECT siswa_fadlan.nis,siswa_fadlan.nama, mapel_fadlan.nama_mapel, mapel_fadlan.kkm,
         nilai_fadlan.nilai_tugas, nilai_fadlan.nilai_uts, nilai_fadlan.nilai_uas, nilai_fadlan.nilai_akhir, nilai_fadlan.deskripsi, 
         nilai_fadlan.semester, nilai_fadlan.tahun_ajaran FROM nilai_fadlan INNER JOIN siswa_fadlan ON nilai_fadlan.nis = siswa_fadlan.nis
          INNER JOIN mapel_fadlan ON mapel_fadlan.id_mapel = nilai_fadlan.id_mapel where id_nilai='$nilai';");
        while ($dn = mysqli_fetch_array($datanilai)) {
    ?>
    <form action="" method="POST">
        <table class="rapot">

            <tr>
                <h2>Rapot</h2>
            </tr>
        
            <tr>
                <td>Nis:</td>
                <td><?php echo $dn['nis']?></td>
            </tr>
            <tr>
                <td>Nama:</td>
                <td><?php echo $dn['nama']?></td>
            </tr>
            <tr>
                <td>ID Mapel:</td>
                <td><?php echo $dn['nama_mapel']?></td>
            </tr>
            <tr>
                <td>Nilai Tugas:</td>
                <td><?php echo $dn['nilai_tugas']?></td>
            </tr>
            <tr>
                <td>Nilai UTS:</td>
                <td><?php echo $dn['nilai_uts']?></td>
            </tr>
            <tr>
                <td>Nilai UAS:</td>
                <td><?php echo $dn['nilai_uas']?></td>
            </tr>
            <tr>
                <td>Deskripsi:</td>
                <td><?php echo $dn['deskripsi']?></td>
            </tr>
            <tr>
                <td>Semester:</td>
                <td><?php echo $dn['semester']?></td>
            </tr>
            <tr>
                <td>Tahun Ajaran:</td>
                <td><?php echo $dn['tahun_ajaran']?></td>
            </tr>
            
        </table>
        <br><a href="cetak.php?nis=<?php echo $dn['nis']; ?>">CETAK</a><br>
        
        <a href="read_fadlan_raport.php" class="a">&larr; kembali ke daftar nilai</a>
        
    </form>
    <?php
        }
    ?>
    </div>
    </center>
</body>
</html>
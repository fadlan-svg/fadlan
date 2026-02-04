<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <div class="container">
    <?php
        include 'koneksi_fadlan.php';
         $nilai = $_GET['id_nilai'];
        $data = mysqli_query($conn,"SELECT siswa_fadlan.nis,siswa_fadlan.nama, mapel_fadlan.nama_mapel, mapel_fadlan.kkm,
         nilai_fadlan.nilai_tugas, nilai_fadlan.nilai_uts, nilai_fadlan.nilai_uas, nilai_fadlan.nilai_akhir, nilai_fadlan.deskripsi, 
         nilai_fadlan.semester, nilai_fadlan.tahun_ajaran FROM nilai_fadlan INNER JOIN siswa_fadlan ON nilai_fadlan.nis = siswa_fadlan.nis
          INNER JOIN mapel_fadlan ON mapel_fadlan.id_mapel = nilai_fadlan.id_mapel;");
        while ($dn = mysqli_fetch_array($data)) {
    ?>
    <form action="" method="POST">
        <table border='5'>
            <tr>
                <h2></h2>
            </tr>
            <tr>
                <th>Nama:</th>
                <td><?php echo $dn['nama']?></td>
            </tr>
            <tr>
                <th>Nilai Tugas:</th>
                <td><?php echo $dn['nilai_tugas']?></td>
            </tr>
            <tr>
                <th>Nilai UTS:</th>
                <td><?php echo $dn['nilai_uts']?></td>
            </tr>
            <tr>
                <th>Nilai UAS:</th>
                <td><?php echo $dn['nilai_uas']?></td>
            </tr>
            <tr>
                <th>Deskripsi:</th>
                <td><?php echo $dn['deskripsi']?></td>
            </tr>
            <tr>
                <th>Semester:</th>
                <td><?php echo $dn['semester']?></td>
            </tr>
            <tr>
                <th>Tahun Ajaran:</th>
                <td><?php echo $dn['tahun_ajaran']?></td>
            </tr>
        </table>
        
    </form>
    <?php
        }
    ?>
    </div>
    </center>
</body>
</html>
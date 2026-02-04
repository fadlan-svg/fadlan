<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="22.css">
</head>
<body>
    <center>
    <div class="container">
    <?php
        include 'koneksi_fadlan.php';
        $nilai = $_GET['id_nilai'];
        $datanilai = mysqli_query($conn, "SELECT * FROM nilai_fadlan WHERE id_nilai='$nilai'");
        $datasiswa = mysqli_query($conn, "SELECT * FROM siswa_fadlan");
        $datamapel = mysqli_query($conn, "SELECT * FROM mapel_fadlan");
        while ($dn = mysqli_fetch_array($datanilai)) {
    ?>
    <form action="" method="POST">
        <table>
            <tr>
                <h2>Edit Data Nilai</h2>
            </tr>
            <tr>
                <td>ID Nilai:</td>
                <td> <input class="input" readonly type="text" name="id_nilaifadlan" value="<?php echo $dn['id_nilai']?>" required></td>
            </tr>
            <tr>
                <td>Nis:</td>
                <td>
                    <select class="input" name="nisfadlan" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php 
                        mysqli_data_seek($datasiswa, 0);
                        while($ds = mysqli_fetch_array($datasiswa)) { 
                            $selected = ($ds['nis'] == $dn['nis']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $ds['nis']; ?>" <?php echo $selected; ?>>
                                <?php echo $ds['nama']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>ID Mapel:</td>
                <td>
                    <select class="input" name="mapelfadlan" required>
                        <option value="">-- Pilih Guru --</option>
                        <?php 
                        mysqli_data_seek($datamapel, 0);
                        while($dm = mysqli_fetch_array($datamapel)) { 
                            $selected = ($dm['id_mapel'] == $dn['id_mapel']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $dm['id_mapel']; ?>" <?php echo $selected; ?>>
                                <?php echo $dm['nama_mapel']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nilai Tugas:</td>
                <td><input class="input" type="number" name="tugasfadlan" placeholder="Masukan Nilai Tugas" value="<?php echo $dn['nilai_tugas']?>" required></td>
            </tr>
            <tr>
                <td>Nilai UTS:</td>
                <td><input class="input" type="number" name="utsfadlan" placeholder="Masukkan Nilai UTS" value="<?php echo $dn['nilai_uts']?>" required></td>
            </tr>
            <tr>
                <td>Nilai UAS:</td>
                <td><input class="input" type="number" name="uasfadlan" placeholder="Masukkan Nilai UAS" value="<?php echo $dn['nilai_uas']?>" required></td>
            </tr>
            <tr>
                <td>Semester:</td>
                <td><input class="input" type="text" name="semesterfadlan" placeholder="Masukkan Semester" value="<?php echo $dn['semester']?>" required></td>
            </tr>
            <tr>
                <td>Tahun Ajaran:</t>
                <td><select class="input" name="tafadlan" value="<?php echo $dn['tahun_ajaran']?>" required>>
                    <option value="2024/2025">2024/2025</option>
                    <option value="2025/2026">2025/2026</option>
                    <option value="2026/2027">2026/2027</option>
                </select></td>
            </tr>
        </table>
            <br><button type="submit" name="fadlanupdate" class="button">Update</button><br><br>
            <a href="read_fadlan_raport.php" class="a">&larr; kembali ke daftar nilai</a>
        
    </form>
    <?php
        }
    ?>
    </div>
    </center>
    <?php 
        include 'koneksi_fadlan.php';
        if (isset($_POST['fadlanupdate'])) {
            $id_nilaifadlan = $_POST['id_nilaifadlan'];
            $nisfadlan = $_POST['nisfadlan'];
            $id_mapelfadlan = $_POST['mapelfadlan'];
            $tugasfadlan = $_POST['tugasfadlan'];
            $utsfadlan = $_POST['utsfadlan'];
            $uasfadlan = $_POST['uasfadlan'];
            $nafadlan = ($tugasfadlan + $utsfadlan + $uasfadlan) / 3;
            $deskfadlan = $_POST['deskfadlan'];
            $semesterfadlan = $_POST['semesterfadlan'];
            $tafadlan = $_POST['tafadlan'];
            if ($nafadlan>=85) {
            $deskfadlan="Sangat Baik";

        } else if ($nafadlan >75) {
            $deskfadlan="Baik";
        } else {
            $deskfadlan="Buruk";
        } 


            $updatefadlan = "UPDATE nilai_fadlan SET id_nilai='$id_nilaifadlan', nis='$nisfadlan', id_mapel='$id_mapelfadlan', nilai_tugas='$tugasfadlan', nilai_uts='$utsfadlan', nilai_uas='$uasfadlan', nilai_akhir='$nafadlan', deskripsi='$deskfadlan',semester='$semesterfadlan',tahun_ajaran='$tafadlan'
                WHERE id_nilai='$id_nilaifadlan'";
            if (mysqli_query($conn, $updatefadlan)) {
                echo "<script>alert('Data Berhasil Diupdate!');
                    window.location='read_fadlan_raport.php';</script>";
            }
            exit;
        }
    ?>
</body>
</html>
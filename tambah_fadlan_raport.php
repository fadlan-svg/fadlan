<?php
include 'koneksi_fadlan.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai</title>
    <link rel="stylesheet" href="22.css">
</head>
<style>
    .button-red {
  background-color:rgb(253, 0, 0);
  color: black;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
}
    .button-blue {
  background-color:rgb(0, 17, 253);
  color: black;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
}
    .button-blue1 {
  background-color:rgb(0, 17, 253);
  color: black;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
}
a {
    color: black;

}
</style>
<body>
    <center>
    <div class="container">
    <form action="" method="POST">
        <table>
            <tr>
                <h2>Tambah Data Nilai</h2>
            </tr>
            <tr>
                <th>Nis:</th>
                <td><select class="input" name="nisfadlan">
                    <option value="">-- Pilih Siswa --</option>
                    <?php 
                        $datasiswa = mysqli_query($conn, "SELECT * FROM siswa_fadlan");
                        while($s = mysqli_fetch_array($datasiswa)) {
                            echo "<option value='".$s['nis']."'>".$s['nama']."</option>";
                        }
                        ?>
                </select>
                </td>
            </tr>
            <tr>
                <th>ID Mapel:</th>
                <td><select class="input" name="id_mapelfadlan">
                    <option value="">-- Pilih Mapel --</option>
                    <?php
                    $datamapel = mysqli_query($conn, "SELECT * FROM mapel_fadlan");
                    while($m = mysqli_fetch_array($datamapel)){
                        echo "<option value='".$m['id_mapel']."'>".$m['nama_mapel']."</option>";
                    }
                    ?>
                </select></td>
            </tr>
            <tr>
                <th>Nilai Tugas:</th>
                <td><input class="input" type="number" name="tugasfadlan" placeholder="Masukan Nilai Harian" required></td>
            </tr>
            <tr>
                <th>Nilai UTS:</th>
                <td><input class="input" type="number" name="utsfadlan" placeholder="Masukkan Nilai UTS" required></td>
            </tr>
            <tr>
                <th>Nilai UAS:</th>
                <td><input class="input" type="number" name="uasfadlan" placeholder="Masukkan Nilai UAS" required></td>
            </tr>
            <tr>
                <th>Semester:</th>
                <td><select class="input" name="semesterfadlan">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select></td>
            </tr>
            <tr>
                <th>Tahun Ajaran:</th>
                <td><select class="input" name="tafadlan">
                    <option value="2024/2025">2024/2025</option>
                    <option value="2025/2026">2025/2026</option>
                    <option value="2026/2027">2026/2027</option>
                </select></td>
            </tr>
        </table>
        <br><button type="submit" name="fadlansimpan" class="button-blue1">Simpan</button><br><br>
       <button  class="button-red"> <a href="read_fadlan_raport.php" >&larr; Kembali ke daftar nilai </a></button> <br> <br>
        <button  class="button-blue"><a href="tambah_siswa.php" class="add-link">+ Tambah Data Siswa</a></button>
    </form>
    
    </div>
    </center>
    <?php
    $query = mysqli_query($conn, 
    "select id_nilai from nilai_fadlan
    ORDER BY id_nilai DESC LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    if ($data) {
        $no = (int) substr($data['id_nilai'],2,3);
        $no++;
    } else {
        $no = 1;
    }
    $id_nilai = "NL" . str_pad($no,3,"0", STR_PAD_LEFT);

    if (isset($_POST['fadlansimpan'])){
        //$id_nilai = $_POST['id_nilai'];
        $nisfadlan = $_POST['nisfadlan'];
        $id_mapelfadlan = $_POST['id_mapelfadlan'];
        $nilaitugasfadlan = $_POST['tugasfadlan'];
        $nilaiutsfadlan = $_POST['utsfadlan'];
        $nilaiuasfadlan = $_POST['uasfadlan'];
        $nafadlan = ($nilaitugasfadlan + $nilaiutsfadlan + $nilaiuasfadlan) / 3;
        $deskfadlan = ($_POST['deskfadlan']);
        $semesterfadlan = $_POST['semesterfadlan'];
        $tafadlan = $_POST['tafadlan'];
                if ($nafadlan>=85) {
            $deskfadlan="Sangat Baik";

        } else if ($nafadlan >75) {
            $deskfadlan="Baik";
        } else {
            $deskfadlan="Buruk";
        }   

        $cekfadlan = mysqli_query($conn, "SELECT * FROM nilai_fadlan WHERE id_nilai='$id_nilai'");
        if (mysqli_num_rows($cekfadlan) > 0) {
            echo "<script>alert('Nilai Siswa tersebut sudah terdaftar, silakan isi dengan Siswa lain!');
            window.location='tambah_fadlan_raport.php';</script>";
        } else {
            $sql = "INSERT INTO nilai_fadlan (id_nilai, nis, id_mapel, nilai_tugas, nilai_uts, nilai_uas, nilai_akhir, deskripsi, semester, tahun_ajaran) VALUES ('$id_nilai', '$nisfadlan', '$id_mapelfadlan', '$nilaitugasfadlan', '$nilaiutsfadlan', '$nilaiuasfadlan', '$nafadlan', '$deskfadlan', '$semesterfadlan', '$tafadlan')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Data Berhasil Disimpan!');
                window.location='read_fadlan_raport.php';</script>";
            } else {
                echo "<script>alert('Data Gagal Disimpan!');
                window.location='tambah_fadlan_raport.php';</script>";
            }
        }
    }
    ?>
</body>
</html>
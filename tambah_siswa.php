<?php
include 'koneksi_fadlan.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
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
  background-color:rgb(0, 101, 253);
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
            <h2>Tambah Data Siswa</h2>
        </tr>

        <tr>
            <th>NIS:</th>
            <td>
                <input class="input" type="text" name="nisfadlan" placeholder="Masukkan NIS" required>
            </td>
        </tr>

        <tr>
            <th>Nama Siswa:</th>
            <td>
                <input class="input" type="text" name="namafadlan" placeholder="Masukkan Nama Siswa" required>
            </td>
        </tr>

        <tr>
            <th>Kelas:</th>
            <td>
                <select class="input" name="id_kelasfadlan" required>
                    <option value="">-- Pilih Kelas --</option>
                    <?php
                    $datakelas = mysqli_query($conn, "SELECT * FROM kelas_fadlan");
                    while($k = mysqli_fetch_array($datakelas)){
                        echo "<option value='".$k['id_kelas']."'>".$k['nama_kelas']."</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Tempat Lahir:</th>
            <td>
                <input class="input" type="text" name="tempatlahirfadlan" placeholder="Masukkan Tempat Lahir" required>
            </td>
        </tr>
        <tr>
            <th>Tahun Lahir:</th>
            <td>
                <input class="input" type="date" name="tahunlahirfadlan" placeholder="Masukkan Tahun Lahir" required>
            </td>
        </tr>

        <tr>
            <th>Alamat:</th>
            <td>
                <textarea class="input" name="alamatfadlan" placeholder="Masukkan Alamat" required></textarea>
            </td>
        </tr>
    </table>

    <br>
    <button type="submit" name="fadlansimpan" class="button-blue">Simpan</button>
    <br><br>
    <button class="button-red"><a href="read_fadlan_raport.php" class="a">&larr; Kembali ke daftar siswa</a></button>
</form>
</div>
</center>

<?php
if (isset($_POST['fadlansimpan'])) {

    $nisfadlan     = $_POST['nisfadlan'];
    $namafadlan    = $_POST['namafadlan'];
    $tahunlahirfadlan    = $_POST['tahunlahirfadlan'];
    $tempatlahirfadlan    = $_POST['tempatlahirfadlan'];
    $idkelasfadlan = $_POST['id_kelasfadlan'];
    $alamatfadlan  = $_POST['alamatfadlan'];

    $cek = mysqli_query($conn, "SELECT * FROM siswa_fadlan WHERE nis='$nisfadlan'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
            alert('NIS sudah terdaftar!');
            window.location='tambah_siswa.php';
        </script>";
    } else {

        $sql = "INSERT INTO siswa_fadlan 
                (nis, nama, id_kelas, alamat,tempat_lahir,tgl_lahir)
                VALUES
                ('$nisfadlan', '$namafadlan', '$idkelasfadlan', '$alamatfadlan','$tempatlahirfadlan','$tahunlahirfadlan')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Data Siswa Berhasil Disimpan!');
                window.location='tambah_fadlan_raport.php';
            </script>";
        } else {
            echo "<script>
                alert('Data Gagal Disimpan!');
                window.location='tambah_siswa.php';
            </script>";
        }
    }
}
?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai</title>
</head>

<style>
th {
    background-color: #f2f2f2;
    color: #333;
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #ddd;
}

td {
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #ddd;
}

.button-yellow {
    background-color: rgb(0, 253, 13);
    color: black;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
}

.button-red {
    background-color: rgb(253, 0, 0);
    color: black;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
}

.button-blue {
    background-color: rgb(0, 160, 253);
    color: black;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

.add-link {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 20px;
    background: linear-gradient(45deg, #007bff, #007bff);
    color: #000;
    text-decoration: none;
    border-radius: 10px;
    font-weight: bold;
}

.add-link:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px #f4f6f8ff;
}

.button {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    background-color: rgb(0, 245, 253);
    color: black;
}
</style>

<body>
<center>

<?php
include 'koneksi_fadlan.php';

$where = [];

if (!empty($_GET['nama'])) {
    $nama = mysqli_real_escape_string($conn, $_GET['nama']);
    $where[] = "siswa_fadlan.nama LIKE '%$nama%'";
}

if (!empty($_GET['semester'])) {
    $semester = mysqli_real_escape_string($conn, $_GET['semester']);
    $where[] = "nilai_fadlan.semester = '$semester'";
}

if (!empty($_GET['tahun'])) {
    $tahun = mysqli_real_escape_string($conn, $_GET['tahun']);
    $where[] = "nilai_fadlan.tahun_ajaran = '$tahun'";
}

$sql = "SELECT 
        nilai_fadlan.id_nilai,
        siswa_fadlan.nama,
        siswa_fadlan.nis,
        mapel_fadlan.nama_mapel,
        nilai_fadlan.nilai_tugas,
        nilai_fadlan.nilai_uts,
        nilai_fadlan.nilai_uas,
        nilai_fadlan.nilai_akhir,
        nilai_fadlan.deskripsi,
        nilai_fadlan.semester,
        nilai_fadlan.tahun_ajaran
        FROM nilai_fadlan
        INNER JOIN siswa_fadlan ON nilai_fadlan.nis = siswa_fadlan.nis
        INNER JOIN mapel_fadlan ON mapel_fadlan.id_mapel = nilai_fadlan.id_mapel";

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$data = mysqli_query($conn, $sql);
?>


<form method="GET" style="margin-bottom:20px;">
    <input type="text" name="nama" placeholder="Cari Nama Siswa" value="<?= $_GET['nama'] ?? '' ?>">

    <select name="semester">
        <option value="">-- Semester --</option>
        <option value="1" <?= ($_GET['semester'] ?? '') == '1' ? 'selected' : '' ?>>1</option>
        <option value="2" <?= ($_GET['semester'] ?? '') == '2' ? 'selected' : '' ?>>2</option>
    </select>

    <select name="tahun">
        <option value="">-- Tahun Ajaran --</option>
        <option value="2024/2025" <?= ($_GET['tahun'] ?? '') == '2024/2025' ? 'selected' : '' ?>>
            2024/2025
        </option>
        <option value="2025/2026" <?= ($_GET['tahun'] ?? '') == '2025/2026' ? 'selected' : '' ?>>
            2025/2026
        </option>
        <option value="2026/2027" <?= ($_GET['tahun'] ?? '') == '2026/2027' ? 'selected' : '' ?>>
            2026/2027
        </option>
    </select>

    <button type="submit" class="button-blue">FILTER</button>
    <a href="read_fadlan_raport.php" class="button-red">RESET</a>
</form>
<table border="1">
<tr>
    <th>NIS</th>
    <th>ID Nilai</th>
    <th>Nama</th>
    <th>Mapel</th>
    <th>Nilai Tugas</th>
    <th>Nilai UTS</th>
    <th>Nilai UAS</th>
    <th>Nilai Akhir</th>
    <th>Deskripsi</th>
    <th>Semester</th>
    <th>Tahun Ajaran</th>
    <th>Opsi</th>
</tr>

<?php while ($d = mysqli_fetch_array($data)) { ?>
<tr>
    <td><?= $d['nis']; ?></td>
    <td><?= $d['id_nilai']; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['nama_mapel']; ?></td>
    <td><?= $d['nilai_tugas']; ?></td>
    <td><?= $d['nilai_uts']; ?></td>
    <td><?= $d['nilai_uas']; ?></td>
    <td><?= $d['nilai_akhir']; ?></td>
    <td><?= $d['deskripsi']; ?></td>
    <td><?= $d['semester']; ?></td>
    <td><?= $d['tahun_ajaran']; ?></td>
    <td>
        <a href="update_fadlan_raport.php?id_nilai=<?= $d['id_nilai']; ?>"><button class="button-yellow">EDIT</button></a>
        <a href="hapus_fadlan_raport.php?id_nilai=<?= $d['id_nilai']; ?>" onclick="return confirm('Yakin hapus data?')">
            <button class="button-red">HAPUS</button>
        </a>
        <a href="lihat_fadlan_raport.php?id_nilai=<?= $d['id_nilai']; ?>"><button class="button-blue">CETAK</button></a>
    </td>
</tr>
<?php } ?>
</table>

<br>
<a href="tambah_fadlan_raport.php" class="add-link">+ Tambah Data</a><br><br>
<a href="cetakv2.php" target="_blank" class="button">Cetak Semua Data</a>

</center>
</body>
</html>

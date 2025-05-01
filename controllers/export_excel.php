<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Pesanan.xls");

include '../config/koneksi.php';

echo "<table border='1'>";
echo "<tr>
        <th>Nama Pelanggan</th>
        <th>Pesanan</th>
        <th>Tanggal</th>
        <th>Total Harga</th>
      </tr>";

$sql = "SELECT p.nama_pelanggan, GROUP_CONCAT(m.nama_menu SEPARATOR ', ') AS pesanan, ps.tanggal_pesanan, SUM(dp.jumlah * m.harga) AS total_harga
        FROM tb_pesanan ps
        JOIN tb_pelanggan p ON ps.id_pelanggan = p.id_pelanggan
        JOIN tb_detail_pesanan dp ON ps.id_pesanan = dp.id_pesanan
        JOIN tb_menu m ON dp.id_menu = m.id_menu
        GROUP BY ps.id_pesanan";

$query = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($query)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['nama_pelanggan']) . "</td>";
    echo "<td>" . htmlspecialchars($row['pesanan']) . "</td>";
    echo "<td>" . htmlspecialchars(date('d-m-Y', strtotime($row['tanggal_pesanan']))) . "</td>";
    echo "<td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
    echo "</tr>";
}

echo "</table>";

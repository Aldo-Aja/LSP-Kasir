<?php
include '../config/koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // optional filter pakai id

$sql = "SELECT p.nama_pelanggan, GROUP_CONCAT(m.nama_menu SEPARATOR ', ') AS pesanan, ps.tanggal_pesanan, SUM(dp.jumlah * m.harga) AS total_harga
        FROM tb_pesanan ps
        JOIN tb_pelanggan p ON ps.id_pelanggan = p.id_pelanggan
        JOIN tb_detail_pesanan dp ON ps.id_pesanan = dp.id_pesanan
        JOIN tb_menu m ON dp.id_menu = m.id_menu";

if ($id > 0) {
    $sql .= " WHERE ps.id_pesanan = $id";
}

$sql .= " GROUP BY ps.id_pesanan";

$query = mysqli_query($conn, $sql);
$total = 0;

while ($row = mysqli_fetch_assoc($query)) {
    $total += $row['total_harga'];
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['nama_pelanggan']) . "</td>";
    echo "<td>" . htmlspecialchars($row['pesanan']) . "</td>";
    echo "<td>" . date('d-m-Y', strtotime($row['tanggal_pesanan'])) . "</td>";
    echo "<td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
    echo "</tr>";
}

// Kirim total juga (optional), kamu bisa kirim via data-atribut atau JSON kalau mau lebih lanjut

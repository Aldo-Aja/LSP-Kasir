<?php
include '../config/koneksi.php';
$totalKeseluruhan = 0;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Print Laporan Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        tfoot td {
            font-weight: bold;
            background: #f0f0f0;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <h2>Laporan Pesanan</h2>
    <button onclick="window.print()" class="no-print">🖨 Cetak PDF</button>

    <table>
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>Pesanan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT p.nama_pelanggan, GROUP_CONCAT(m.nama_menu SEPARATOR ', ') AS pesanan, ps.tanggal_pesanan, SUM(dp.jumlah * m.harga) AS total_harga
                    FROM tb_pesanan ps
                    JOIN tb_pelanggan p ON ps.id_pelanggan = p.id_pelanggan
                    JOIN tb_detail_pesanan dp ON ps.id_pesanan = dp.id_pesanan
                    JOIN tb_menu m ON dp.id_menu = m.id_menu
                    GROUP BY ps.id_pesanan";

            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
                $totalKeseluruhan += $row['total_harga'];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nama_pelanggan']) . "</td>";
                echo "<td>" . htmlspecialchars($row['pesanan']) . "</td>";
                echo "<td>" . date('d-m-Y', strtotime($row['tanggal_pesanan'])) . "</td>";
                echo "<td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;">Total Keseluruhan</td>
                <td>Rp <?= number_format($totalKeseluruhan, 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
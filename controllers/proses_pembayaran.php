<?php
include '../config/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Sesi tidak valid. Silakan login kembali.");
}


header('Content-Type: text/plain'); // Supaya AJAX dapat respon teks

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode tidak diperbolehkan.');
}

// Ambil data POST
$id_meja = $_POST['id_meja'] ?? null;
$total = $_POST['total'] ?? 0;
$pajak = $_POST['pajak'] ?? 0;
$grand_total = $_POST['grand_total'] ?? 0;
$id_kasir = $_POST['id_kasir'] ?? null;

// Validasi
if (!$id_meja || !$id_kasir) {
    http_response_code(400);
    exit("ID Meja atau ID Kasir kosong.");
}

// Ambil semua ID pesanan berdasarkan meja
$sql = "SELECT id_pesanan FROM tb_pesanan WHERE id_meja = ? AND status_pembayaran != 'Selesai'";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id_meja);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$pesanan_ids = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pesanan_ids[] = $row['id_pesanan'];
}

if (count($pesanan_ids) === 0) {
    exit("Tidak ada pesanan yang perlu diselesaikan.");
}

$tanggal_transaksi = date('Y-m-d H:i:s');

// Proses tiap pesanan
foreach ($pesanan_ids as $id_pesanan) {
    // Update status
    $update = "UPDATE tb_pesanan SET status_pembayaran = 'Sudah' WHERE id_pesanan = ?";
    $stmt_update = mysqli_prepare($conn, $update);
    if (!$stmt_update) {
        exit("Gagal menyiapkan query UPDATE: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt_update, 'i', $id_pesanan);
    if (!mysqli_stmt_execute($stmt_update)) {
        exit("Gagal menjalankan UPDATE: " . mysqli_stmt_error($stmt_update));
    }

    // Insert transaksi
    $insert = "INSERT INTO tb_transaksi (id_pesanan, id_user_kasir, total_harga, pajak, total_bayar, tanggal_transaksi)
               VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($conn, $insert);
    if (!$stmt_insert) {
        exit("Gagal menyiapkan query INSERT: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt_insert, 'iiddds', $id_pesanan, $id_kasir, $total, $pajak, $grand_total, $tanggal_transaksi);
    if (!mysqli_stmt_execute($stmt_insert)) {
        exit("Gagal menjalankan INSERT: " . mysqli_stmt_error($stmt_insert));
    }
}

echo "Pembayaran berhasil!";

<?php
include '../config/koneksi.php';
header('Content-Type: application/json');

// === HANDLE GET MENU ===
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id_meja'])) {
  $query = "
    SELECT m.id_menu, m.nama_menu, k.nama_kategori
    FROM tb_menu m
    JOIN tb_kategori_menu k ON m.id_kategori = k.id_kategori
    ORDER BY k.nama_kategori, m.nama_menu
  ";

  $result = $conn->query($query);
  $menus = [];

  while ($row = $result->fetch_assoc()) {
    $kategori = $row['nama_kategori'];
    if (!isset($menus[$kategori])) {
      $menus[$kategori] = [];
    }
    $menus[$kategori][] = [
      'id'   => $row['id_menu'],
      'nama' => $row['nama_menu']
    ];
  }

  echo json_encode($menus);
  exit;
}

// === HANDLE GET RIWAYAT PER MEJA ===
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_meja'])) {
  $id_meja = $_GET['id_meja'];

  // Ambil semua ID pesanan untuk meja ini yang belum dibayar
  $qPesanan = "
    SELECT id_pesanan 
    FROM tb_pesanan 
    WHERE id_meja = '$id_meja' 
      AND status_pemabayaran = 'Belum'
  ";
  $resPesanan = $conn->query($qPesanan);
  $riwayat = [];

  if ($resPesanan && $resPesanan->num_rows > 0) {
    while ($rowPesanan = $resPesanan->fetch_assoc()) {
      $id_pesanan = $rowPesanan['id_pesanan'];

      // Ambil detail pesanan untuk setiap id_pesanan
      $qDetail = "
        SELECT m.nama_menu, m.harga, d.jumlah, d.catatan, (m.harga * d.jumlah) AS subtotal
        FROM tb_detail_pesanan d
        JOIN tb_menu m ON d.id_menu = m.id_menu
        WHERE d.id_pesanan = '$id_pesanan'
      ";
      $resDetail = $conn->query($qDetail);

      while ($rowDetail = $resDetail->fetch_assoc()) {
        $riwayat[] = $rowDetail;
      }
    }

    echo json_encode([
      'success' => true,
      'riwayat' => $riwayat
    ]);
  } else {
    echo json_encode(['success' => false, 'message' => 'Tidak ada pesanan yang belum dibayar untuk meja ini.']);
  }
  exit;
}



// === HANDLE POST PESANAN ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_meja      = $_POST['id_meja'] ?? null;
  $id_pelanggan = $_POST['id_pelanggan'] ?? null;
  $id_user      = $_SESSION['id_user'] ?? 1; // Ganti sesuai session login real

  // Validasi input
  if (!$id_meja || !$id_pelanggan) {
    echo json_encode([
      'success' => false,
      'message' => 'ID meja atau ID pelanggan tidak boleh kosong'
    ]);
    exit;
  }

  // Masukkan ke tb_pesanan
  $insertPesanan = mysqli_query($conn, "
    INSERT INTO tb_pesanan (id_meja, id_user, id_pelanggan)
    VALUES ('$id_meja', '$id_user', '$id_pelanggan')
  ");

  if (!$insertPesanan) {
    echo json_encode([
      'success' => false,
      'message' => 'Gagal insert pesanan: ' . mysqli_error($conn)
    ]);
    exit;
  }

  $id_pesanan = mysqli_insert_id($conn);

  // Masukkan ke tb_detail_pesanan
  foreach ($_POST['menu_pesanan'] as $index => $id_menu) {
    $jumlah  = $_POST['jumlah'][$index] ?? 1;
    $catatan = $_POST['catatan'][$index] ?? '';

    $insertDetail = mysqli_query($conn, "
      INSERT INTO tb_detail_pesanan (id_pesanan, id_menu, jumlah, catatan)
      VALUES ('$id_pesanan', '$id_menu', '$jumlah', '$catatan')
    ");

    if (!$insertDetail) {
      echo json_encode([
        'success' => false,
        'message' => 'Gagal insert detail: ' . mysqli_error($conn)
      ]);
      exit;
    }
  }

  echo json_encode(['success' => true, 'message' => 'Pesanan berhasil ditambahkan']);
}
?>

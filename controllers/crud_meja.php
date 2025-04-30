<?php
include '../config/koneksi.php';

// Tambah meja baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nomor_meja']) && !isset($_POST['id_meja'])) {
    $nomor = intval($_POST['nomor_meja']);
    $conn->query("INSERT INTO tb_meja (nomor_meja, status) VALUES ($nomor, 'Kosong')");
    header('Location: ../views/entri_meja.php');
    exit;
}

// Update meja + Tambah pelanggan
if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['id_meja'], $_POST['status'], $_POST['nama_pelanggan'], $_POST['jenis_kelamin'], $_POST['nohp'], $_POST['alamat'])) 
{
    $id_meja = intval($_POST['id_meja']);
    $status = ($_POST['status'] === 'occupied') ? 'Terisi' : 'Kosong';

    // Escape semua input
    $nama   = $conn->real_escape_string($_POST['nama_pelanggan']);
    $jk     = $conn->real_escape_string($_POST['jenis_kelamin']);
    $nohp   = $conn->real_escape_string($_POST['nohp']);
    $alamat = $conn->real_escape_string($_POST['alamat']);

    // Tambahkan ke tb_pelanggan
    $conn->query("INSERT INTO tb_pelanggan (nama_pelanggan, jenis_kelamin, nohp, alamat)
                  VALUES ('$nama', '$jk', '$nohp', '$alamat')");

    $id_pelanggan = $conn->insert_id;

    // Update tb_meja dengan id_pelanggan
    $ok = $conn->query(
      "UPDATE tb_meja 
       SET status='$status', id_pelanggan=$id_pelanggan
       WHERE id_meja=$id_meja"
    );

    header('Content-Type: application/json');
    echo json_encode([
      'success'     => (bool)$ok,
      'id_meja'     => $id_meja,
      'status'      => $status === 'Terisi' ? 'occupied' : 'available',
      'nama_pelanggan' => $nama
    ]);
    exit;
}

// Tampilkan grid meja dengan JOIN ke tb_pelanggan
$result = $conn->query(
  "SELECT m.id_meja, m.nomor_meja, m.status, m.id_pelanggan,
          p.nama_pelanggan
   FROM tb_meja m
   LEFT JOIN tb_pelanggan p ON m.id_pelanggan = p.id_pelanggan"
);


// HTML Grid
echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-6">';

while ($r = $result->fetch_assoc()) {
  $occ    = $r['status'] === 'Terisi';
  $border = $occ
    ? 'border-start border-2 border-start-danger'
    : 'border-start border-2 border-start-success';
  $text   = $occ ? 'Terisi' : 'Available';
  $res    = ($occ && $r['nama_pelanggan']) 
    ? ' ('.htmlspecialchars($r['nama_pelanggan']).')' 
    : '';

  echo '<div class="col">';
    echo "<div class=\"card h-100 overflow-auto $border\" data-id=\"{$r['id_meja']}\" data-pelanggan=\"{$r['id_pelanggan']}\">";
      echo '<div class="card-body d-flex flex-column justify-content-between">';
        echo '<div>';
          echo '<h5 class="m-0 me-2">Meja '.htmlspecialchars($r['nomor_meja']).'</h5>';
          echo '<p class="card-text pt-2 mb-2">Status: '. $text . $res . '</p>';
        echo '</div>';

        echo '<div class="d-flex justify-content-between align-items-center">';
          echo '<button class="btn btn-icon btn-sm btn-primary btn-edit">'
              . '<i class="bx bx-edit icon-20px"></i>'
              . '</button>';

          // Tombol Order jika Waiter dan meja Terisi
          if ($_SESSION['role'] === 'Waiter' && $occ) {
            echo '<button class="btn btn-sm btn-success btn-order" 
                          data-bs-toggle="modal" 
                          data-bs-target="#modalAddPesanan"
                          data-id="'.$r['id_meja'].'" 
                          data-meja="'.htmlspecialchars($r['nomor_meja']).'">
                    Order
                  </button>';

            echo '<button class="btn btn-sm btn-info btn-riwayat"
                          data-id="'.$r['id_meja'].'" 
                          data-meja="'.htmlspecialchars($r['nomor_meja']).'">
                    Riwayat
                  </button>';
          }
        echo '</div>';

      echo '</div>';
    echo '</div>';
  echo '</div>';
}
echo '</div>';
$conn->close();
?>

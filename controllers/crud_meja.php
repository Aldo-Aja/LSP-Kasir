<?php
include '../config/koneksi.php';

// 0) Handle Add New Meja (form Add)
if ($_SERVER['REQUEST_METHOD']==='POST'
    && isset($_POST['nomor_meja'])
    && !isset($_POST['id_meja'])) {
    $nomor = intval($_POST['nomor_meja']);
    $conn->query("INSERT INTO tb_meja (nomor_meja, status) VALUES ($nomor,'Kosong')");
    header('Location: ../views/entri_meja.php');
    exit;
}

// 1) Handle AJAX Update
if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['id_meja'], $_POST['status'], $_POST['reserved_by'])) 
{
    $id       = intval($_POST['id_meja']);
    $status   = ($_POST['status'] === 'occupied') ? 'Terisi' : 'Kosong';
    $reserved = $conn->real_escape_string($_POST['reserved_by']);

    $ok = $conn->query(
      "UPDATE tb_meja 
       SET status='$status', reserved_by='$reserved'
       WHERE id_meja=$id"
    );

    header('Content-Type: application/json');
    echo json_encode([
      'success'     => (bool)$ok,
      'id_meja'     => $id,
      'status'      => $status==='Terisi'?'occupied':'available',
      'reserved_by' => $reserved
    ]);
    exit;
}

// 2) Default: Tampilkan Grid
$result = $conn->query(
  "SELECT id_meja, nomor_meja, status,
          COALESCE(reserved_by,'') AS reserved_by
   FROM tb_meja"
);
echo '<div class="row row-cols-1 row-cols-sm-2 '
   . 'row-cols-md-3 row-cols-lg-4 g-4 mb-6">';

while ($r = $result->fetch_assoc()) {
  $occ    = $r['status']==='Terisi';
  $border = $occ
    ? 'border-start border-2 border-start-danger'
    : 'border-start border-2 border-start-success';
  $text   = $occ?'Terisi':'Available';
  $res    = ($occ && $r['reserved_by']) 
    ? ' ('.htmlspecialchars($r['reserved_by']).')' 
    : '';

  echo '<div class="col">';
    echo "<div class=\"card h-100 overflow-auto $border\" data-id=\"{$r['id_meja']}\">";
      echo '<div class="card-body d-flex justify-content-between align-items-center">';
        echo '<div>';
          echo '<h5 class="m-0 me-2">Meja '.htmlspecialchars($r['nomor_meja']).'</h5>';
          echo '<p class="card-text pt-2 mb-0">Status: '. $text . $res . '</p>';
        echo '</div>';
        echo '<button class="btn btn-icon btn-sm btn-primary btn-edit">'
            . '<i class="bx bx-edit icon-20px"></i>'
            . '</button>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
}
echo '</div>';
$conn->close();
?>

<?php
// crud_menu.php
header('Content-Type: application/json; charset=utf-8');
include '../config/koneksi.php';

// 1) Tambah Menu (Create)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama_menu'])) {
    $nama     = $conn->real_escape_string($_POST['nama_menu']);
    $kategori = intval($_POST['id_kategori']);
    $harga    = floatval($_POST['harga']);
    $stok     = intval($_POST['stok']);
    $desk     = $conn->real_escape_string($_POST['deskripsi']);

    $sql = "INSERT INTO tb_menu (id_kategori, nama_menu, harga, stok, deskripsi)
            VALUES ($kategori, '$nama', $harga, $stok, '$desk')";
    if ($conn->query($sql)) {
        echo json_encode(['success' => true, 'id_menu' => $conn->insert_id]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}

// 2) Update Menu (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        // Ambil data edit
        $id_menu = $_POST['id_menu'];
        $nama_menu = $_POST['nama_menu'];
        $id_kategori = $_POST['id_kategori'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $deskripsi = $_POST['deskripsi'];

        // Lakukan query UPDATE
        $stmt = $conn->prepare("UPDATE tb_menu SET nama_menu=?, id_kategori=?, harga=?, stok=?, deskripsi=? WHERE id_menu=?");
        $stmt->bind_param("siisii", $nama_menu, $id_kategori, $harga, $stok, $deskripsi, $id_menu);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $stmt->error]);
        }

        exit;
    }
}

// 3) Delete Menu (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id_menu'])) {
    $id = intval($_GET['id_menu']);
    $sql = "DELETE FROM tb_menu WHERE id_menu=$id";
    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}

// 4) Read Menu (untuk listing, optional jika dipanggil via PHP include)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $res = mysqli_query($conn,
      "SELECT m.id_menu, k.nama_kategori, m.nama_menu, m.harga, m.stok, m.deskripsi
       FROM tb_menu m
       LEFT JOIN tb_kategori_menu k ON m.id_kategori=k.id_kategori
       ORDER BY m.id_menu ASC"
    );
    $menus = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $menus[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $menus]);
    exit;
}

$conn->close();

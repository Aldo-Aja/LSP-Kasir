<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan data diterima dengan benar
    if (isset($_POST['id_meja'], $_POST['total'], $_POST['pajak'], $_POST['grand_total'], $_POST['id_kasir'])) {
        
        $id_meja = intval($_POST['id_meja']);
        $total = $_POST['total'];
        $pajak = $_POST['pajak'];
        $grand_total = $_POST['grand_total'];
        $id_kasir = $_POST['id_kasir'];
        
        // Koneksi ke database
        include 'koneksi.php';  // Pastikan sudah ada file koneksi

        // Update status pembayaran menjadi 'Lunas'
        $query = "UPDATE tb_pesanan SET status_pembayaran = 'Sudah' WHERE id_meja = $id_meja AND status_pembayaran != 'Sudah'"; 
        echo $query;


        
        if (mysqli_query($conn, $query)) {
            echo 'Pembayaran berhasil!';
        } else {
            echo 'Gagal mengupdate status pembayaran: ' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>

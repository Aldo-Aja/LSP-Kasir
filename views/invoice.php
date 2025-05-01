<?php
include '../config/koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$id_meja = isset($_GET['id_meja']) ? intval($_GET['id_meja']) : 0;

if ($id_meja <= 0) {
    die("ID Meja tidak valid.");
}

$query = "
SELECT dm.nama_menu, dm.harga, dp.jumlah, dp.catatan, (dm.harga * dp.jumlah) AS subtotal,
       p.id_pesanan, p.id_user, u.nama_lengkap AS kasir, pl.nama_pelanggan, p.tanggal_pesanan
FROM tb_detail_pesanan dp
JOIN tb_menu dm ON dp.id_menu = dm.id_menu
JOIN tb_pesanan p ON dp.id_pesanan = p.id_pesanan
JOIN tb_user u ON p.id_user = u.id_user
JOIN tb_pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
WHERE p.id_meja = $id_meja
";


$result = mysqli_query($conn, $query);
$items = [];
$total = 0;
$rowInfo = null;

while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
    $total += $row['subtotal'];
    $rowInfo = $row;
}

$pajak = $total * 0.1;
$grand_total = $total + $pajak;

?>

<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Invoice</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include '../includes/navbar.php' ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row invoice-preview">
                            <!-- Invoice -->
                            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-6" id="invoice">
                                <div class="card invoice-preview-card p-sm-12 p-6">
                                    <div class="card-body invoice-preview-header rounded">
                                        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column align-items-xl-center align-items-md-start align-items-sm-center align-items-start">
                                            <div class="mb-xl-0 mb-6 text-heading">
                                                <div class="d-flex svg-illustration mb-6 gap-2 align-items-center">
                                                    <span class="app-brand-text demo fw-bold ms-50 lh-1">Sneat</span>
                                                </div>
                                                <p class="mb-0">Jl. Melawai 1</p>
                                                <p class="mb-0">+62 8123-456-789</p>
                                            </div>
                                            <div>
                                                <h5 class="mb-6">Invoice</h5>
                                                <div class="mb-1 text-heading">
                                                    <span>Tanggal: <?= date('d-m-Y') ?></span>
                                                    <span class="fw-medium"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-6 mb-sm-0 mb-6">
                                                <h6>Invoice To:</h6>
                                                <p class="mb-1"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive border border-bottom-0 border-top-0 rounded">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Menu</th>
                                                    <th>Harga</th>
                                                    <th>Banyak</th>
                                                    <th>Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($items as $index => $item): ?>
                                                    <tr>
                                                        <td><?= $index + 1 ?></td>
                                                        <td><?= $item['nama_menu'] ?></td>
                                                        <td>Rp<?= number_format($item['harga']) ?></td>
                                                        <td><?= $item['jumlah'] ?></td>
                                                        <td>Rp<?= number_format($item['subtotal']) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table m-0 table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="align-top pe-6  py-6 text-body">
                                                        ...
                                                        <p class="mb-2">Subtotal: Rp<?= number_format($total) ?></p>
                                                        <p class="mb-2 border-bottom pb-2">PB1 (10%): Rp<?= number_format($pajak) ?></p>
                                                        <p class="mb-0">Total: <strong>Rp<?= number_format($grand_total) ?></strong></p>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <hr class="mt-0 mb-6" />
                                </div>
                            </div>
                            <!-- /Invoice -->

                            <!-- Invoice Actions -->
                            <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                                <div class="card">
                                    <div class="card-body">
                                        <button class="btn btn-primary d-grid w-100 mb-4" onclick="printInvoice()" target="_blank">Print</button>
                                        <form id="form-bayar" method="POST">
                                            <input type="hidden" name="id_meja" value="<?= $id_meja ?>">
                                            <input type="hidden" name="total" value="<?= $total ?>">
                                            <input type="hidden" name="pajak" value="<?= $pajak ?>">
                                            <input type="hidden" name="grand_total" value="<?= $grand_total ?>">
                                            <input type="hidden" name="id_kasir" value="<?= $_SESSION['user_id'] ?>">
                                            <button type="submit" class="btn btn-warning d-grid w-100 me-0" id="btn-bayar">Bayar & Selesai</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice Actions -->



                        </div>
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    <?php include '../includes/footer.php' ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script>
        document.getElementById('form-bayar').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah form untuk submit biasa

            var formData = new FormData(this);

            // Menggunakan AJAX untuk mengirim data
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../controllers/proses_pembayaran.php', true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert('Respon dari server: ' + xhr.responseText); // <-- ini penting
                    location.reload(); // ini boleh dibiarkan
                } else {
                    alert('Terjadi kesalahan saat memproses pembayaran.');
                }
            };


            xhr.send(formData);
        });

        function printInvoice() {
            var invoiceContent = document.getElementById("invoice").innerHTML;
            var printWindow = window.open("", "", "width=1000,height=700");

            printWindow.document.write('<html><head><title>Invoice</title>');

            // Tambahkan semua <link rel="stylesheet"> dari halaman utama
            document.querySelectorAll('link[rel="stylesheet"]').forEach((link) => {
                printWindow.document.write(link.outerHTML);
            });

            // Tambahkan juga styling landscape saat print
            printWindow.document.write(`
    <style>
      @media print {
        @page {
          size: A4 landscape;
          margin: 20mm;
        }
      }
    </style>
  `);

            printWindow.document.write('</head><body>');
            printWindow.document.write(invoiceContent);
            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.focus();

            // Tunggu sebentar supaya CSS sempat terload
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 1000);
        }
    </script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
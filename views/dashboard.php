<?php
include __DIR__ . '/../config/koneksi.php';
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location: ../public/login.php");
  exit();
}

// Ambil Menu Terlaris
$query_terlaris = "SELECT m.nama_menu, SUM(d.jumlah) AS total_jual
                   FROM tb_detail_pesanan d
                   JOIN tb_menu m ON d.id_menu = m.id_menu
                   GROUP BY d.id_menu
                   ORDER BY total_jual DESC
                   LIMIT 1";
$terlaris = mysqli_fetch_assoc(mysqli_query($conn, $query_terlaris));

// Ambil Menu Kurang Laris
$query_kurang_laris = "SELECT m.nama_menu, SUM(d.jumlah) AS total_jual
                       FROM tb_detail_pesanan d
                       JOIN tb_menu m ON d.id_menu = m.id_menu
                       GROUP BY d.id_menu
                       ORDER BY total_jual ASC
                       LIMIT 1";
$kurang_laris = mysqli_fetch_assoc(mysqli_query($conn, $query_kurang_laris));

// Total Order
$query_jumlah_order = "SELECT COUNT(*) AS total_order FROM tb_pesanan";
$jumlah_order = mysqli_fetch_assoc(mysqli_query($conn, $query_jumlah_order));

// Total Pendapatan
$query_pendapatan = "SELECT SUM(dp.jumlah * m.harga) AS total_pendapatan
                     FROM tb_detail_pesanan dp
                     JOIN tb_menu m ON dp.id_menu = m.id_menu";
$pendapatan = mysqli_fetch_assoc(mysqli_query($conn, $query_pendapatan));
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
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Dashboard - Analytics | Admin</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

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
            <div class="col-12">
              <div class="card">
                <div class="card-widget-separator-wrapper">
                  <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                      <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                          <div>
                            <h3 class="mb-2"><?= $terlaris['total_jual'] ?? '0' ?></h3>
                            <h5 class="mb-2"><?= $terlaris['nama_menu'] ?? '-' ?></h5>
                            <p class="mb-0">Menu Terlaris</p>
                          </div>
                          <div class="avatar me-sm-3">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                              <i class="icon-base bx bx-line-chart icon-26px"></i>
                            </span>
                          </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6">
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-center card-widget-2 border-end pb-4 pb-sm-0">
                          <div>
                            <h3 class="mb-2"><?= $kurang_laris['total_jual'] ?? '0' ?></h3>
                            <h5 class="mb-2"><?= $kurang_laris['nama_menu'] ?? '-' ?></h5>
                            <p class="mb-0">Menu Kurang Laris</p>

                          </div>
                          <div class="avatar me-lg-3">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                              <i class="icon-base bx bx-line-chart-down icon-26px"></i>
                            </span>
                          </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3">
                          <div>
                            <h3 class="mb-2"><?= $jumlah_order['total_order'] ?? '0' ?></h3>
                            <h5 class="mb-2">Pesanan</h5>
                            <p class="mb-0">Jumlah Order</p>

                          </div>
                          <div class="avatar me-sm-3">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                              <i class="icon-base bx bx-bar-chart-alt-2 icon-26px"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h3 class="mb-2">Rp <?= number_format($pendapatan['total_pendapatan'] ?? 0, 0, ',', '.') ?></h3>
                            <h5 class="mb-2">Total</h5>
                            <p class="mb-0">Jumlah Pendapatan</p>
                          </div>
                          <div class="avatar">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                              <i class="icon-base bx bx-money icon-26px"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
  <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
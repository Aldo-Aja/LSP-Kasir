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

    <title>Generate Laporan</title>

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
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">
                            <div class="card-datatable text-nowrap">
                                <div id="DataTables_Table_0_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                                    <div class="row card-header flex-column flex-md-row pb-0">
                                        <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto mt-0">
                                            <h5 class="card-title mb-0 text-md-start text-center">Laporan</h5>
                                        </div>
                                        <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto mt-0">
                                            <div class="dt-buttons btn-group flex-wrap mb-0">
                                                <div class="btn-group">
                                                    <button class="btn btn-label-primary dropdown-toggle me-4" data-bs-toggle="dropdown">
                                                        <i class="bx bx-export me-sm-1"></i>
                                                        <span class="d-none d-sm-inline-block">Export</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="../controllers/export_excel.php" target="_blank">Export ke Excel</a></li>
                                                        <li><a class="dropdown-item" href="../controllers/print_pdf.php" target="_blank">Export ke PDF</a></li>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-between dt-layout-table">
                                        <div class="d-md-flex justify-content-between align-items-center col-12 dt-layout-full col-md">
                                            <table class="datatables-basic table table-bordered table-responsive dataTable dtr-column collapsed" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 100%;">
                                                <colgroup>
                                                    <col data-dt-column="0" style="width: 286.888px;">
                                                    <col data-dt-column="1" style="width: 274.125px;">
                                                    <col data-dt-column="2" style="width: 117.975px;">
                                                    <col data-dt-column="3" style="width: 117.925px;">
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th data-dt-column="3" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Name: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Nama Pelanggan</span><span class="dt-column-order"></span></th>
                                                        <th data-dt-column="4" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Email: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Pesanan</span><span class="dt-column-order"></span></th>
                                                        <th data-dt-column="5" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Date: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Date</span><span class="dt-column-order"></span></th>
                                                        <th data-dt-column="6" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc dt-type-numeric" aria-label="Salary: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Total Harga </span><span class="dt-column-order"></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabel-laporan">
                                                </tbody>
                                                <tfoot></tfoot>
                                            </table>
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

    <script>
        $(document).ready(function() {
            // Muat isi tabel menggunakan AJAX dari file PHP eksternal
            $('#tabel-laporan').load('../controllers/generate_laporan.php');
        });
        // Hubungkan tombol dropdown dengan fungsi export
        $('#exportExcel').on('click', function() {
            table.button('.buttons-excel').trigger();
        });

        $('#exportPDF').on('click', function() {
            table.button('.buttons-pdf').trigger();
        });
    </script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
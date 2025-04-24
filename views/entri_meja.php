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
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Meja - Entri Meja | Admin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

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
          <?php include '../includes/navbar.php'?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Tombol Add -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddTable">
                  <i class="bx bx-plus me-1"></i> Add
                </button>
              </div>

              <!-- Grid kartu meja responsif -->
              <?php include '../controllers/crud_meja.php'?>
              </div>
            </div>


            <!-- MODAL ADD TABLE -->
          <div class="modal fade" id="modalAddTable" tabindex="-1" aria-labelledby="modalAddTableLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <form action="../controllers/crud_meja.php" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalAddTableLabel">Add New Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="tableNumber" class="form-label">Nomor Meja</label>
                      <input type="number" class="form-control" id="tableNumber" name="nomor_meja" required />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Meja</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- END MODAL ADD TABLE -->

          <div class="modal fade" id="modalEditTable" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <form id="formEditTable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Meja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="editTableId" name="id_meja"/>
                    <div class="mb-3">
                      <label class="form-label">Atas Nama</label>
                      <input type="text" class="form-control" id="editReservedBy" name="reserved_by" required/>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="editStatus" name="status"/>
                      <label class="form-check-label" for="editStatus">Terisi</label>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- END MODAL EDIT TABLE -->

            <!-- / Content -->

            <!-- Footer -->
             <?php include '../includes/footer.php'?>
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
    </div>

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
      document.addEventListener('DOMContentLoaded', () => {
        const editModalEl = document.getElementById('modalEditTable');
        const editModal   = new bootstrap.Modal(editModalEl);

        // Buka modal saat klik edit
        document.querySelectorAll('.btn-edit').forEach(btn => {
          btn.addEventListener('click', () => {
            const card    = btn.closest('.card');
            const id_meja = card.getAttribute('data-id');
            const txt     = card.querySelector('.card-text').textContent;
            const isOcc   = txt.includes('Terisi');
            document.getElementById('editTableId').value     = id_meja;
            document.getElementById('editReservedBy').value  = isOcc
              ? txt.match(/\((.+)\)/)?.[1] || ''
              : '';
            document.getElementById('editStatus').checked    = isOcc;
            editModal.show();
          });
        });

        // Submit form → AJAX ke crud_meja.php
        document.getElementById('formEditTable')
          .addEventListener('submit', async e => {
            e.preventDefault();
            const fd = new FormData(e.target);
            fd.set('status', fd.get('status') === 'on' ? 'occupied' : 'available');

            const res = await fetch('../controllers/crud_meja.php', { method: 'POST', body: fd });
            const data= await res.json();

            if (data.success) {
              const card   = document.querySelector(`.card[data-id="${data.id_meja}"]`);
              const footer = card.querySelector('.card-footer');
              const txt    = card.querySelector('.card-text');

              if (data.status === 'occupied') {
                footer.classList.replace('bg-success','bg-danger');
                txt.textContent = `Status: Terisi (${data.reserved_by})`;
              } else {
                footer.classList.replace('bg-danger','bg-success');
                txt.textContent = 'Status: Available';
              }
              bootstrap.Modal.getInstance(editModalEl).hide();
            }
          });
      });
      </script>



    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>

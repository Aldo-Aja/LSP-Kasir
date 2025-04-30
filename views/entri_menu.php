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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>Meja - Entri Meja | Admin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

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

              <div class="d-flex justify-content-between align-items-center mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddMenu">
                  <i class="bx bx-plus me-1"></i> Add
                </button>
              </div>

              <!-- Hoverable Table rows -->
              <div class="card">
                <h5 class="card-header">Entri Menu</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th class="w-25">Deskripsi</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="loadsMenu">

                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Hoverable Table rows -->
            </div>

            <!-- Modal Tambah Menu -->
            <div class="modal fade" id="modalAddMenu" tabindex="-1" aria-labelledby="modalAddMenuLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <form id="formAddMenu" method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalAddMenuLabel">Tambah Menu Baru</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="nama_menu" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="nama_menu" name="nama_menu" required>
                      </div>

                      <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori Menu</label>
                        <select class="form-select" id="id_kategori" name="id_kategori" required>
                          <option value="" disabled selected>Pilih Kategori</option>
                          <option value="1">Appetizer</option>
                          <option value="2">Main Course</option>
                          <option value="3">Dessert</option>
                          <option value="4">Spesial Of The Day</option>
                          <option value="5">Drink</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                      </div>

                      <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                      </div>

                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi menu..."></textarea>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan Menu</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Modal Edit Menu -->

          </div>
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
$(document).ready(function () {
  // Fungsi untuk membuat huruf kapital pada setiap kata
  function capitalizeWords(str) {
    return str.toLowerCase().replace(/\b\w/g, function (char) {
      return char.toUpperCase();
    });
  }

  // Fungsi untuk memuat semua menu dari server
  function loadMenus() {
    $.ajax({
      url: '../controllers/crud_menu.php',
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if (response.success) {
          const menus = response.data;
          let tableRows = '';
          menus.forEach((menu, index) => {
            tableRows += `
              <tr>
                <td>${index + 1}</td>
                <td>${capitalizeWords(menu.nama_menu)}</td>
                <td>${capitalizeWords(menu.nama_kategori)}</td>
                <td>Rp${parseInt(menu.harga).toLocaleString()}</td>
                <td>${menu.stok}</td>
                <td>${menu.deskripsi}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript:void(0);" onclick="editMenu(${menu.id_menu})">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                      </a>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="deleteMenu(${menu.id_menu})">
                        <i class="bx bx-trash me-1"></i> Delete
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
            `;
          });
          $('#loadsMenu').html(tableRows);
        } else {
          $('#loadsMenu').html('<tr><td colspan="7" class="text-center">Gagal memuat data.</td></tr>');
        }
      },
      error: function () {
        $('#loadsMenu').html('<tr><td colspan="7" class="text-center">Terjadi kesalahan saat mengambil data.</td></tr>');
      }
    });
  }

  // Panggil fungsi awal untuk load data
  loadMenus();

  // Tambah menu
  $('#formAddMenu').on('submit', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.ajax({
      url: '../controllers/crud_menu.php',
      method: 'POST',
      data: formData,
      dataType: 'json',
      success: function (response) {
        if (response.success) {
          alert('Menu berhasil ditambahkan!');
          $('#modalAddMenu').modal('hide');
          $('#formAddMenu')[0].reset();
          loadMenus();
        } else {
          alert('Gagal menambah menu: ' + response.error);
        }
      },
      error: function () {
        alert('Terjadi kesalahan saat mengirim data.');
      }
    });
  });

  // Hapus menu
  window.deleteMenu = function (idMenu) {
    if (confirm('Apakah Anda yakin ingin menghapus menu ini?')) {
      $.ajax({
        url: '../controllers/crud_menu.php',
        method: 'POST',
        data: { id_menu: idMenu, _method: 'DELETE' },
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            alert('Menu berhasil dihapus!');
            loadMenus();
          } else {
            alert('Gagal menghapus menu: ' + response.error);
          }
        },
        error: function () {
          alert('Terjadi kesalahan saat menghapus menu.');
        }
      });
    }
  };
});
</script>


    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
              <?php if ($_SESSION['role'] === 'Admin') : ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddTable">
                    <i class="bx bx-plus me-1"></i> Add
                  </button>
                </div>
              <?php endif; ?>

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
                    <h5 class="modal-title">Detail Meja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="editTableId" name="id_meja"/>
                    
                    <div class="mb-3">
                      <label class="form-label">Nama Pelanggan</label>
                      <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Jenis Kelamin</label>
                      <select class="form-control" name="jenis_kelamin" required>
                        <option value="">Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">No HP</label>
                      <input type="text" class="form-control" name="nohp"/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Alamat</label>
                      <textarea class="form-control" name="alamat" rows="2"></textarea>
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
           
           <!-- Modal Order -->
          <div class="modal fade" id="modalAddPesanan" tabindex="-1" aria-labelledby="modalAddPesananLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <form id="modalOrder" method="POST">
                  <input type="hidden" name="id_meja" id="id_meja_input">
                  <input type="hidden" name="id_pelanggan" id="id_pelanggan_input">
                  <input type="hidden" name="id_user" value="<?= @$_SESSION['id_user'] ?>">
                  <div class="modal-body">
                    <div id="menu-wrapper">
                      <div class="menu-group mb-3">
                        <label class="form-label">Menu</label>
                        <select class="form-select menu_pesanan" name="menu_pesanan[]" required></select>
                        <label class="form-label mt-2">Jumlah</label>
                        <input type="number" class="form-control jumlah" name="jumlah[]" required>
                        <label class="form-label mt-2">Catatan</label>
                        <input type="text" class="form-control" name="catatan[]">
                      </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-menu-btn">
                      + Tambah Menu
                    </button>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Modal Riwayat Pesanan -->
          <div class="modal fade" id="modalRiwayatPesanan" tabindex="-1" aria-labelledby="modalRiwayatLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Riwayat Pesanan Meja <span id="riwayatNomorMeja"></span></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Catatan</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody id="riwayatBody">
                      <tr><td colspan="5" class="text-center">Memuat...</td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
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
document.addEventListener('DOMContentLoaded', async () => {
  // === FETCH MENU ===
  const menuWrapper = document.getElementById('menu-wrapper');
  const addMenuBtn = document.getElementById('add-menu-btn');

  // Fetch the menu data from the backend
  const res = await fetch('../controllers/crud_pesanan.php');
  const data = await res.json();

  function createMenuGroup() {
    const div = document.createElement('div');
    div.classList.add('menu-group', 'mb-3', 'p-3', 'border', 'rounded', 'bg-light-subtle', 'position-relative');

    const btnDelete = document.createElement('button');
    btnDelete.type = 'button';
    btnDelete.classList.add('btn', 'btn-sm', 'btn-outline-danger', 'position-absolute');
    btnDelete.style.top = '10px';
    btnDelete.style.right = '10px';
    btnDelete.innerHTML = '<i class="bx bx-x"></i>';
    btnDelete.addEventListener('click', () => div.remove());

    const labelMenu = document.createElement('label');
    labelMenu.classList.add('form-label');
    labelMenu.textContent = 'Menu';

    const select = document.createElement('select');
    select.classList.add('form-select', 'menu_pesanan');
    select.name = 'menu_pesanan[]';
    select.required = true;

    // Populate menu select options with categories and menus
    for (const kategori in data) {
      const optgroup = document.createElement('optgroup');
      optgroup.label = kategori;
      data[kategori].forEach(menu => {
        const option = document.createElement('option');
        option.value = menu.id;
        option.textContent = menu.nama;
        optgroup.appendChild(option);
      });
      select.appendChild(optgroup);
    }

    const labelJumlah = document.createElement('label');
    labelJumlah.classList.add('form-label', 'mt-2');
    labelJumlah.textContent = 'Jumlah';
    const inputJumlah = document.createElement('input');
    inputJumlah.type = 'number';
    inputJumlah.name = 'jumlah[]';
    inputJumlah.classList.add('form-control', 'jumlah');
    inputJumlah.required = true;

    const labelCatatan = document.createElement('label');
    labelCatatan.classList.add('form-label', 'mt-2');
    labelCatatan.textContent = 'Catatan';
    const inputCatatan = document.createElement('input');
    inputCatatan.type = 'text';
    inputCatatan.name = 'catatan[]';
    inputCatatan.classList.add('form-control');

    div.appendChild(btnDelete);
    div.appendChild(labelMenu);
    div.appendChild(select);
    div.appendChild(labelJumlah);
    div.appendChild(inputJumlah);
    div.appendChild(labelCatatan);
    div.appendChild(inputCatatan);

    menuWrapper.appendChild(div);
  }

  // Initialize with the first menu group
  menuWrapper.innerHTML = '';

  // Add new menu group on click of the button
  addMenuBtn.addEventListener('click', () => createMenuGroup());

  // === TANGKAP KLIK CARD UNTUK PESANAN ===
  // TANGKAP KLIK TOMBOL ORDER
  document.querySelectorAll('.btn-order').forEach(btn => {
    btn.addEventListener('click', () => {
      const idMeja = btn.dataset.id;
      const nomorMeja = btn.dataset.meja;

      document.getElementById('id_meja_input').value = idMeja;
      document.getElementById('id_pelanggan_input').value = nomorMeja;

      // Bersihkan wrapper dan tambahkan form pesanan baru
      menuWrapper.innerHTML = '';
      createMenuGroup();

      orderModal.show();
    });
  });


  // === SUBMIT FORM PESANAN ===
  document.getElementById('modalOrder').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const fd = new FormData(form);

    try {
      const res = await fetch('../controllers/crud_pesanan.php', {
        method: 'POST',
        body: fd
      });

      // Debugging: log response for JSON format
      const text = await res.text(); // Get response as text
      console.log(text); // Check what is received

      if (!res.ok) {
        throw new Error(`HTTP error! Status: ${res.status}`);
      }

      const data = JSON.parse(text); // Manually parse if needed

      if (data.success) {
        alert('Pesanan berhasil disimpan!');
        location.reload();
      } else {
        alert('Gagal menyimpan pesanan: ' + data.message);
      }
    } catch (err) {
      alert('Terjadi kesalahan saat menyimpan pesanan: ' + err.message);
      console.error('Error details:', err);  // Log error details
    }
  });

    document.querySelectorAll('.btn-riwayat').forEach(btn => {
      btn.addEventListener('click', function() {
        const idMeja = this.dataset.id;
        const nomorMeja = this.dataset.meja;
        const tbody = document.getElementById('riwayatBody');
        const modalTitle = document.getElementById('riwayatNomorMeja');

        fetch(`controllers/crud_pesanan.php?id_meja=${idMeja}`)
        .then(res => res.json())
        .then(data => {
          const wrapper = document.getElementById('riwayat-wrapper');
          wrapper.innerHTML = '';

          if (data.length === 0) {
            wrapper.innerHTML = '<p class="text-muted">Belum ada riwayat pesanan.</p>';
          } else {
            data.forEach(item => {
              wrapper.innerHTML += `
                <div class="border p-2 mb-2 rounded bg-white">
                  <strong>${item.nama_menu}</strong> x ${item.jumlah} @Rp${item.harga}<br/>
                  <small>Catatan: ${item.catatan}</small><br/>
                  <strong>Subtotal: Rp${item.subtotal}</strong>
                </div>
              `;
            });
          }
        });

        modalTitle.textContent = nomorMeja;
        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Memuat...</td></tr>';

        fetch(`../controllers/crud_pesanan.php?id_meja=${idMeja}`)
          .then(res => res.json())
          .then(data => {
            if (!data.success || !data.riwayat || data.riwayat.length === 0) {
              tbody.innerHTML = '<tr><td colspan="5" class="text-center">Tidak ada pesanan</td></tr>';
              return;
            }

            tbody.innerHTML = '';
            data.riwayat.forEach(item => {
              tbody.innerHTML += `
                <tr>
                  <td>${item.nama_menu}</td>
                  <td>Rp ${parseInt(item.harga).toLocaleString()}</td>
                  <td>${item.jumlah}</td>
                  <td>${item.catatan || '-'}</td>
                  <td>Rp ${parseInt(item.subtotal).toLocaleString()}</td>
                </tr>
              `;
            });
          });
        
        const modal = new bootstrap.Modal(document.getElementById('modalRiwayatPesanan'));
        modal.show();
      });
    });

  // === MODAL EDIT MEJA ===
  const editModalEl = document.getElementById('modalEditTable');
  const editModal = new bootstrap.Modal(editModalEl);

  document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('.card');
      const id_meja = card.getAttribute('data-id');
      const txt = card.querySelector('.card-text').textContent;
      const isOcc = txt.includes('Terisi');
      document.getElementById('editTableId').value = id_meja;
      document.getElementById('nama_pelanggan').value = isOcc
        ? txt.match(/\((.+)\)/)?.[1] || ''
        : '';
      document.getElementById('editStatus').checked = isOcc;
      editModal.show();
    });
  });

  document.getElementById('formEditTable').addEventListener('submit', async e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    fd.set('status', fd.get('status') === 'on' ? 'occupied' : 'available');

    const res = await fetch('../controllers/crud_meja.php', { method: 'POST', body: fd });
    const data = await res.json();

    if (data.success) {
      const card = document.querySelector(`.card[data-id="${data.id_meja}"]`);
      const statusEl = card.querySelector('.card-text');

      const newText = data.status === 'occupied'
        ? `Status: Terisi (${data.reserved_by})`
        : 'Status: Available';
      statusEl.textContent = newText;

      if (data.status === 'occupied') {
        card.classList.replace('border-start-success', 'border-start-danger');
      } else {
        card.classList.replace('border-start-danger', 'border-start-success');
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

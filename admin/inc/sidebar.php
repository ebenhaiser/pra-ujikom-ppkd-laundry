<?php
require_once 'controller/connection.php';
$idNavbarUser = $_SESSION['id'];
$queryNavbarUser = mysqli_query($connection, "SELECT * FROM user WHERE id = '$idNavbarUser'");
$rowNavbarUser = mysqli_fetch_assoc($queryNavbarUser);
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo gap-2">
    <img src="img/logo/logo.png" alt="" width="30px"><br><br>
    <span class="demo text-body fw-bolder" style="font-size: 25px;">Laundry Faith</span>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item <?= !isset($_GET['pg']) || $_GET['pg'] == 'dashboard' ? 'active' : '' ?>">
      <a href="index.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    <?php if ($rowNavbarUser['id_level'] == 1) : ?>
      <!-- ADMIN APLIKASI -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Admin aplikasi</span>
      </li>
      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'data-pendaftaran-pelatihan' || $_GET['pg'] == 'add-data-pendaftaran-pelatihan')) ? 'active' : '' ?>">
        <a href="?pg=data-pendaftaran-pelatihan" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks"
            viewBox="0 0 16 16">
            <path
              d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
          </svg>
          <div data-i18n="Analytics">Daftar Pendaftaran Pelatihan</div>
        </a>
      </li>
      <!-- END ADMIN APLIKASI -->

    <?php elseif ($rowNavbarUser['id_level'] == 2) : ?>
      <!-- PIC Jurusan -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">PIC Jurusan</span>
      </li>
      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'data-calon-peserta-pelatihan' || $_GET['pg'] == 'add-data-calon-peserta-pelatihan')) ? 'active' : '' ?>">
        <a href="?pg=data-calon-peserta-pelatihan" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill"
            viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
          </svg>
          <div data-i18n="Analytics">Calon Peserta Pelatihan</div>
        </a>
      </li>
      <!-- <li class="menu-item">
      <a href="?pg=informasi-jadwal-tes" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Informasi Jadwal Tes</div>
      </a>
    </li> -->
      <!-- END PIC Jurusan -->

    <?php elseif ($rowNavbarUser['id_level'] == 3) : ?>
      <!-- Administrator -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Master Data</span>
      </li>
      <li class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'data-user' || $_GET['pg'] == 'add-data-user')) ? 'active' : '' ?>
">
        <a href="?pg=data-user" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person"
            viewBox="0 0 16 16">
            <path
              d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
            <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
          </svg>
          <div data-i18n="Account">Data User</div>
        </a>
      </li>
      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'data-level' || $_GET['pg'] == 'add-data-level')) ? 'active' : '' ?>">
        <a href="?pg=data-level" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-postage" viewBox="0 0 16 16">
            <path d="M4.75 3a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h6.5a.75.75 0 0 0 .75-.75v-8.5a.75.75 0 0 0-.75-.75zM11 12H5V4h6z" />
            <path d="M3.5 1a1 1 0 0 0 1-1h1a1 1 0 0 0 2 0h1a1 1 0 0 0 2 0h1a1 1 0 1 0 2 0H15v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1h-1.5a1 1 0 1 0-2 0h-1a1 1 0 1 0-2 0h-1a1 1 0 1 0-2 0h-1a1 1 0 1 0-2 0H1v-1a1 1 0 1 0 0-2v-1a1 1 0 1 0 0-2V9a1 1 0 1 0 0-2V6a1 1 0 0 0 0-2V3a1 1 0 0 0 0-2V0h1.5a1 1 0 0 0 1 1M3 3v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1" />
          </svg>
          <div data-i18n="Connections">Data Level</div>
        </a>
      </li>
      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'data-customer' || $_GET['pg'] == 'add-data-customer')) ? 'active' : '' ?>">
        <a href="?pg=data-customer" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle"
            viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
            <path fill-rule="evenodd"
              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
          </svg>
          <div data-i18n="Account">Data Customer</div>
        </a>
      </li>
      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'data-service' || $_GET['pg'] == 'add-data-service')) ? 'active' : '' ?>">
        <a href="?pg=data-service" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
          </svg>
          <div data-i18n="Account">Data Service</div>
        </a>
      </li>
      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'data-order' || $_GET['pg'] == 'add-data-order')) ? 'active' : '' ?>">
        <a href="?pg=data-order" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
          </svg>
          <div data-i18n="Account">Data Transaction</div>
        </a>
      </li>

      <!-- Recycle Bin -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Recycle Bin</span>
      </li>
      <li class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'recycle-bin-data-user' || $_GET['pg'] == 'restore-data-user')) ? 'active' : '' ?>
">
        <a href="?pg=recycle-bin-data-user" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person"
            viewBox="0 0 16 16">
            <path
              d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
            <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
          </svg>
          <div data-i18n="Account">Restore Data User</div>
        </a>
      </li>

      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'recycle-bin-data-level' || $_GET['pg'] == 'restore-data-level')) ? 'active' : '' ?>">
        <a href="?pg=recycle-bin-data-level" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-postage" viewBox="0 0 16 16">
            <path d="M4.75 3a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h6.5a.75.75 0 0 0 .75-.75v-8.5a.75.75 0 0 0-.75-.75zM11 12H5V4h6z" />
            <path d="M3.5 1a1 1 0 0 0 1-1h1a1 1 0 0 0 2 0h1a1 1 0 0 0 2 0h1a1 1 0 1 0 2 0H15v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1h-1.5a1 1 0 1 0-2 0h-1a1 1 0 1 0-2 0h-1a1 1 0 1 0-2 0h-1a1 1 0 1 0-2 0H1v-1a1 1 0 1 0 0-2v-1a1 1 0 1 0 0-2V9a1 1 0 1 0 0-2V6a1 1 0 0 0 0-2V3a1 1 0 0 0 0-2V0h1.5a1 1 0 0 0 1 1M3 3v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1" />
          </svg>
          <div data-i18n="Connections">Restore Data Level</div>
        </a>
      </li>

      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'recycle-bin-data-customer' || $_GET['pg'] == 'restore-data-customer')) ? 'active' : '' ?>">
        <a href="?pg=recycle-bin-data-customer" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle"
            viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
            <path fill-rule="evenodd"
              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
          </svg>
          <div data-i18n="Account">Restore Data Customer</div>
        </a>
      </li>
      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'recycle-bin-data-service' || $_GET['pg'] == 'restore-data-service')) ? 'active' : '' ?>">
        <a href="?pg=recycle-bin-data-service" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
          </svg>
          <div data-i18n="Account">Restore Data Service</div>
        </a>
      </li>
      <li
        class="menu-item <?= (isset($_GET['pg']) && ($_GET['pg'] == 'recycle-bin-data-order' || $_GET['pg'] == 'restore-data-order')) ? 'active' : '' ?>">
        <a href="?pg=recycle-bin-data-order" class="menu-link gap-3">
          <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
          </svg>
          <div data-i18n="Account">Restore Data Transaction</div>
        </a>
      </li>


      <!-- END Administrator -->
    <?php endif ?>



    </a>
    </li>
  </ul>
</aside>
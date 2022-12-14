<nav>
  <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item">
      <a href="<?= base_url('admin/home') ?>" class="nav-link">
        <i class="fas fa-tachometer-alt fa-fw nav-icon"></i>
        <p>Dasboard</p>
      </a>
    </li>

 

    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-globe-asia fa-fw"></i>
        <p>
          Modul Web
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">

        <li class="nav-item">
          <a href="<?= base_url('admin/website') ?>" class="nav-link">
            <i class="far fa-circle nav-icon text-sm"></i>
            <p>Identitas</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('admin/menu') ?>" class="nav-link">
            <i class="far fa-circle nav-icon text-sm"></i>
            <p>Menu</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('admin/halaman') ?>" class="nav-link">
            <i class="far fa-circle nav-icon text-sm"></i>
            <p>Halaman</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('admin/logo') ?>" class="nav-link">
            <i class="far fa-circle nav-icon text-sm"></i>
            <p>Logo</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users fa-fw"></i>
        <p>
          Modul Pengguna
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">

        <li class="nav-item">
          <a href="<?= base_url('admin/users') ?>" class="nav-link">
            <i class="far fa-circle nav-icon text-sm"></i>
            <p>Manajemen Pengguna</p>
          </a>
        </li>

      </ul>
    </li>


    <li class="nav-item mt-2">
      <a href="<?= base_url('admin/edit_user/') . $this->session->username ?>" class="nav-link">
        <i class="nav-icon fas fa-user fa-fw"></i>
        <p>
          Ubah Profil
        </p>
      </a>
    </li>

    <li class="nav-item mt-1">
      <a href="javascript:void(0)" class="nav-link" onclick="logout()">
        <i class="nav-icon fas fa-sign-out-alt fa-fw"></i>
        <p>
          Keluar
        </p>
      </a>
    </li>

</nav>
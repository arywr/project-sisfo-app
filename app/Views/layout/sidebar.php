<?php if ($user['role_id'] == 1) { ?>
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/'); ?>">
      <div class="sidebar-brand-text mx-3 font-poppins">ADMINISTRATOR</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url(); ?>">
        <i class="fas fa-home"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('/Guru'); ?>">
        <i class="fas fa-fw fa-chalkboard-teacher"></i>
        <span>Data Guru</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('/Siswa'); ?>">
        <i class="fas fa-fw fa-user"></i>
        <span>Data Siswa</span></a>
    </li>

    <!-- <li class="nav-item">
      <a class="nav-link" href="/Guru/resetPassword">
        <i class="fas fa-fw fa-unlock-alt"></i>
        <span>Reset Password</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>
<?php } else { ?>
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/'); ?>">
      <div class="sidebar-brand-text mx-3 font-poppins">SISFO USER</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="/">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/Guru">
        <i class="fas fa-fw fa-chalkboard-teacher"></i>
        <span>Data Guru</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/Siswa">
        <i class="fas fa-fw fa-user"></i>
        <span>Data Siswa</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
<?php } ?>
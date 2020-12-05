<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between main-heading">
    <h1 class="h3 mb-0 text-gray-800 main-heading-title font-weight-500">Dashboard</h1>
  </div>
  <div id="today-date" class="mb-4 mt-2">
    <span id="sys-day" class="text-primary font-weight-600 mr-1"></span>
    <span class="mr-1 font-weight-bold">&middot;</span>
    <span id="sys-date"></span>
    <span class="mr-1 font-weight-bold">&middot;</span>
    <span id="sys-time"></span>
  </div>

  <div class="row">
    <div class="card-body welcome-card">
      <div class="row p-5 shadow">
        <div class="col welcome d-flex justify-content-center align-items-center">
          <div>
            <h3 class="welcome-title main-title text-primary mb-2 font-weight-bold">Selamat datang, <?= $nickname; ?></h3>
            <p class="welcome-description sub-title text-gray-800">di Website Pendataan Data Guru & Siswa SDN
              Jintel II</p>
            <div class="home-btn d-block">
              <ul class="mx-0 my-0 px-0 py-0">
                <a href="<?= base_url('/Siswa'); ?>" class="btn btn-sm btn-primary shadow">Data Siswa</a>
                <a href="<?= base_url('/Guru'); ?>" class="btn btn-sm btn-outline-primary shadow ml-0 ml-md-2">Data Guru</a>
              </ul>
            </div>
          </div>
        </div>
        <div class="col d-none d-lg-flex welcome-img justify-content-center align-items-center">
          <img class="img-fluid px-xl-4 mt-xxl-n5 mx-auto d-block" src="img/undraw_Taking_notes_re_bnaf.svg" alt="">
        </div>
      </div>
    </div>
  </div>
  <!-- Content Row -->
  <div class="row">
    <?php if ($user['role_id'] != 1) { ?>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-6 col-md-12 mb-4">
        <div class="card-list card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Guru</div>
                <div class="h5 mb-0 font-weight-700 text-gray-800"><?= $countGuru; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-6 col-md-12 mb-4">
        <div class="card-list card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Siswa</div>
                <div class="h5 mb-0 font-weight-700 text-gray-800"><?= $countSiswa; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="col-xl-4 col-md-12 mb-4">
        <div class="card-list card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Guru</div>
                <div class="h5 mb-0 font-weight-700 text-gray-800"><?= $countGuru; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-12 mb-4">
        <div class="card-list card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Siswa</div>
                <div class="h5 mb-0 font-weight-700 text-gray-800"><?= $countSiswa; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-12 mb-4">
        <div class="card-list card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jumlah User</div>
                <div class="h5 mb-0 font-weight-700 text-gray-800"><?= $countUser; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- Content Row -->
</div>
<?= $this->endSection(); ?>
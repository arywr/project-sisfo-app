<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex justify-content-between main-heading mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 main-heading-title font-weight-500">Profil Saya</h1>
            <div id="breadcrumbs" class="mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb px-0 py-1 bg-none">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row" style="margin-left:0;margin-right:0;">
        <?php if (session()->getFlashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="card shadow w-100 mb-4 px-3 py-3">
            <div class="card-header bg-none border-0 d-flex justify-content-between">

                <h1 class="h4 text-gray-800 main-heading-title font-weight-500">Informasi Terkait</h1>
                <div class="detail-icon">
                    <ul class="mx-0 my-0 py-0 px-0">
                        <a href="<?= base_url('/Guru/edit'); ?>/<?= $user['slug_nama']; ?>" class="btn btn-outline-secondary border-0"><i class="far fa-fw fa-edit"></i></a>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="img-wrapper p-5">
                            <img src="
                            <?= ($user['jenis_kelamin'] == 'Perempuan') ? '/img/avatar/woman.svg' : '/img/avatar/men.svg' ?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-borderless" width="100%">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: <?= $user['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>NISN</td>
                                        <td>: <?= $user['nip']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>TTL</td>
                                        <td>: <?= $user['tempat_lahir'] . ', ' . $user['tanggal_lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>: <?= $user['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td>: <?= $user['agama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: <?= $user['alamat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon</td>
                                        <td>: <?= $user['no_telp']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Ganti Password
                                        </td>
                                        <td class="d-flex align-items-center"><span>: </span>
                                            <form action="<?= base_url('/Guru/changePassword'); ?>/<?= session('user_id'); ?>" class="form-inline" method="post">
                                                <div class="form-group mr-sm-3 ml-sm-1 mb-2">
                                                    <label for="gantipassword" class="sr-only">Masukkan Password</label>
                                                    <input type="password" class="form-control" id="gantipassword" placeholder="Ganti Password" name="gantipassword">
                                                </div>
                                                <button type="submit" onclick="return confirm('Apakah anda yakin ingin mengganti password untuk akun anda?')" class="btn btn-primary mb-2">Submit Password</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>
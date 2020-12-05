<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex justify-content-between main-heading mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 main-heading-title font-weight-500">Detail Guru</h1>
            <div id="breadcrumbs" class="mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb px-0 py-1 bg-none">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('/Siswa'); ?>">Data Guru</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Guru</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row" style="margin-left:0;margin-right:0;">
        <div class="card shadow w-100 mb-4 px-3 py-3">
            <div class="card-header bg-none border-0 d-flex justify-content-between">
                <h1 class="h4 text-gray-800 main-heading-title font-weight-500">Informasi Terkait</h1>
                <?php if ($user['role_id'] == 1) { ?>
                    <div class="detail-icon">
                        <ul class="mx-0 my-0 py-0 px-0">
                            <form action="<?= base_url('/Guru'); ?>/<?= $guru['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-outline-secondary border-0" onclick="return confirm('Apakah anda yakin ingin menghapus Data Guru : <?= $guru['nama']; ?> ?')"><i class="fas fa-fw fa-trash-alt"></i></button>
                            </form>
                            <a href="<?= base_url('/Guru/edit'); ?>/<?= $guru['slug_nama']; ?>" class="btn btn-outline-secondary border-0"><i class="far fa-fw fa-edit"></i></a>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-borderless" width="100%">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: <?= $guru['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>: <?= $guru['nip']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>TTL</td>
                                        <td>: <?= $guru['tempat_lahir'] . ', ' . $guru['tanggal_lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>: <?= $guru['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td>: <?= $guru['agama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: <?= $guru['alamat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon</td>
                                        <td>: <?= $guru['no_telp']; ?></td>
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
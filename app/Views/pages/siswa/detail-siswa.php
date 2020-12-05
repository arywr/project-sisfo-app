<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex justify-content-between main-heading mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 main-heading-title font-weight-500">Detail Siswa</h1>
            <div id="breadcrumbs" class="mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb px-0 py-1 bg-none">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('/Siswa'); ?>">Data Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Siswa</li>
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
                <div class="detail-icon">
                    <ul class="mx-0 my-0 py-0 px-0">
                        <form action="<?= base_url('/Siswa'); ?>/<?= $siswa['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-outline-secondary border-0" onclick="return confirm('Apakah anda yakin ingin menghapus Data Siswa : <?= $siswa['nama']; ?> ?')"><i class="fas fa-fw fa-trash-alt"></i></button>
                        </form>
                        <a href="<?= base_url('/Siswa/edit'); ?>/<?= $siswa['slug_nama']; ?>" class="btn btn-outline-secondary border-0"><i class="far fa-fw fa-edit"></i></a>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-borderless" width="100%">
                                <tbody>
                                    <tr>
                                        <td>Nama:</td>
                                        <td><?= $siswa['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>NISN:</td>
                                        <td><?= $siswa['nisn']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>TTL:</td>
                                        <td><?= $siswa['tempat_lahir'] . ', ' . $siswa['tanggal_lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin:</td>
                                        <td><?= $siswa['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Agama:</td>
                                        <td><?= $siswa['agama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat:</td>
                                        <td><?= $siswa['alamat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon</td>
                                        <td><?= $siswa['no_telp']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Orang Tua Asuh:</td>
                                        <td><?= $siswa['orang_tua_asuh']; ?></td>
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
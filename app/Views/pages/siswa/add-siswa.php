<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex justify-content-between main-heading mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 main-heading-title font-weight-500">Form Tambah Data Siswa</h1>
            <div id="breadcrumbs" class="mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb px-0 py-1 bg-none">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('/Siswa'); ?>">Data Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row" style="margin-left:0;margin-right:0;">
        <div class="card shadow w-100 mb-4 px-md-3 py-md-3">
            <div class="card-body">
                <div class="w-100">
                    <form action="<?= base_url('/Siswa/SaveSiswa'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?>" id="nisn" name="nisn" value="<?= old('nisn'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nisn'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ttl" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control <?= ($validation->hasError('tempat')) ? 'is-invalid' : ''; ?>" id="ttl" name="tempat" placeholder="Tempat" value="<?= old('tempat'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tempat'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="ttl" name="tanggal" placeholder="Tgl" value="<?= old('tanggal'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                        <div class="col-sm-10">
                            <div class="form-inline">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="Laki-Laki" <?= (old('gender') == 'Laki-Laki') ? 'checked="checked"' : '' ?>>
                                    <label class="form-check-label" for="gridRadios1">
                                        Laki-Laki
                                    </label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="Perempuan" <?= (old('gender') == 'Perempuan') ? 'checked="checked"' : '' ?>>
                                    <label class="form-check-label" for="gridRadios2">
                                        Perempuan
                                    </label>
                                </div>
                                <div class="<?= ($validation->hasError('gender')) ? 'is-invalid' : ''; ?>"></div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('gender'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-3">
                        <select class="custom-select" id="agama" name="agama">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindhu">Hindhu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" rows="3" name="alamat"><?= old('alamat'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="notelp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('notelp')) ? 'is-invalid' : ''; ?>" id="notelp" name="notelp" value="<?= old('notelp'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('notelp'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="orangtua" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('orangtua')) ? 'is-invalid' : ''; ?>" id="orangtua" name="orangtua" value="<?= old('orangtua'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('orangtua'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="btn-submit col text-right">
                        <ul>
                            <a href="<?= base_url('/Siswa'); ?>" class="btn btn-md btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-md btn-primary">Tambah Data</button>
                        </ul>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Content Row -->
</div>
<?= $this->endSection(); ?>
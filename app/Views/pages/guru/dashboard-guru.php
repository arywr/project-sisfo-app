<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex justify-content-between main-heading mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 main-heading-title font-weight-500">Data Guru</h1>
            <div id="breadcrumbs" class="mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb px-0 py-1 bg-none">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="">
            <a href="<?= base_url('/ExportExcel/ExportGuru'); ?>" class="btn btn-md btn-primary" id="btn-export1"><i class="fas fa-fw fa-download mr-2"></i>Export</a>
        </div>
    </div>
    <?php if (session()->getFlashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } else if (session()->getFlashdata('alert')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('alert'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } else if (session()->getFlashdata('pesan')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <!-- Content Row -->
    <div class="row" style="margin-left:0;margin-right:0;">
        <div class="card shadow w-100 w-100 mb-4 px-md-3 py-md-3">
            <div class="card-header bg-none border-0">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="heading-btn <?= ($user['role_id'] != 1) ? 'd-none' : '' ?>">
                            <a href="<?= base_url('/guru/addGuru'); ?>" class="btn btn-md btn-primary shadow" id="export-btn"><span class="mx-0"><i class="fas fa-fw fa-plus mr-2"></i></span class="font-weight-bold">Tambah Data</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="row justify-content-end">
                            <div class="col-6">
                                <form action="" method="post" class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary" type="submit" name="submit" id="button-addon1"><i class="fas fa-search"></i></button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" name="keyword">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="w-100 text-nowrap" style="overflow-x:auto;">
                    <table class="table table-bordered table-list w-100" id="tabelGuru" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-nowrap">
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>TTL</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <?php if ($user['role_id'] == 1) : ?>
                                    <th>Status Akun</th>
                                <?php endif; ?>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $status = true;
                            if (!empty($guru)) {
                                $count = 1 + ($postPerPage * ($currentPage - 1));
                                foreach ($guru as $data_guru) : ?>
                                    <tr>
                                        <td><?= $count; ?></td>
                                        <td><?= $data_guru['nama']; ?></td>
                                        <td><?= $data_guru['nip']; ?></td>
                                        <td><?= $data_guru['tempat_lahir'] . ', ' . $data_guru['tanggal_lahir']; ?></td>
                                        <td><?= $data_guru['jenis_kelamin']; ?></td>
                                        <td><?= $data_guru['agama']; ?></td>
                                        <td class="text-wrap" style="max-width:300px"><?= $data_guru['alamat']; ?></td>
                                        <td><?= $data_guru['no_telp']; ?></td>
                                        <?php
                                        if ($user['role_id'] == 1) {
                                            if ($data_guru['user_id'] != null) { ?>
                                                <td class="text-center"><span class="texth-green">Aktif</span></td>
                                            <?php } else { ?>
                                                <td class="text-center"><span class="texth-red">Non Aktif</span></td>
                                        <?php }
                                        } ?>
                                        <td>
                                            <?php if ($user['role_id'] == 1) { ?>
                                                <ul class="mx-0 my-0 py-0 px-0">
                                                    <form action="<?= base_url('/Guru'); ?>/<?= $data_guru['id']; ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-outline-secondary border-0" onclick="return confirm('Apakah anda yakin ingin menghapus Data Siswa : <?= $data_guru['nama']; ?> ?')"><i class="fas fa-fw fa-trash-alt"></i></button>
                                                    </form>
                                                    <a href="<?= base_url('/Guru'); ?>/<?= $data_guru['slug_nama']; ?>" class="btn btn-outline-secondary border-0"><i class="far fa-fw fa-user"></i></a>
                                                    <a href="<?= base_url('/Guru/edit'); ?>/<?= $data_guru['slug_nama']; ?>" class="btn btn-outline-secondary border-0"><i class="far fa-fw fa-edit"></i></a>
                                                    <a href="<?= base_url('/Guru/aktivasi'); ?>/<?= $data_guru['slug_nama']; ?>" class="btn btn-sm btn-success">Aktivasi User</i></a>
                                                </ul>
                                            <?php } else { ?>
                                                <a href="<?= base_url('/Guru'); ?>/<?= $data_guru['slug_nama']; ?>" class="btn btn-outline-secondary border-0"><i class="far fa-fw fa-user"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php $count++;
                                endforeach;
                            } else {
                                $status = false; ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4">Tidak Ada Data Ditemukan</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <?php if ($status) { ?>
                            <div class="results">Menampilkan <?= 1 + ($postPerPage * ($currentPage - 1)); ?> dari <?= $count - 1; ?> dari <?= $resultPage; ?> Data</div>
                        <?php } ?>
                    </div>
                    <div class="col-6">
                        <?= $pager->links('guru', 'siswa_pagination'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
</div>
<?= $this->endSection(); ?>
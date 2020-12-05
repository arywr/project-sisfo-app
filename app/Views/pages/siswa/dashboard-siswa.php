<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex justify-content-between main-heading mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 main-heading-title font-weight-500">Data Siswa</h1>
            <div id="breadcrumbs" class="mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb px-0 py-1 bg-none">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="">
            <a href="<?= base_url('/ExportExcel/ExportSiswa'); ?>" class="btn btn-md btn-primary" id="btn-export2"><i class="fas fa-fw fa-download mr-2"></i>Export</a>
        </div>
    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif;  ?>

    <!-- Content Row -->
    <div class="row" style="margin-left:0;margin-right:0;">
        <div class="card shadow w-100 mb-4 px-md-3 py-md-3">
            <div class="card-header bg-none border-0">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="heading-btn">
                            <a href="<?= base_url('/siswa/addSiswa'); ?>" class="btn btn-md btn-primary shadow"><span class="mx-0"><i class="fas fa-fw fa-plus mr-2"></i></span class="font-weight-bold">Tambah Data</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="row justify-content-end">
                            <div class="col-6">
                                <form action="" method="get">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary" type="submit" name="submit" id="button-addon1">Cari</button>
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
                <!-- <div id="result"></div> -->
                <div id="tabledata" class="w-100 text-nowrap" style="overflow-x:auto;">
                    <table class="table table-bordered table-list w-100" id="tabelSiswa" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-nowrap">
                                <th>#</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>TTL</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Nama Orang Tua</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $status = true;
                            $count = 1 + ($postPerPage * ($currentPage - 1));
                            if (!empty($siswa)) {
                                foreach ($siswa as $data_siswa) : ?>
                                    <tr>
                                        <td><?= $count; ?></td>
                                        <td><?= $data_siswa['nama']; ?></td>
                                        <td><?= $data_siswa['nisn']; ?></td>
                                        <td><?= $data_siswa['tempat_lahir'] . ', ' . $data_siswa['tanggal_lahir']; ?></td>
                                        <td><?= $data_siswa['jenis_kelamin']; ?></td>
                                        <td><?= $data_siswa['agama']; ?></td>
                                        <td class="text-wrap" style="min-width:250px;"><?= $data_siswa['alamat']; ?></td>
                                        <td><?= $data_siswa['no_telp']; ?></td>
                                        <td><?= $data_siswa['orang_tua_asuh']; ?></td>
                                        <td>
                                            <ul class="mx-0 my-0 py-0 px-0">
                                                <form action="<?= base_url('/Siswa'); ?>/<?= $data_siswa['id']; ?>" method="post" class="d-inline">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-outline-secondary border-0" onclick="return confirm('Apakah anda yakin ingin menghapus Data Guru : <?= $data_siswa['nama']; ?> ?')"><i class="fas fa-fw fa-trash-alt"></i></button>
                                                </form>
                                                <a href="<?= base_url('/Siswa'); ?>/<?= $data_siswa['slug_nama']; ?>" class="btn btn-outline-secondary border-0"><i class="far fa-fw fa-user"></i></a>
                                                <a href="<?= base_url('/Siswa/edit'); ?>/<?= $data_siswa['slug_nama']; ?>" class="btn btn-outline-secondary border-0"><i class="far fa-fw fa-edit"></i></a>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php $count++;
                                endforeach;
                            } else {
                                $status = false;
                                ?>
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
                        <?= $pager->links('siswa', 'siswa_pagination'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
</div>
<?= $this->endSection(); ?>
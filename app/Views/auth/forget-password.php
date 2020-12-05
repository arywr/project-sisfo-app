<?= $this->extend('layout/auth-templates'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-8 d-none d-lg-block mx-auto pt-5">
                            <img class="img-fluid px-xl-4 mt-xxl-n5 mx-auto d-block" src="/img/undraw_forgot_password_gi2d.svg" alt="">
                        </div>
                    </div>
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="p-5">
                                <?php if (session()->getFlashdata('gagal')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('gagal'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>
                                <form action="<?= base_url('/Auth/submitPassword'); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="exampleFormControlInput1" placeholder="Masukkan Email" name="email" id="email" value="<?= old('email'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email'); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Submit
                                    </button>
                                </form>
                                <div class="text-center mt-2">
                                    <a class="small" href="<?= base_url('/Auth'); ?>">Login?</a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 d-none d-lg-flex align-items-center">
                            <img class="img-fluid px-xl-4 mt-xxl-n5 mx-auto d-block" src="img/undraw_Login_re_4vu2.svg" alt="">
                        </div> -->
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?= $this->endSection(); ?>
<div class="container-pluid jumbotron">
    <div class="row">
        <div class="col-lg-7 d-lg-block d-none">
            <h1 class="display-4">SIPRO</h1>
            <h4 style="color:white;position:relative; z-index:1;">Membantu Anda Menemukan Rumah impian anda.</h4>
        </div>
        <div class="col-lg-5 col-md-12 col-xs-12 pl-5">
            <h1 class="display-4">REGISTRASI</h1>
            <?= $this->session->flashdata('error'); ?>
            <hr class="line">
            <form action="<?= base_url() ?>index.php/Act" method="post" class="form-login user">
                <div class="form-group">
                    <input type="text" name="nama" class="form-control form-control-user" placeholder="Masukan Username ">
                    <span class="text-danger"><?= form_error('username'); ?></span>
                </div>
                <div class="form-group">
                    <input type="Text" name="alamat" class="form-control form-control-user" placeholder="Masukan Alamat">
                    <span class="text-danger"><?= form_error('password'); ?></span>
                </div>
                <div class="form-group">
                    <input type="text" name="notel" class="form-control form-control-user" placeholder="Masukan Telepon">
                    <span class="text-danger"><?= form_error('password'); ?></span>
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control form-control-user" placeholder="Masukan Email">
                    <span class="text-danger"><?= form_error('password'); ?></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" name="Password-awal" class="form-control form-control-user" placeholder="Masukan Password">
                            <span class="text-danger"><?= form_error('password'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" name="Password-awal" class="form-control form-control-user" placeholder="Konfirmasi Password">
                            <span class="text-danger"><?= form_error('password'); ?></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
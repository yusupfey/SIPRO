<div class="container-pluid jumbotron mb-0">
    <div class="row">
        <div class="col-lg-7 d-lg-block d-none">
            <h1 style="font-family: 'Open Sans', sans-serif;" class="display-4">SIPRO</h1>
            <h4 style="color:white;position:relative; z-index:1;">Membantu Anda Menemukan Rumah impian anda.</h4>
        </div>
        <div class="col-lg-5 col-md-12 col-xs-12 pl-5">
            <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                <div class="card-body">
                    <h1 style="font-family: 'Open Sans', sans-serif;" class="display-4">REGISTRASI</h1>
                    <?= $this->session->flashdata('error'); ?>
                    <hr class="line">
                    <form action="<?= base_url() ?>Act/Actregis" method="post" class="form-login user">
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>" placeholder="Masukan Username " style="background-color: rgba(255, 255, 255, 0.5); border:none; color:black; font-weight: bold">
                            <span class="text-danger"><?= form_error('nama'); ?></span>
                        </div>
                        <!-- <div class="form-group">
                            <input type="Text" name="alamat" class="form-control" value="<?= set_value('alamat') ?>" placeholder="Masukan Alamat">
                            <span class="text-danger"><?= form_error('alamat'); ?></span>
                        </div> -->
                        <!-- <div class="form-group">
                            <input type="text" name="notel" class="form-control" placeholder="Masukan Telepon">
                            <span class="text-danger"><?= form_error('notel'); ?></span>
                        </div> -->
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" value="<?= set_value('email') ?>" placeholder="Masukan Email" style="background-color: rgba(255, 255, 255, 0.5); border:none; color:black; font-weight: bold">
                            <span class="text-danger"><?= form_error('email'); ?></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password-awal" value="<?= set_value('password-awal') ?>" class="form-control" placeholder="Masukan Password" style="background-color: rgba(255, 255, 255, 0.5); border:none; color:black; font-weight: bold">
                                    <span class="text-danger"><?= form_error('password-awal'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control" placeholder="Konfirmasi Password" style="background-color: rgba(255, 255, 255, 0.5); border:none; color:black; font-weight: bold">
                                    <span class="text-danger"><?= form_error('password'); ?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Daftar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
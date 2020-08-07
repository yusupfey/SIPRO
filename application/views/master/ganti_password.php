<?php if ($this->session->flashdata('false')) : ?>
    <script>
        swal({
            title: "Gagal!",
            text: "<?= $this->session->flashdata('false') ?>",
            icon: "<?= $this->session->flashdata('alert') ?>",
        });
    </script>
<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Ubah Password
                </div>
                <div class="card-body">
                    <form action="<?= base_url() ?>Act/actChangePassword" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="<?= $get['username']; ?>" class="form-control">
                            <span class="text-danger"><?= form_error('username'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password Lama</label>
                            <input type="text" name="passlama" value="<?= set_value('passlama') ?>" class="form-control" placeholder="Masukan..">
                            <span class="text-danger"><?= form_error('passlama'); ?></span>

                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="text" name="passbaru" value="<?= set_value('passbaru') ?>" class="form-control" placeholder="Masukan..">
                            <span class="text-danger"><?= form_error('passbaru'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Konfirmasi Password</label>
                            <input type="text" name="passconfirm" class="form-control" placeholder="Masukan..">
                            <span class="text-danger"><?= form_error('passconfirm'); ?></span>
                        </div>
                        <hr>
                        <div class="form_group text-right">
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
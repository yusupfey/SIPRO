<div class="container">
    <div class="card">
        <div class="card-header">Create User</div>
        <div class="card-body">
            <form action="<?= base_url() ?>pengguna/create" method="post">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('nama'); ?></div>

                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control"><?= set_value('alamat') ?></textarea>
                    <div class="text-danger"><?= form_error('alamat'); ?></div>
                </div>
                <div class="form-group">
                    <label for="telp">Telp</label>
                    <input type="text" name="telp" value="<?= set_value('telp') ?>" class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('telp'); ?></div>

                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" <?= set_value('email') ?> class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('email'); ?></div>

                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('username'); ?></div>

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" <?= set_value('password') ?> class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('password'); ?></div>

                </div>
                <div class="form-group">
                    <label for="email">Akses</label>
                    <select name="akses" class="form-control">
                        <option disabled selected>-- Akses</option>
                        <?php foreach ($akses as $p) : ?>
                            <option value="<?= $p->id_akses ?>"><?= $p->akses ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="text-danger"><?= form_error('akses'); ?></div>

                </div>
                <div class="form-group text-right">
                    <hr>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
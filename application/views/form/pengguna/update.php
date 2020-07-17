<div class="container">
    <div class="card">
        <div class="card-header">Update User</div>
        <div class="card-body">
            <form action="<?= base_url() ?>pengguna/update" method="post">
                <div class="form-group">
                    <input type="hidden" readonly name="id" value="<?= $get['id_user'] ?>" class="form-control" placeholder="Masukan..">

                    <label for="nama">Nama</label>
                    <input type="text" name="nama" value="<?= $get['nama'] ?>" class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('nama'); ?></div>

                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control"><?= $get['alamat'] ?></textarea>
                    <div class="text-danger"><?= form_error('alamat'); ?></div>
                </div>
                <div class="form-group">
                    <label for="telp">Telp</label>
                    <input type="text" name="telp" value="<?= $get['notel'] ?>" class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('telp'); ?></div>

                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?= $get['email'] ?>" class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('email'); ?></div>

                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?= $getlog['username'] ?>" class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('username'); ?></div>

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="" class="form-control" placeholder="Masukan..">
                    <div class="text-danger"><?= form_error('password'); ?></div>

                </div>
                <div class="form-group">
                    <label for="email">Akses</label>
                    <select name="akses" class="form-control">
                        <?php foreach ($akses as $p) : ?>
                            <option <?php if ($p->id_akses == $getlog['id_akses']) echo 'selected'; ?> value="<?= $p->id_akses ?>"><?= $p->akses ?></option>
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
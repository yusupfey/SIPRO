<div class="col-md-9 col-xs-12">
    <div class="box border-bottom-success bg-success cover">
    </div>
    <div class="row text-center">
        <div class="col-md-12 mt-5">
            <img src="<?= base_url() ?>assets/img/LOGOSIPRO.png" class="border-left-info img-profil" width="160" height="180" alt="">
        </div>
    </div>
    <!-- </div> -->
    <div class="box text-left pl-3 pr-3 pt-5 border-left-success" style="min-height:600px; margin-top:-70px; background-color:#f9f9f9; border-radius:5px">
        <?php if ($this->session->flashdata('true')) : ?>
            <script>
                swal({
                    title: "Berhasil!",
                    text: "Di Update!",
                    icon: "success",
                });
            </script>
        <?php endif; ?>
        <h2>Profil</h2>
        <hr>
        <form action="<?= base_url() ?>Act/Editprofil" method="post">
            <?php foreach ($user as $v) :
            ?>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="<?= $v->nama; ?>" class="form-control">
                    <i class="text-danger"><?= form_error('nama'); ?></i>
                </div>
                <div class="form-group">
                    <label>No Telphone</label>
                    <input type="text" name="notel" value="<?= $v->notel; ?>" class="form-control">
                    <i class="text-danger"><?= form_error('notel'); ?></i>

                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?= $v->email; ?>" class="form-control">
                    <i class="text-danger"><?= form_error('email'); ?></i>

                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control " name="alamat"><?= $v->alamat; ?></textarea>
                    <i class="text-danger"><?= form_error('alamat'); ?></i>

                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-success float-right">Edit Profil</button>
                </div>
            <?php endforeach;
            ?>
        </form>
    </div>
</div>
<!-- <div class="col-md-3">
            <div class=" card">
                <div class="card-header">Jual Rumah</div>
                <div class="card-body">

                </div>
            </div>
        </div> -->
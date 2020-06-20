<div class="border-bottom-success cover">
</div>
<div class="row text-center">
    <div class="col-md-12 mt-5">
        <img src="<?= base_url() ?>assets/profil/<?= $user['pic']; ?>" class=" img-profil" width="180" height="180" alt="">
    </div>
</div>
<!-- </div> -->
<div class="bg-white text-left pl-3 pr-3 pt-5 border-left-success" style="min-height:600px; margin-top:-70px; background-color:#f9f9f9; border-radius:5px">
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
    <form action="<?= base_url() ?>Act/Editprofil" enctype="multipart/form-data" method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $user['nama']; ?>" class="form-control">
            <i class="text-danger"><?= form_error('nama'); ?></i>
        </div>
        <div class="form-group">
            <label>No Telphone</label>
            <input type="text" name="notel" value="<?= $user['notel']; ?>" class="form-control">
            <i class="text-danger"><?= form_error('notel'); ?></i>

        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?= $user['email'];; ?>" class="form-control">
            <i class="text-danger"><?= form_error('email'); ?></i>

        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control " name="alamat"><?= $user['alamat']; ?></textarea>
            <i class="text-danger"><?= form_error('alamat'); ?></i>
        </div>
        <div class="form-group">
            <label>pic</label>
            <input type="hidden" name="img" value="<?= $user['pic']; ?>">
            <input type="file" name="gambar" class="form-control">
        </div>
        <hr>
        <div class="form-group">
            <button type="submit" class="btn btn-success float-right">Edit Profil</button>
        </div>
    </form>
</div>
<!-- <div class="col-md-3">
            <div class=" card">
                <div class="card-header">Jual Rumah</div>
                <div class="card-body">

                </div>
            </div>
        </div> -->
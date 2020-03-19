<div class="col-md-9 col-xs-12">
    <div class="box border-bottom-success bg-dark cover p-4 text-white">
        <p>- Keunggulan Dan Keuntungan Mengunakan Fitur Jual Perumahan
            <ol>
                <li>Mendapatkan Kkemudahan untuk membangun bisnis property</li>
                <li>Nama perumahaannya di tampilkan di landing page</li>
                <li>Dapat Membuat Cluster</li>
            </ol>
        </p>
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
        <h2>Form Request Perumahan</h2>
        <hr>
        <form action="<?= base_url() ?>Act/Editprofil" method="post">
            <div class="form-group">
                <label>Nama</label>
                <?= $nama; ?>
                <i class="text-danger"><?= form_error('nama'); ?></i>
            </div>
            <div class="form-group">
                <label>No Telphone</label>
                <i class="text-danger"><?= form_error('notel'); ?></i>

            </div>
            <div class="form-group">
                <label>Email</label>
                <i class="text-danger"><?= form_error('email'); ?></i>

            </div>
            <div class="form-group">
                <label>Alamat</label>
                <i class="text-danger"><?= form_error('alamat'); ?></i>

            </div>
            <hr>
            <div class="form-group">
                <button type="submit" class="btn btn-success float-right">Edit Profil</button>
            </div>
        </form>
    </div>
</div>
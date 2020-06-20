<form action="<?= base_url() ?>Dashboard/EditProfil" enctype="multipart/form-data" method="post">
    <div class="row bg-white p-3">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary py-3">
                    <h6 class="m-0 font-weight-bold text-white">Foto Profil
                    </h6>
                </div>
                <div class="card-body text-center">
                    <img src="<?= base_url() ?>assets/profil/<?= $user['pic'] ?>" style="height:400px" class="img-thumbnail" width="70%" alt=""><br>
                    <div class="mt-4">
                        <input type="hidden" name="img" value="<?= $user['pic'] ?>" class="form-control-file">
                        <input type="file" name="foto" class="form-control-file">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary py-3">
                    <h6 class="m-0 font-weight-bold text-white">Profil
                    </h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" value="<?= $user['nama']; ?>" class="form-control">
                        <i class="text-danger"><?= form_error('nama'); ?></i>
                    </div>
                    <div class="form-group">
                        <label>No wa : (format : 6285555336666)</label>
                        <input type="text" name="notel" value="<?= $user['notel']; ?>" placeholder="62xx" class="form-control">
                        <i class="text-danger"><?= form_error('notel'); ?></i>

                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="<?= $user['email']; ?>" class="form-control">
                        <i class="text-danger"><?= form_error('email'); ?></i>

                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control " name="alamat"><?= $user['alamat']; ?></textarea>
                        <i class="text-danger"><?= form_error('alamat'); ?></i>

                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">Edit Profil</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('button').click(function() {
            $('#kota').removeAttr('disabled')

        });
        $('#prov').click(function() {
            if ($(this).val()) {
                var form_data = new FormData();

                form_data.append('provinsi', $('#prov').val());
                $.ajax({
                    url: '<?= base_url() ?>Dashboard/Getdatabyajax/kota',
                    type: 'post',
                    data: form_data,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(berhasil) {
                        $('#kota').removeAttr('disabled')
                        //untuk mengkosongkan produk ketika kategori di kosongkan
                        $('#kota option[value!=""]').remove();
                        //menambahkan data sesuai dengan kategori kedalam dropdown
                        $('#kota').append(berhasil);
                        console.log(berhasil);
                    },
                    error: function(gagal) {
                        console.log(gagal);
                    }
                });
            }

        });
    });
</script>
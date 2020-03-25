<div class="row bg-white p-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">Foto Profil
                </h6>
            </div>
            <div class="card-body text-center">
                <img src="<?= base_url() ?>assets/img/<?= $user['pic'] ?>" style="height:400px" class="img-thumbnail" width="70%" alt=""><br>
                <form action="" method="post" class="mt-4">
                    <input type="file" name="foto" class="form-control-file">
                    <button class="btn btn-success float-right mt-2">Ganti foto profil</button>
                </form>
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
                <form action="<?= base_url() ?>Act/Editprofil" method="post">
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
                        <input type="text" name="email" value="<?= $user['email']; ?>" class="form-control">
                        <i class="text-danger"><?= form_error('email'); ?></i>

                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control " name="alamat"><?= $user['alamat']; ?></textarea>
                        <i class="text-danger"><?= form_error('alamat'); ?></i>

                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right">Edit Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
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
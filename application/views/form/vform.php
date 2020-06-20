<?= $form_open ?>
<div class="card">
    <div class="card-header text-white bg-primary">
        <?= $title ?>
    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12">

            <div class="card-body">
                <div class="form-group">
                    <?= $idperum; ?>
                </div>
                <div class="form-group">
                    <?= $id_user; ?>
                </div>
                <div class="form-group">
                    <?= @$id_perumahan; ?>
                </div>
                <div class="form-group">
                    <?= @$claster; ?>
                </div>
                <div class="form-group">
                    <?= $type; ?>
                    <span class="text-danger"><?= form_error('type') ?></span>
                </div>
                <div class="form-group">
                    <?= $ukrumah; ?>
                </div>
                <div class="form-group">
                    <?= $harga; ?>
                </div>
                <div class="form-group">
                    <?= $cicilan; ?>
                </div>
                <select name="provinsi" class="form-control" style="font-size:20px; font-family:'Courier New', Courier, monospace" id="prov">
                    <option value="">-- Pilih provinsi --</option>
                    <?php foreach ($apiProv as $t) : ?>
                        <option value="<?= $t['id']; ?>"><?= $t['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="form-group">
                    <label>Kota/Kab</label>

                    <select name="kota" class="form-control" style="font-size:20px; font-family:'Courier New', Courier, monospace" id="kota">
                        <option value="">-- Pilih Kota --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <?= $desk; ?>
                </div>
                <label>Alamat</label>
                <div class="form-group">
                    <?= $alamat; ?>
                </div>
                <div class="form-group">
                    <?= @$img; ?>
                </div>
                <div class="form-group">
                    <?= @$pic; ?>
                </div>
                <div class="form-group">
                    <hr>
                    <?= $btn; ?>
                </div>
            </div>
        </div>
    </div>

    <?= $form_close ?>
</div>

<script>
    $(document).ready(function() {
        $('#prov').on('click', function() {
            var form_data = new FormData();

            form_data.append('provinsi', $('#prov').val());
            $.ajax({
                url: '<?= base_url() ?>Home/Getdatabyajax/',
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
                    console.log('Api Berhasil diambil');
                },
                error: function(gagal) {
                    console.log(gagal);
                }
            });
        });
    });
</script>
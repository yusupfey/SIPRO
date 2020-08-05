<div class="row">
    <div class="col-md-8 col-sm-12">
        <?= $form_open ?>
        <div class="card">
            <div class="card-header text-white bg-primary">
                <?= $title ?>
            </div>
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
                <div class="form-group">
                    <label>Deskripsi</label>
                    <?= $desk; ?>
                </div>
                <label>Alamat</label>
                <div class="form-group">
                    <?= $alamat; ?>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header text-white bg-primary">
                <?= $title ?>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <?= @$img; ?>
                </div>
                <div class="form-group">
                    <?= @$pic; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <hr>
            <?= $btn; ?>
        </div>
    </div>
    <?= $form_close ?>

</div>
<script>
    $(document).ready(function() {
        $('.perumahan').on('click', function() {
            var form_data = new FormData();
            form_data.append('id_perumahan', $('.perumahan').val());
            $.ajax({
                url: '<?= base_url() ?>Dashboard/GetIdPerumahanByAjax/',
                type: 'post',
                data: form_data,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                success: function(berhasil) {
                    $('.claster').removeAttr('disabled')
                    //untuk mengkosongkan produk ketika kategori di kosongkan
                    $('.claster option[value!=""]').remove();
                    //menambahkan data sesuai dengan kategori kedalam dropdown
                    $('.claster').append(berhasil);
                    console.log(berhasil);
                },
                error: function(gagal) {
                    console.log(gagal);
                }
            });
            $.ajax({
                url: '<?= base_url() ?>Dashboard/GetIdUserByAjax/',
                type: 'post',
                data: form_data,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                success: function(berhasil) {
                    // $('.claster').removeAttr('disabled')
                    //untuk mengkosongkan produk ketika kategori di kosongkan
                    // $('.claster option[value!=""]').remove();
                    //menambahkan data sesuai dengan kategori kedalam dropdown
                    $('.iduser').val(berhasil);
                    console.log(berhasil);
                },
                error: function(gagal) {
                    console.log(gagal);
                }
            });
            // console.log('haloo');
        });
    });
</script>
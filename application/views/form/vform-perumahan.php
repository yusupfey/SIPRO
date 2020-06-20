<div class="row bg-white p-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">Profil Perumahan
                </h6>
            </div>

            <div class="card-body">
                <?php if ($properum['nm_perumahan'] == null) : ?>
                    <span class="text-danger font-weight-bold mb-3"><i> **lengkapi data terlebih dahulu !!</i></span>
                    <hr>
                <?php endif; ?>
                <form action="<?= base_url() ?>Dashboard/Actupdateperumahan" method="post">
                    <div class="form-group">
                        <label>ID Perumahan</label>
                        <input type="text" name="id" readonly value="<?= $properum['id_perumahan']; ?>" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label>Nama Perumahan</label>
                        <input type="text" name="nama" value="<?= $properum['nm_perumahan']; ?>" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>

                        <select name="provinsi" class="form-control" id="prov">
                            <option <?php if ($properum['id_prov'] == 0) : echo 'selected';
                                    endif ?>>-- Pilih provinsi --</option>

                            <?php foreach ($prov as $t) : ?>
                                <option value="<?= $t->id_prov; ?>" <?php if ($t->id_prov  == $properum['id_prov']) : echo 'selected';
                                                                    endif ?>><?= $t->provinsi ?>
                                </option>


                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label>Kota/Kab</label>

                        <select name="kota" class="form-control" disabled id="kota">
                            <option <?php if ($properum['id_kota'] == 0) : echo 'selected';
                                    endif ?>>-- Pilih kota --</option>

                            <?php foreach ($kota as $k) : ?>
                                <option value="<?= $k->id_kota; ?>" <?php if ($k->id_kota  == $properum['id_kota']) : echo 'selected';
                                                                    endif ?>><?= $k->kota ?>
                                </option>


                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" id="" cols="30" rows="10"><?= $properum['alamat_lengkap']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Link Lokasi</label>
                        <br>
                        <a href="https://www.google.co.id/maps/place" target="_blank" class="badge badge-pill" rel="noopener noreferrer">Salin Lokasi Via Google maps</a>
                        <input type="text" name="tikor" value="<?= $properum['titik_coridinat']; ?>" class="form-control" id="" placeholder="link lokasi c/o : https://goo.gl/maps/fUZ5ypTnZCHskhmd7">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">Foto
                </h6>
            </div>
            <div class="card-body">
                <img src="<?= base_url() ?>assets/img-perumahan/<?= $properum['pic'] ?>" class="img-thumbnail" style="height:400px" width="100%" alt=""><br>
                <form action="<?= base_url(); ?>Dashboard/ActUploadPerum/<?= $properum['id_perumahan'] ?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="foto" class="form-control-file">
                    <button type="submit" class="btn btn-success float-right mt-2">Ganti foto</button>
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
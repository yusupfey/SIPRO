<!-- <div class="bg-white"> -->
<div class="container-pluid jumbotron">
    <h1 class="display-4">GOOD MORNING</h1>
    <form action="" class="form-src">
        <div class="row text-center">
            <div class="col-sm-12 p-5 d-md-block d-none">
                <center>
                    <p class="line"></p>
                </center>
                <h1>SIPRO</h1>
                <h4>Membantu Anda Menemukan Rumah Impian Anda.</h4>
            </div>
        </div>
    </form>
</div>

<div class="container bg-white">
    <div class="row justify-content-center cari-panel">
        <div class="col-lg-10">
            <form action="<?= base_url() ?>Act/search" method="post">
                <div class="row">
                    <div class=" col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-warning" id="inputGroup-sizing-md"><i class="fa fa-fw fa-map "></i></span>
                            <select name="provinsi" class="form-control" style="font-size:20px; font-family:'Courier New', Courier, monospace" id="prov">
                                <option value="">-- Pilih provinsi --</option>
                                <?php foreach ($prov as $t) : ?>
                                    <option value="<?= $t->id_prov ?>" <?php if (set_value('provinsi') == $t->id_prov) {
                                                                            echo 'selected';
                                                                        }; ?>><?= $t->provinsi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <span class="text-danger"><?= form_error('provinsi'); ?></span>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-warning" id="inputGroup-sizing-md"><i class="fa fa-fw fa-map-pin"></i></span>
                            <select name="kota" class="form-control" style="font-size:20px; font-family:'Courier New', Courier, monospace" id="kota">
                                <option value="">-- Pilih Kota --</option>
                            </select>
                        </div>
                        <span class="text-danger"><?= form_error('kota'); ?></span>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <h4>Busines Partner</h4>

    <div class="row text-center">
        <div class="col-md-12">
            <div class="main">
                <div class="slider slider-for">
                    <?php foreach ($bispat as $t) : ?>
                        <div class="bg-primary p-1 text-white">
                            <img class="thumbnail" src="<?= base_url() ?>assets/img-perumahan/<?= $t->pic ?>" width="100%" height="240" alt=" Card image cap">
                        </div>
                    <?php endforeach; ?>
                </div>
                <br>
                <div class="slider slider-nav">

                    <?php foreach ($bispat as $t) : ?>
                        <div>
                            <h3><?= $t->nm_perumahan ?></h3>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <h4>Paket Pemasaran</h4>
    <hr>
    <div class="box border-bottom-success pb-5"">
        <div class=" card">
        <div class="card-header bg-primary text-gray-100">
            Paket Pemasaran
        </div>
        <div class="card-body text-center">
            <div class="p-2 bg-gray-200">
                <h2>RP. 300.000</h2>
                <spa6>3 bulan</span>
            </div>
            <div class="p-2 bg-gray-100">
                <h2>RP. 700.000</h2>
                <span class="">7 bulan</span>
            </div>
            <div class="p-2 bg-gray-200">
                <h2>RP. 1.000.000</h2>
                <span class="">1 Tahun</span>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#prov').on('click', function() {
            if ($(this).val()) {
                var form_data = new FormData();

                form_data.append('provinsi', $('#prov').val());
                $.ajax({
                    url: '<?= base_url() ?>Home/Getdatabyajax/kota',
                    type: 'post',
                    data: form_data,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(berhasil) {
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
<!-- <div class="bg-white"> -->
<!-- Page Wrapper -->


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<?php if ($this->session->userdata('id_akses') == 1) {
?>
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <h6>Hallo,</h6>
                    </div>
                    <h2 class="font-weight-bold"><?= $this->session->userdata('username') ?></h2>
                </div>
            </div>

        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Perumahan</div>
                            <div class="h1 mb-3 font-weight-bold text-gray-800"><?= $countperum['jml'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hotel fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Rumah</div>
                            <div class="h1 mb-3 font-weight-bold text-gray-800"><?= $countrumah['jml'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Bookingan</div>
                            <div class="h1 mb-3 font-weight-bold text-gray-800"><?= $countbooking['jml'] ?></div>

                            <!-- <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 1%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">cluster</div>
                            <div class="h1 mb-3 font-weight-bold text-gray-800"><?= $countrumah['jml'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-archway fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row bg-white p-3">
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User</h6>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <h6>Hallo,</h6>
                    </div>
                    <h2 class="font-weight-bold"><?= $this->session->userdata('username') ?></h2>
                </div>
            </div>

        </div>
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
                    <form action="<?= base_url() ?>Dashboard/profilperum" method="post">
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
                                    <option value="<?= $t['id']; ?>" <?php if ($t['id']  == $properum['id_prov']) : echo 'selected';
                                                                        endif ?>><?= $t['nama'] ?>
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
                                    <option value="<?= $k['id']; ?>" <?php if ($k['id']  == $properum['id_kota']) : echo 'selected';
                                                                        endif ?>><?= $k['nama'] ?>
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
                    <h6 class="m-0 font-weight-bold text-white">Foto Profil
                    </h6>
                </div>
                <div class="card-body">
                    <img src="<?= base_url() ?>assets/img-perumahan/<?= $properum['pic'] ?>" class="img-thumbnail" style="height:400px" width="100%" alt=""><br>
                    <form action="<?= base_url(); ?>Dashboard/UploadPerum/<?= $properum['id_perumahan'] ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="img" value="<?= $properum['pic'] ?>" class="form-control-file">
                        <input type="file" name="foto" class="form-control-file">
                        <button type="submit" class="btn btn-success float-right mt-2">Ganti foto profil</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
<?php } ?>
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
                    url: '<?= base_url() ?>Dashboard/Getdatabyajax/',
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
            }

        });
    });
</script>
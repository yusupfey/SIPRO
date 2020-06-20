<h2 class="pb-3">Konfirmasi pembelian</h2>
<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pic struck pembayaran</h6>
            </div>
            <div class="card-body disabled">
                <img src="<?= base_url() ?>assets/img-struck/<?= $acc['pic']; ?>" class=" img-thumbnail">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><input type="checkbox" name="" class="form-input" id="check"> Berikan pesan pada user. Jika data tidak sesuai</h6>
            </div>
            <div class="card-body" id="form">
                <form action="<?= base_url() ?>Dashboard/kirimpesan" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $acc['id_user']; ?>">
                        <textarea name="massage" class="form-control" id="" cols="20" rows="5">Pembayaran gagal. silahkan upload kembali struk pembayaran yang terbaru</textarea>
                        <button type="submit" class="btn btn-danger form-control">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Pembelian</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped dataTables_processing" width="100%" cellspacing="0">

                        <tbody>
                            <tr>
                                <th>ID User</th>
                                <td>:</td>
                                <td><?= $acc['id_user']; ?></td>


                            </tr>
                            <tr>
                                <th>Paket</th>
                                <td>:</td>
                                <td><?= $acc['nominal'];
                                    echo ' / ' . $acc['keterangan'] ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Upload</th>
                                <td>:</td>
                                <td><?= $acc['tgl']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail user</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped dataTables_processing" width="100%" cellspacing="0">

                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td><?= $acc['nama']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td><?= $acc['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>username</th>
                                    <td>:</td>
                                    <td><?= $acc['username']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan='3'><a href="<?= base_url() ?>Dashboard/act_konfirmasi/<?= $acc['id_user']; ?>" class="btn btn-success form-control">Konfirmasi</a></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#form').hide();
        $('#check').on('change', function() {
            if (this.checked) {
                $('.btn-success').addClass('disabled');
                $('#form').show();
            } else {
                $('.btn-success').removeClass('disabled');
                $('#form').hide();


            }
        });
    });
</script>
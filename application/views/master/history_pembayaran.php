<!-- <h2>Booking perumahan</h2> -->
<div class="bg-gray-100 p-4 col-md-12 col-xs-12" style="margin-bottom:300px;">
    <div class="d-flex justify-content-between">
        <div>
            <h2>Laporan Pembayaran</h2>
        </div>
        <div>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="<?= base_url() ?>Report/laporan_transaksi" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-lg"><i class="fas fa-print fa-sm text-white-50"></i> Cetak</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class=" box text-left " style="margin-top:-10px; border-radius:5px">
            <div class="card-header bg-primary text-gray-100">
                Laporan Pembayaran
            </div>
            <?php if ($this->session->flashdata('true')) : ?>
                <script>
                    swal({
                        title: "Berhasil!",
                        text: "<?= $this->session->flashdata('true') ?>",
                        icon: "<?= $this->session->flashdata('alert') ?>",
                    });
                </script>
            <?php endif; ?>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-striped dataTables_processing" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Paket</th>
                                <th>Tanggal</th>
                                <th>keterangan</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $no = 1;
                            foreach ($trans as $v) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $v->id_user; ?></td>
                                    <td><?= $v->paket; ?></td>
                                    <td><?= $v->tanggal; ?>
                                    <td>
                                        <?= $v->keterangan; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
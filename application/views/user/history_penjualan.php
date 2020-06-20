<!-- <h2>Booking perumahan</h2> -->
<div class="card">
    <div class=" box text-left " style="margin-top:-10px; border-radius:5px">
        <div class="card-header bg-primary text-gray-100">
            Laporan Penjualan
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
                            <th>Pembeli</th>
                            <th>Rumah Terjual</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Pembeli</th>
                            <th>Rumah Terjual</th>
                            <th>Tanggal</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($terjual as $f) : ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $f->nama; ?></td>
                                <td>
                                    <p>
                                        <?php if ($f->kategori == 'perum') : ?>
                                            <span><b><?= $f->id_perum; ?></b></span><br>
                                        <?php endif; ?>
                                        <span><b><?= $f->type; ?></b></span><br>
                                        <?php if ($f->kategori == 'perum') : ?>
                                            <span><?= $f->claster; ?>-</span>
                                        <?php endif; ?>
                                        <?= $f->alamat; ?> <?= $f->alamat; ?><br>
                                    </p>
                                </td>
                                <td>
                                    <span><b><?= $f->tgl_jual; ?></b></span><br>

                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
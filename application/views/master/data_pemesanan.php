<h2 class="pb-3">Data Pembayaran</h2>
<?php if ($this->session->flashdata('true')) : ?>
    <script>
        swal({
            title: "Berhasil!",
            text: "<?= $this->session->flashdata('true') ?>",
            icon: "<?= $this->session->flashdata('alert') ?>",
        });
    </script>
<?php endif; ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data belum kirim bukti pembayaran

        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped dataTables_processing" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID payment</th>
                        <th>ID User</th>
                        <th>Paket</th>
                        <th>tanggal</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>ID payment</th>
                        <th>ID User</th>
                        <th>Paket</th>
                        <th>tanggal</th>
                        <th>status</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no =  1;
                    foreach ($pay as $f) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $f->id_payment; ?></td>
                            <td><?= $f->id_user; ?></td>
                            <td><?= $f->id_paket; ?></td>
                            <td><?= $f->tgl; ?></td>
                            <td><?= $f->status; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<h6 class='p-3 text-info alert alert-danger'>Klik <b>ID_USER</b> untuk mengkonfirmasi pembayaran</h4>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data sudah kirim bukti pembayaran
                <label class="badge badge-danger badge-counter">
                    <?php foreach ($notpay as $t) :
                        echo $t->jml;
                    endforeach;
                    ?>
                </label>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped dataTables_processing" id="Tabledata" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID payment</th>
                            <th>ID User</th>
                            <th>Paket</th>
                            <th>tanggal</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>ID payment</th>
                            <th>ID User</th>
                            <th>Paket</th>
                            <th>tanggal</th>
                            <th>status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no =  1;
                        foreach ($paytrue as $f) :
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $f->id_payment; ?></td>
                                <td><a href="<?= base_url() ?>Dashboard/Konfirmasi/<?= $f->id_user; ?>"><?= $f->id_user; ?></a></td>
                                <td><?= $f->id_paket; ?></td>
                                <td><?= $f->tgl; ?></td>
                                <td><?= $f->status; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#Tabledata').dataTable();
        });
    </script>
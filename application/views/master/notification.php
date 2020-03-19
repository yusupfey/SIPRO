<h2 class="pb-3">Data Notifikasi</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Notifikasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped dataTables_processing" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID User</th>
                        <th>Request</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>ID User</th>
                        <th>Request</th>
                        <th>Tanggal</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no =  1;
                    foreach ($not as $f) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $f->id_user; ?></td>
                            <td><?= $f->requerst; ?></td>
                            <td><?= $f->tgl; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
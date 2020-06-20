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
                        <th>From</th>
                        <th>Request</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>From</th>
                        <th>Request</th>
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
                            <td>
                                <div class="row">
                                    <div class="col-md-1 col-xs-1 col-sm-1 ">
                                        <span class="icon-circle
                                            <?php if ($f->icon == 'fa-donate') {
                                                echo 'bg-info';
                                            } else if ($f->icon == 'fa fa-ban') {
                                                echo 'bg-danger';
                                            } else if ($f->icon == 'exclamation') {
                                                echo 'bg-warning';
                                            } else {
                                                echo 'bg-success';
                                            } ?> small">
                                            <i class="fas fa-fw fa-<?= $f->icon; ?> text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col-md-10 col-xs-10 col-sm-10 ml-2">
                                        <?= $f->requerst; ?>
                                        <div class="small text-gray-500"><?= $f->tgl; ?></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
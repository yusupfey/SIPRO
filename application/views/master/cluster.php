<h2 class="pb-3">Data Cluster</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cluster</h6>
    </div>
    <div class="card-body">
        <a href=" <?= base_url() . 'index.php/Administrator/getcluster'; ?>" class="badge badge-primary p-3 text-md mb-4"><i class="fa fa-plus"></i> Tambah data</a>
        <div class="table-responsive">
            <table class="table table-striped dataTables_processing" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Cluster</th>
                        <th>Perumahan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Cluster</th>
                        <th>Perumahan</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no =  1;
                    foreach ($cluster as $f) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $f->id_claster; ?></td>
                            <td><?= $f->claster; ?></td>
                            <td><?= $f->nm_perumahan; ?></td>
                            <td class="text-center">
                                <a href="" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></a>
                                <a href="" class="btn btn-info btn-circle"><span class=" fa fa-info"></span></span></a>
                                <a href="" class="btn btn-danger btn-circle"><span class="fa fa-trash"></span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
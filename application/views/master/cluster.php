<h2 class="pb-3">Data Cluster</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cluster</h6>
    </div>
    <div class="card-body">
        <a href="#" class="badge badge-primary p-3 text-md mb-4" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah data</a>
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
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#" type="button" class="btn btn-success">edit</a>
                                    <a href="#" type="button" id="delete" class="btn btn-danger">delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Cluster</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo $tagopen; ?>
            <div class="modal-body">
                <h2 class="pb-3">Add Cluster</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo $id_perumahan; ?>
                        </div>
                        <div class="form-group">
                            <?php echo $id_claster; ?>
                        </div>
                        <div class="form-group">
                            <?php echo $claster; ?>
                        </div>
                        <!-- <div class="form-group">
                            <?php //echo $submit; 
                            ?>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo $tagclose; ?>
        </div>
    </div>
</div>
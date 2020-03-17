<h2 class="pb-3">Data Lokasi</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Provinsi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="Tabledata" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Provinsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Provinsi</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no =  1;
                            foreach ($prov as $f) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $f->id_prov; ?></td>
                                    <td><?= $f->provinsi; ?></td>
                                    <td>
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
    </div>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kabupaten/Kota</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Kota/Kabupaten</th>
                                <th>Provinsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Kota/Kabupaten</th>
                                <th>Provinis</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no =  1;
                            foreach ($kota as $t) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $t->id_kota; ?></td>
                                    <td><?= $t->kota; ?></td>
                                    <td><?= $t->provinsi; ?></td>
                                    <td>
                                        <a href="" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></a>
                                        <a href="" class="btn btn-info btn-circle"><span class=" fa fa-info"></span></span></a>
                                        <a href="" class="btn btn-danger btn-circle" p-2 ml-2"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#Tabledata').dataTable();
    });
</script>
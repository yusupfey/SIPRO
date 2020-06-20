<h2 class="pb-3">Data Lokasi</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Provinsi</h6>
            </div>
            <div class="card-body">
                <!-- <a href="" class="badge badge-primary p-3 text-md mb-4"><i class="fa fa-plus"></i> Tambah data</a> -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="Tabledata" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Provinsi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Provinsi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no =  1;
                            foreach ($prov as $f) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $f['id']; ?></td>
                                    <td><?= $f['nama']; ?></td>

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
                                <th>ID</th>
                                <th>Kota/Kabupaten</th>
                                <th>Provinsi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Kota/Kabupaten</th>
                                <th>Provinis</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no =  1;
                            foreach ($kota as $t) :
                            ?>
                                <tr>
                                    <td><?= $t['city_id']; ?></td>
                                    <td><?= $t['city_name'] ?></td>
                                    <td><?= $t['province']; ?></td>
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
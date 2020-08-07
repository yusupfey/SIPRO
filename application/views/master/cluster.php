<!-- <h2 class="pb-3">Data Cluster</h2> -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cluster</h6>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('true')) : ?>
            <script>
                swal({
                    title: "Berhasil!",
                    text: "<?= $this->session->flashdata('true') ?>",
                    icon: "<?= $this->session->flashdata('alert') ?>",
                });
            </script>
        <?php endif; ?>
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
                <tbody id="show_data">
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
                                    <a href="#" id="view" data="<?php echo $f->id_claster; ?>" data-toggle="modal" data-target="#editclu" class="btn btn-success edit">edit</a>
                                    <input type="hidden" class="idc" value="<?php echo $f->id_claster ?>">
                                    <input type="hidden" class="nama" value="<?php echo $f->claster; ?>">
                                    <input type="hidden" class="perum" value="<?php echo $f->id_perumahan; ?>">
                                    <a href="<?= base_url() ?>Dashboard/Deleteclaster/<?= $f->id_claster; ?>" type="button" id="delete" class="btn btn-danger">delete</a>

                                </div>
                            </td>
                        </tr>

                    <?php endforeach ?>
                </tbody>
            </table>
            </td>
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
    <div class="modal fade" id="editclu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Cluster</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() ?>Dashboard/EditCluster" method="post">
                    <div class="modal-body">
                        <h2 class="pb-3">Add Cluster</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="idperumahan" Readonly class="form-control" id="idperumahan">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="idcluster" Readonly class="form-control" id="idc">

                                </div>
                                <div class="form-group">
                                    <input type="text" name="cluster" class="form-control" id="clu">

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
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var id = 0;
    $(document).ready(function() {

        $('#show_data').on('click', '.edit', function() {
            id = $(this).attr('data');
            var tr = $(this).closest('tr') // Cari tag tr paling terdekat
            var idc = tr.find('.idc').val(); //data yang di ambil berdasarkan tr terdekat
            var nama = tr.find('.nama').val(); //data yang di ambil berdasarkan tr terdekat
            var perum = tr.find('.perum').val(); //data yang di ambil berdasarkan tr terdekat
            $('#idc').val(idc);
            $('#clu').val(nama);
            $('#idperumahan').val(perum);
        });
        $('#exampleModal').on('hidden.bs.modal', function(e) { // Ketika Modal Dialog di Close / tertutup
            $('#form-modal input, #form-modal select, #form-modal textarea').val('') // Clear inputan menjadi kosong
        })

    });
</script>
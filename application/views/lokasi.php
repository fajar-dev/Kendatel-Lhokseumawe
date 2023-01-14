<!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
                <div class="row justify-content-center">
                <div class="col-12">
                    <?php echo $this->session->flashdata('msg') ?>
                </div>  
                        <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambahkan Lokasi</h4>
                                <div class="mt-4 activity">
                                    <form action="<?php echo base_url() ?>page/tambah_lokasi" method="POST">
                                        <div class="form-group mb-4">
                                            <input type="text" class="form-control" name="lokasi" placeholder="Lokasi">
                                        </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card w-100">
                            <div class="card-body">
                                    <h4 class="card-title">Data Lokasi</h4>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Lokasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no=1;
                                                foreach($hasil as $data){
                                            ?>
                                            <tr>
                                                <td><?php echo $no++;?></td>
                                                <td><?php echo htmlentities($data->nama_lokasi, ENT_QUOTES, 'UTF-8');?></td>
                                                    <td>
                                                        <button type="button" data-toggle="modal" data-target="#exampleModal<?php echo $data->id_lokasi?>" class="btn btn-warning text-white"><i class="fas fa-pencil-alt"></i></button>
                                                        <a href="<?php echo base_url() ?>page/hapus/<?php echo $data->id_lokasi ?>" class="btn btn-danger btn-del"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal<?php echo $data->id_lokasi?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form action="<?php echo base_url() ?>page/update_lokasi" method="POST">
                                                                <input type="hidden" value="<?php echo $data->id_lokasi?>" name="id">
                                                                <div class="form-group mb-4">
                                                                <label>Nama lokasi</label>
                                                                <input type="text" name="nama" class="form-control" value="<?php echo htmlentities($data->nama_lokasi, ENT_QUOTES, 'UTF-8');?>" placeholder="Nama">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
                <div class="row">
                <div class="col-12">
                    <?php echo $this->session->flashdata('msg') ?>
                </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambah Data Barang</h4>
                                <div class="mt-4 activity">
                                    <form action="<?php echo base_url() ?>page/tambah_barang" method="POST">
                                    <div class="form-group mb-4">
                                            <label>Kode Barang</label>
                                            <input type="text" name="kode" class="form-control" placeholder="Kode Barang">
                                        </div>
                                        <input type="hidden" name="jenis" value="1">
                                        <input type="hidden" name="url" value="habis_pakai">
                                        <div class="form-group mb-4">
                                          <label>Nama Barang</label>
                                          <input type="text" name="nama" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleFormControlSelect1">Jenis Barang</label>
                                            <select class="form-control" name="lokasi" id="exampleFormControlSelect1">
                                                <?php
                                                    foreach($lokasi as $data){
                                                ?>
                                                    <option value="<?php echo $data->id_lokasi;?>"><?php echo htmlentities($data->nama_lokasi, ENT_QUOTES, 'UTF-8');?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambah Stok</h4>
                                <div class="mt-4 activity">
                                    <form action="<?php echo base_url() ?>page/tambah_stok" method="POST">
                                    <input type="hidden" name="url" value="habis_pakai">
                                        <div class="form-group mb-4">
                                            <label for="exampleFormControlSelect1">Barang</label>
                                            <select class="form-control" name="id" id="exampleFormControlSelect1">
                                                <?php
                                                    foreach($hasil as $data){
                                                ?>
                                                    <option value="<?php echo $data->id_barang;?>"><?php echo htmlentities($data->nama_barang, ENT_QUOTES, 'UTF-8');?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Stok</label>
                                            <input type="number" class="form-control" name="stok" placeholder="Stok Masuk">
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
                                    <h4 class="card-title">Data Barang Habis Pakai</h4>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Lokasi</th>
                                                <th>Stok</th>
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
                                                <td><?php echo htmlentities($data->id_barang, ENT_QUOTES, 'UTF-8');?></td>
                                                <td><?php echo htmlentities($data->nama_barang, ENT_QUOTES, 'UTF-8');?></td>
                                                <td><?php echo htmlentities($data->nama_lokasi, ENT_QUOTES, 'UTF-8');?></td>
                                                <td><?php echo htmlentities($data->stok_barang, ENT_QUOTES, 'UTF-8');?></td>
                                                    <td>
                                                        <a href="<?php echo base_url() ?>page/hapus/<?php echo $data->id_barang ?>/habis_pakai" class="btn btn-danger btn-del"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
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
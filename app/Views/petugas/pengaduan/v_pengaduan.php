<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-body">
            <?php $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger alert-dismissible mb-4">
                    <ul>
                        <?php foreach ($errors as $key => $error) { ?>
                            <li><?= esc($error) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if (session()->getFlashdata('gagal')) {
                echo '<div class="alert alert-danger alert-dismissible"> <i class="icon fas fa-times"></i>';
                echo session()->getFlashdata('gagal');
                echo '</div>';
            } ?>
            <?php if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible"> <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            } ?>
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="10px">No</th>
                        <th width="50px">Tanggal Pengaduan</th>
                        <th width="100px">NIK</th>
                        <th width="100px">Nama</th>
                        <th width="200px">Isi</th>
                        <th width="150px">Foto</th>
                        <th width="50px">Status</th>
                        <th width="50px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pengaduanPetugas as $key => $value) { ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $value['tgl_pengaduan'] ?></td>
                            <td><?= $value['nik'] ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['isi_laporan'] ?></td>
                            <td><img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Laporan" width="250" height="250"></td>
                            <td><?php
                                if ($value['status'] == '0') {
                                    echo 'Belum Diproses';
                                } elseif ($value['status'] == '1') {
                                    echo 'Sedang Diproses';
                                } elseif ($value['status'] == '2') {
                                    echo 'Sudah Diproses';
                                } else {
                                    echo 'Status Tidak Valid'; // Handle invalid status values if needed
                                }
                                ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#add-tanggapan<?= $value['id_pengaduan'] ?>"><i class="fas fa-comment"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


<!-- /add-modal -->
<?php foreach ($pengaduanPetugas as $key => $value) { ?>
    <div class="modal fade" id="add-tanggapan<?= $value['id_pengaduan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Tanggapann</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open_multipart('ControllerTanggapan/InsertData') ?>
                <div class="modal-body">
                    <div class="form-group" hidden>
                        <label for="">ID Pengaduan</label>
                        <input name="id_pengaduan" class="form-control" value="<?= $value['id_pengaduan'] ?>" readonly>
                    </div>
                    <div class="form-group" hidden>
                        <label for="">Tanggal Pengaduan</label>
                        <input name="tgl_pengaduan" class="form-control" value="<?= $value['tgl_pengaduan'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">NIK</label>
                        <input name="nik" class="form-control" value="<?= $value['nik'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input name="nama" class="form-control" value="<?= $value['nama'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Isi Laporan</label>
                        <input name="isi_laporan" class="form-control" value="<?= $value['isi_laporan'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Foto</label><br>
                        <input name="foto" class="form-control" readonly hidden>
                        <img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Pengaduan" width="250" height="250" />
                    </div>
                    <div class="form-group">
                        <label for="">Tanggapan</label>
                        <input name="tanggapan" class="form-control">
                    </div>
                    <div class="form-group" hidden>
                        <label for="">Status</label>
                        <input name="status" class="form-control" value="<?php if ($value['status'] = '0') {
                                                                                echo 'Belum Diproses';
                                                                            } elseif ($value['status'] = '1') {
                                                                                echo 'Sedang Diproses';
                                                                            } elseif ($value['status'] = '2') {
                                                                                echo 'Sudah Diproses';
                                                                            } else {
                                                                                echo 'Status Tidak Valid'; // Handle invalid status values if needed
                                                                            }
                                                                            ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Petugas</label>
                        <input name="petugas" class="form-control" value="<?= session()->get('nama_petugas') ?>" required readonly>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
                <?php echo form_fieldset_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>
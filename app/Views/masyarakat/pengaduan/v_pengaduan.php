<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-pengaduan"><i class="fas fa-plus"></i> Tambah Pengaduan</button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
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
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $adaLaporan = false; // Variabel untuk melacak apakah ada laporan yang sesuai kondisi

                    foreach ($pengaduan as $key => $value) {
                        if ($value['status'] === '0') {
                            $adaLaporan = true; // Set variabel ini menjadi true jika ada laporan yang sesuai kondisi
                    ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $value['tgl_pengaduan'] ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['isi_laporan'] ?></td>
                                <td><img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Laporan" width="250" height="250"></td>
                                <td><?php
                                    if ($value['status'] == 0) { ?>
                                        <span class="badge bg-secondary">Belum Diproses</span>
                                    <?php } elseif ($value['status'] == 1) { ?>
                                        <span class="badge bg-primary">Sedang Diproses</span>
                                    <?php } elseif ($value['status'] == 2) { ?>
                                        <span class="badge bg-success">Sudah Diproses</span>
                                    <?php } else { ?>
                                        <span class="badge bg-secondary">Tidak Valid </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-pengaduan<?= $value['id_pengaduan'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-pengaduan<?= $value['id_pengaduan'] ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php }
                    }

                    // Tampilkan teks "Tidak ada Laporan" jika tidak ada laporan yang sesuai kondisi
                    if (!$adaLaporan) { ?>
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada Laporan</td>
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
<div class="modal fade" id="add-pengaduan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pengaduan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('ControllerPengaduan/InsertData') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">NIK</label>
                    <input name="nik" class="form-control" value="<?= session()->get('nik') ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input name="nama" class="form-control" value="<?= session()->get('nama') ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="">Isi Laporan</label>
                    <input name="isi_laporan" class="form-control" placeholder="Isi Laporan" required>
                </div>
                <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php foreach ($pengaduan as $key => $value) { ?>
    <!-- /edit-modal -->
    <div class="modal fade" id="edit-pengaduan<?= $value['id_pengaduan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Pengaduan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open_multipart('ControllerPengaduan/UpdateData/' . $value['id_pengaduan']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">NIK</label>
                        <input name="nik" class="form-control" value="<?= $value['nik'] ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input name="nama" class="form-control" value="<?= $value['nama'] ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Isi Laporan</label>
                        <input name="isi_laporan" class="form-control" value="<?= $value['isi_laporan'] ?>" placeholder="Isi Laporan" required>
                    </div>
                    <div class="form-group">
                        <label>Foto</label><br>
                        <input type="file" name="foto" class="form-control">
                        <img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Pengaduan" width="250" height="250" />
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Update</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<!-- /delete-modal -->
<?php foreach ($pengaduan as $key => $value) { ?>
    <div class="modal fade" id="delete-pengaduan<?= $value['id_pengaduan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Pengaduan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Hapus Pengaduan..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('ControllerPengaduan/DeleteData/' . $value['id_pengaduan']) ?>" class="btn btn-danger btn-flat">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>
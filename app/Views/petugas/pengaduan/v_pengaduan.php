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
            <table id="example1" class="table table-bordered table-responsive">
                <thead>
                    <tr class="text-center">
                        <th width="100px">No</th>
                        <th width="200px">Tanggal Pengaduan</th>
                        <th width="200px">NIK</th>
                        <th width="150px">Nama</th>
                        <th width="300px">Isi</th>
                        <th width="300px">Foto</th>
                        <th width="200px">Status</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $adaLaporan = false; // Variabel untuk melacak apakah ada laporan yang sesuai kondisi

                    foreach ($pengaduanPetugas as $key => $value) {
                        if ($value['status'] === '0') {
                            $adaLaporan = true; // Set variabel ini menjadi true jika ada laporan yang sesuai kondisi
                    ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $value['tgl_pengaduan'] ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['isi_laporan'] ?></td>
                                <td>
                                    <a data-fancybox="gallery" href="<?= base_url('uploads/' . $value['foto']) ?>">
                                        <img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Laporan" width="250" height="250">
                                    </a>
                                </td>
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
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#add-tanggapan<?= $value['id_pengaduan'] ?>"><i class="fas fa-comment"></i></button>
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
<?php foreach ($pengaduanPetugas as $key => $value) { ?>
    <div class="modal fade" id="add-tanggapan<?= $value['id_pengaduan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Tanggapan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open_multipart('ControllerTanggapan/InsertData/' . $value['id_pengaduan']) ?>
                <div class="modal-body">
                    <div class="form-group">
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
                        <a data-fancybox="gallery" href="<?= base_url('uploads/' . $value['foto']) ?>">
                            <img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Laporan" width="250" height="250">
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggapan</label>
                        <input name="tanggapan" class="form-control">
                    </div>
                    <div class="form-group" hidden>
                        <label for="">Status</label>
                        <input name="status" class="form-control" value="<?php if ($value['status'] == '0') {
                                                                                echo 'Belum Diproses';
                                                                            } elseif ($value['status'] == '1') {
                                                                                echo 'Sedang Diproses';
                                                                            } elseif ($value['status'] == '2') {
                                                                                echo 'Sudah Diproses';
                                                                            } else {
                                                                                echo 'Status Tidak Valid'; // Handle invalid status values if needed
                                                                            }
                                                                            ?>" readonly>
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
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>
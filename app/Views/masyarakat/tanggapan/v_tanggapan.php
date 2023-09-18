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
                        <th width="60px">No</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Tanggal Tanggapan</th>
                        <th>NIK</th>
                        <th width="150px">Nama</th>
                        <th width="300px">Isi Laporan</th>
                        <th width="200px">Foto</th>
                        <th width="250px">Tanggapan</th>
                        <th>Status</th>
                        <th width="100px">Petugas</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $adaLaporan = false; // Variabel untuk melacak apakah ada laporan yang sesuai kondisi

                    foreach ($tanggapan as $key => $value) {
                        if ($value['status'] === '1') {
                            $adaLaporan = true; // Set variabel ini menjadi true jika ada laporan yang sesuai kondisi
                    ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $value['tgl_pengaduan'] ?></td>
                                <td><?= $value['tgl_tanggapan'] ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['isi_laporan'] ?></td>
                                <td>
                                    <a data-fancybox="gallery" href="<?= base_url('uploads/' . $value['foto']) ?>">
                                        <img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Laporan" width="250" height="250">
                                    </a>
                                </td>
                                <td><?= $value['tanggapan'] ?></td>
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
                                <td><?= $value['nama_petugas'] ?></td>
                            </tr>
                        <?php } elseif ($value['status'] === '2') {
                            $adaLaporan = true;
                        ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $value['tgl_pengaduan'] ?></td>
                                <td><?= $value['tgl_tanggapan'] ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['isi_laporan'] ?></td>
                                <td>
                                    <a data-fancybox="gallery" href="<?= base_url('uploads/' . $value['foto']) ?>">
                                        <img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Laporan" width="250" height="250">
                                    </a>
                                </td>
                                <td><?= $value['tanggapan'] ?></td>
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
                                <td><?= $value['nama_petugas'] ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-tanggapan<?= $value['id_tanggapan'] ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php }
                    }

                    // Tampilkan teks "Tidak ada Laporan" jika tidak ada laporan yang sesuai kondisi
                    if (!$adaLaporan) { ?>
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada Tanggapan</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- /delete-modal -->
<?php foreach ($tanggapan as $key => $value) { ?>
    <div class="modal fade" id="delete-tanggapan<?= $value['id_tanggapan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Pengaduan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Hapus Tanggapan..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('/delete-tanggapan/' . $value['id_tanggapan']) ?>" class="btn btn-danger btn-flat">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>
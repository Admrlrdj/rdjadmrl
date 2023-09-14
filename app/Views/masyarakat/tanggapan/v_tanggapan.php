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
                        <th width="50px">Tanggal Tanggapan</th>
                        <th width="100px">NIK</th>
                        <th width="100px">Nama</th>
                        <th width="200px">Isi Laporan</th>
                        <th width="150px">Foto</th>
                        <th width="200px">Tanggapan</th>
                        <th width="50px">Status</th>
                        <th width="50px">Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    $adaTanggapan = false;

                    foreach ($tanggapan as $key => $value) {
                        if ($value['status'] === '1' || $value['status'] === '2') {
                            $adaTanggapan = true;
                    ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $value['tgl_pengaduan'] ?></td>
                                <td><?= $value['tgl_tanggapan'] ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['isi_laporan'] ?></td>
                                <td><img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Laporan" width="250" height="250"></td>
                                <td><?= $value['tanggapan'] ?></td>
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
                                <td><?= $value['nama_petugas'] ?></td>
                            </tr>
                        <?php }
                    }

                    if (!$adaTanggapan) { ?>
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
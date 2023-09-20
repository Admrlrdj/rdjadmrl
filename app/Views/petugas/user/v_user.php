<div class="col-md-8">
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
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th width="200px">NIK</th>
                        <th width="200px">Nama</th>
                        <th width="150px">Username</th>
                        <th width="150px">Password</th>
                        <th width="200px">No. Telepon</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($user as $key => $value) { ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $value['nik'] ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['username'] ?></td>
                            <td><?= $value['password'] ?></td>
                            <td><?= $value['telp'] ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-user<?= $value['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-user<?= $value['id'] ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- /edit-modal -->
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="edit-user<?= $value['id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('/edit-user/' . $value['id']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">NIK</label>
                        <input name="nik" class="form-control" value="<?= $value['nik'] ?>" placeholder="Masukkan Nama User" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input name="nama" class="form-control" value="<?= $value['nama'] ?>" placeholder="Masukkan E-Mail" required>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input name="username" class="form-control" value="<?= $value['username'] ?>" placeholder="Masukkan E-Mail" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" value="<?= $value['password'] ?>" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">No. Telepon</label>
                        <input name="telp" class="form-control" value="<?= $value['telp'] ?>" placeholder="Masukkan No. Telepon" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning btn-flat">Save</button>
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
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="delete-user<?= $value['id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Hapus Data User <b><?= $value['nama'] ?></b> ..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('/delete-user/' . $value['id']) ?>" class="btn btn-danger btn-flat">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<script>
    // Fungsi untuk menutup alert secara otomatis
    function closeAlert() {
        $('.alert').fadeOut('slow'); // Menggunakan jQuery untuk fade out alert
    }

    // Fungsi untuk memanggil closeAlert() setelah beberapa detik (misal: 5 detik)
    function setupAlertTimer() {
        setTimeout(closeAlert, 2000); // 5000 milidetik (5 detik)
    }

    // Panggil fungsi setupAlertTimer() saat dokumen siap (selesai di-load)
    $(document).ready(function() {
        setupAlertTimer();
    });
</script>
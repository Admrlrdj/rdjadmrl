<div class="col-md-8">
    <div class="card card-primary">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-user"><i class="fas fa-plus"></i> Add Data Admin
                </button>
            </div>
        </div>
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
                        <th width="200px">Nama Petugas</th>
                        <th width="150px">Username</th>
                        <th width="150px">Password</th>
                        <th width="200px">No. Telepon</th>
                        <th width="200px">Level</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($admin as $key => $value) { ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_petugas'] ?></td>
                            <td><?= $value['username'] ?></td>
                            <td><?= $value['password'] ?></td>
                            <td><?= $value['telp'] ?></td>
                            <td><?php
                                if ($value['level'] == 'admin') { ?>
                                    <span class="badge bg-success">Admin</span>
                                <?php } else { ?>
                                    <span class="badge bg-primary">Petugas</span>
                                <?php } ?>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-user<?= $value['id_petugas'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-user<?= $value['id_petugas'] ?>"><i class="fas fa-trash"></i></button>
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

<!-- /add-modal -->
<div class="modal fade" id="add-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('/add-admin') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Petugas</label>
                    <input name="nama_petugas" class="form-control" placeholder="Masukkan Nama Petugas" required>
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input name="username" class="form-control" placeholder="Masukkan Username" required>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                </div>
                <div class="form-group">
                    <label for="">No. Telepon</label>
                    <input name="telp" class="form-control" placeholder="Masukkan No. Telepon" required>
                </div>
                <div class="form-group">
                    <label for="">Level</label>
                    <select name="level" class="form-control">
                        <option value=""></option>
                        <option value="admin" <?= $value['level'] == 'admin' ? 'Selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= $value['level'] == 'petugas' ? 'Selected' : '' ?> selected>Petugas</option>
                    </select>
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

<!-- /edit-modal -->
<?php foreach ($admin as $key => $value) { ?>
    <div class="modal fade" id="edit-user<?= $value['id_petugas'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('/edit-admin/' . $value['id_petugas']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Petugas</label>
                        <input name="nama_petugas" class="form-control" value="<?= $value['nama_petugas'] ?>" placeholder="Masukkan Nama Petugas" required>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input name="username" class="form-control" value="<?= $value['username'] ?>" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" value="<?= $value['password'] ?>" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">No. Telepon</label>
                        <input name="telp" class="form-control" value="<?= $value['telp'] ?>" placeholder="Masukkan No. Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="">Level</label>
                        <select name="level" class="form-control">
                            <option value="admin" <?= $value['level'] == 'admin' ? 'Selected' : '' ?>>Admin</option>
                            <option value="petugas" <?= $value['level'] == 'petugas' ? 'Selected' : '' ?>>Petugas</option>
                        </select>
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
<?php foreach ($admin as $key => $value) { ?>
    <div class="modal fade" id="delete-user<?= $value['id_petugas'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Hapus Data User <b><?= $value['nama_petugas'] ?></b> ..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('/delete-admin/' . $value['id_petugas']) ?>" class="btn btn-danger btn-flat">Delete</a>
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
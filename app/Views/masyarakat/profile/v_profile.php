<div class="col-md-3">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('AdminLTE') ?>/dist/img/user2-160x160.jpg" alt=" User profile picture">
            </div>

            <h3 class="profile-username text-center"><?= session()->get('nama') ?></h3>

            <p class="text-muted text-center">Masyarakat</p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>NIK</b> <a class="float-right"><?= session()->get('nik') ?></a>
                </li>
                <li class="list-group-item">
                    <b>Username</b> <a class="float-right"><?= session()->get('username') ?></a>
                </li>
                <li class="list-group-item">
                    <b>No. Telepon</b> <a class="float-right"><?= session()->get('telp') ?></a>
                </li>
            </ul>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
<div class="col-md-9">
    <div class="card card-primary card-outline">
        <div class="card-header p-2">
            <div>
                <h4 class="text-muted text-center">Ubah Identitas</h4>


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

                <?= form_open('ControllerProfile/UpdateProfile/' . session()->get('id')) ?>
                <div class="input-group mb-3">
                    <input type="text" name="nik" id="nik" class="form-control" value="<?= session()->get('nik') ?>" placeholder="NIK" readonly>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-solid fa-address-card"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="nama" id="nama" class="form-control" value="<?= session()->get('nama') ?>" placeholder="Nama">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="username" id="username" class="form-control" value="<?= session()->get('username') ?>" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" value="<?= session()->get('password') ?>" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="repassword" id="repassword" class="form-control" value="<?= session()->get('password') ?>" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="telp" id="telp" class="form-control" value="<?= session()->get('telp') ?>" placeholder="No. Telepon">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-phone"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Ubah</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?= form_close() ?>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>
<!-- /.card -->

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
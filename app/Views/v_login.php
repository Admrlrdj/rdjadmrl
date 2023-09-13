<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rdjadmrl | Log in Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Rdj</b>admrl</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

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

                <?php echo form_open('Home/CekLogin') ?>
                <div class="input-group mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?php form_close() ?>

                <p class="mb-0">
                    <a href="<?= base_url('Home/Register') ?>" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

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
</body>

</html>
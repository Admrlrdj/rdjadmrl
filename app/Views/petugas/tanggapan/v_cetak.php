<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title id="tt">Rdjadmrl | Generate Laporan</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- SCRIPT -->

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        function closeAlert() {
            $('.alert').fadeOut('slow');
        }

        function setupAlertTimer() {
            setTimeout(closeAlert, 2000);
        }
        $(document).ready(function() {
            setupAlertTimer();
        });
    </script>
    <style>
        @page {
            size: auto;
        }

        body {
            background: rgb(204, 204, 204);
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.5);
        }

        page[size="A4"] {
            width: 29.7cm;
            height: 21cm;
        }

        page[size="A4"][layout="potrait"] {
            width: 29.7cm;
            height: 21cm;
        }

        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;
        }

        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 19.8cm;
        }

        page[size="dipakai"][layout="landscape"] {
            width: 20cm;
            height: 20cm;
        }

        @media print {

            body,
            page {
                margin: auto;
                box-shadow: 0;
            }

            title,
            #ct {
                display: none !important;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php $no = 1;
    foreach ($tanggapanPetugas as $key => $value) { ?>
        <page size="dipakai" layout="landscape">
            <br>
            <div class="container">
                <span id="remove">
                    <a class="btn btn-success" id="ct"><span class="icon-print"></span> CETAK</a>
                </span>
            </div>
            <center>
                <h4>
                    RDJADMRL DUMAS
                </h4>
                <span>
                    Jl. Raya Bogor KM. 107 Kel. Tengah, Kec. Kramat Jati, Jakarta Timur, DKI Jakarta<br>
                    Telp. +6289531807064 || E-mail radjaadmiral00@gmail.com
                </span>
            </center>
            <hr>
            <table style="width: 100%" class="">
                <tr>
                    <td>
                        Nama &nbsp;&nbsp;
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <?= $value['nama']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 15%">
                        Nama Petugas
                    </td>
                    <td style="width: 5%">
                        :
                    </td>
                    <td style="width: 80%">
                        <?= $value['nama_petugas']; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Waktu Laporan
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <?= $value['tgl_pengaduan']; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Waktu Tanggapan
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <?= $value['tgl_tanggapan']; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        NIK
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <?= $value['nik']; ?>
                    </td>
                </tr>
            </table>

            <hr>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="head0">ID Tanggapan.</th>
                        <th class="head1">Isi Laporan</th>
                        <th class="head0 right">Foto</th>
                        <th class="head1 right">Isi Tanggapan</th>
                        <th class="head0 right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <center><?= $value['id_tanggapan']; ?> </center>
                        </td>
                        <td><?= $value['isi_laporan']; ?></td>
                        <td class="right">
                            <center><a data-fancybox="gallery" target="_blank" href="<?= base_url('uploads/' . $value['foto']) ?>">
                                    <img src="<?= base_url('uploads/' . $value['foto']) ?>" class="img-fluid" alt="Foto Laporan" width="250" height="250">
                                </a></center>
                        </td>
                        <td class="right"><?= $value['tanggapan']; ?></td>
                        <td class="right">
                            <?php
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
                    </tr>
                </tbody>
            </table>

            <hr>
            <center>
                <h5>
                    TERIMAKASIH
                </h5>
            </center>
            <hr>

        </page>
    <?php } ?>

    <script type="text/javascript">
        document.getElementById('ct').onclick = function() {
            window.print();
        }
    </script>
</body>

</html>
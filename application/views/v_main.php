<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>APP 360 | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="images/favicon.png" />
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
              folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="bower_components/morris.js/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="dist/css/nprogress.css ">
         <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1099792537777374" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css ">
        <!-- <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css "> -->
        <link rel="stylesheet" href="plugins/dialog/bootstrap-dialog.min.css ">
        <link href="<?= base_url('plugins/jQueryUI/jquery-ui.css') ?>" rel="stylesheet" >
        <style>

            @font-face {
                font-family: poppins;
                src: url(fonts/Poppins-Regular.ttf);
            }
            body,.btn,input[type="password"],input[type="text"],td,label,.bootstrap-dialog-title,textarea,p{
                font-size:11px;
                font-family: poppins;
            }td{
                vertical-align: middle !important;
            }.modal-body{
                padding:0px;
            }
        </style>

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="./" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>PP 360</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>ePrilaku</b>360</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="images/360derajatlogo.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $this->session->userdata('nama') ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="images/360derajatlogo.png" class="img-circle" alt="User Image">

                                        <p style="font-size:10px;">
                                            <?= $this->session->userdata('nama') ?> <br> <?= $this->session->userdata('jabatan') ?>

                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="javascript:void(0)" onclick="profile()" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="main/logout" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel" align='center'>
                        <img src="images/logotrans.png" width="30%">

                    </div>
                    <div class="user-panel" style="height: 70px;">
                        <div class="pull-left image" style="margin-top:0px;">
                            <img src="images/360derajatlogo.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Selamat datang,<br><?= $this->session->userdata('nip') ?><br>
                                <?= $this->session->userdata('jenis') ?><br>
                               
                            </p>

                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>
                        <?php
                        $jabatan = $this->session->userdata('jabatan');
                        if ($jabatan !== 'Admin') {
                            ?>
                            ?>
                            <li class="li li-dashboard"><a href="javascript:void(0)" onclick="menu('dashboard', 'li-dashboard')"><i class="fa fa-dashboard text-aqua fa-2x"></i>&nbsp&nbsp<span>Dashboard</span></a></li>
                            <li class="li li-evaluator"><a href="javascript:void(0)" onclick="menu('pengaturan/evaluator', 'li-evaluator')"><i class="fa fa-sitemap text-yellow fa-2x"></i>&nbsp&nbsp<span>Pengaturan Evaluator</span></a></li>
                            <li class="li li-penilaian"><a href="javascript:void(0)" onclick="menu('penilaian/lihat_penilaian', 'li-penilaian')"><i class="fa fa-thumbs-up text-red fa-2x"></i>&nbsp&nbsp<span>Penilaian Perilaku</span>
                                    <span class="pull-right-container">
                                        <small class="label bg-red" id="ttl_penilaian">0</small>
                                        <!-- <small class="label pull-right bg-blue">17</small> -->
                                    </span>
                                </a>
                            </li>
                            <li class="li li-hasil"><a href="javascript:void(0)" onclick="menu('penilaian/hasil', 'li-hasil')"><i class="fa fa-apple text-silver fa-2x"></i>&nbsp&nbsp<span>Hasil Penilaian</span></a></li>
                            <li class="li li-perilaku2"><a href="javascript:void(0)" onclick="menu('penilaian/perilaku_tahunan', 'li-perilaku2')"><i class="fa fa-calendar text-green fa-2x"></i>&nbsp&nbsp<span>Nilai Perilaku (Tahunan)</span></a></li>
                            <li><a href="javascript:void(0)" onclick="profile()"><i class="fa fa-user-md fa-2x"></i>&nbsp&nbsp<span>Edit Profile</span></a></li>
                        <?php } else { ?>
                            <li class="li li-dashboard"><a href="javascript:void(0)" onclick="menu('dashboard', 'li-dashboard')"><i class="fa fa-circle-o text-red"></i> <span>Dashboard</span></a></li>
                            <li class="li li-periode"><a href="javascript:void(0)" onclick="menu('penilaian/periode', 'li-periode')"><i class="fa fa-circle-o text-yellow"></i> <span>Input Periode Penilaian</span></a></li>
                            <li class="li li-pertanyaan1"><a href="javascript:void(0)" onclick="menu('pertanyaan/umum/1', 'li-pertanyaan1')"><i class="fa fa-circle-o text-yellow"></i> <span>Pertanyaan &  Jawaban Eselon 1</span></a></li>
                            <li class="li li-pertanyaan2"><a href="javascript:void(0)" onclick="menu('pertanyaan/umum/0', 'li-pertanyaan2')"><i class="fa fa-circle-o text-yellow"></i> <span>Pertanyaan &  Jawaban </span></a></li>
                            <!--
                            <li class="li li-user"><a href="javascript:void(0)" onclick="menu('user', 'li-user')"><i class="fa fa-circle-o text-yellow"></i> <span>User & Admin </span></a></li>
                            <li><a href="javascript:void(0)" onclick="menu('user/password_kandidat')"><i class="fa fa-circle-o text-yellow"></i> <span>Password Detail Kandidat </span></a></li>
                            <li><a href="javascript:void(0)" onclick="email()"><i class="fa fa-circle-o text-aqua"></i> <span>Setting Email</span></a></li>
                            
                            <li><a href="javascript:void(0)" onclick="revisi()"><i class="fa fa-circle-o text-aqua"></i> <span>Revisi Jawaban</span></a></li>
                            -->
                            
                            <li class="li-penilaian"><a href="javascript:void(0)" onclick="menu('penilaian/adm_hapus_penilaian', 'li-penilaian')"><i class="fa fa-circle-o text-aqua"></i> <span>Hapus Penilaian</span></a></li>
                            <li class="li-pengajuan"><a href="javascript:void(0)" onclick="menu('penilaian/adm_hapus_pengajuan', 'li-pengajuan')"><i class="fa fa-circle-o text-aqua"></i> <span>Hapus Pengajuan</span></a></li>
                            <li class="li-rekapitulasi"><a href="javascript:void(0)" onclick="menu('penilaian/rekapitulasi', 'li-rekapitulasi')"><i class="fa fa-circle-o text-aqua"></i> <span>Rekapitulasi</span></a></li>
                            
                        <?php } ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->

            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; 2020 <a href="">BKPPD Kab. Balangan</a>.</strong>
            </footer>


        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script src="plugins/jQueryUI/jquery-ui.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
                            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!--<script src="bower_components/chart.js/Chart.js"></script>-->

        <!-- jvectormap -->
        <!-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
                <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
        <!-- jQuery Knob Chart -->
        <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="bower_components/moment/min/moment.min.js"></script>
        <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!-- <script src="dist/js/pages/dashboard.js"></script> -->
        <script src="dist/css/nprogress.js"></script>
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/dialog/bootstrap-dialog.min.js"></script>
        <script src="dist/js/highcharts.js"></script>
        <script src="dist/js/highcharts-more.js"></script>
            <!-- <script src="plugins/datatables/dataTables.bootstrap.min.js"></script> -->
        <script type="text/javascript">
                            function getFormData($form) {
                                var unindexed_array = $form.serializeArray();
                                var indexed_array = {};

                                $.map(unindexed_array, function (n, i) {
                                    indexed_array[n['name']] = n['value'];
                                });

                                return indexed_array;
                            }

                            function menu(link, css) {
                                $.ajax({
                                    url: link,
                                    type: 'get',
                                    dataType: "html",
                                    beforeSend: function () {
                                        $('.li').removeClass('active');
                                        $('.' + css).addClass('active');
                                        NProgress.start();
                                        $('.content-wrapper').hide();
                                        $('.content-wrapper').empty();
                                    },
                                    success: function (data) {
                                        NProgress.done();

                                        $('.content-wrapper').show();
                                        $('.content-wrapper').html(data);
                                    }
                                });
                            }

                            function profile() {
                                var dialog = new BootstrapDialog({
                                    message: function (dialogRef) {
                                        var $message = $('<div></div>').load('user/profile/');
                                        var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                                        $button.on('click', {dialogRef: dialogRef}, function (event) {
                                            event.data.dialogRef.close();
                                        });
                                        $message.append($button);

                                        return $message;
                                    },
                                    closable: true
                                });
                                dialog.realize();
                                dialog.getModalHeader().hide();
                                dialog.getModalFooter().hide();
                                dialog.open();
                            }
                            function email() {
                                var dialog = new BootstrapDialog({
                                    message: function (dialogRef) {
                                        var $message = $('<div></div>').load('user/email/');
                                        var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                                        $button.on('click', {dialogRef: dialogRef}, function (event) {
                                            event.data.dialogRef.close();
                                        });
                                        $message.append($button);

                                        return $message;
                                    },
                                    closable: true
                                });
                                dialog.realize();
                                dialog.getModalHeader().hide();
                                dialog.getModalFooter().hide();
                                dialog.open();
                            }
                            menu('dashboard', 'li-dashboard');

                            function getFormData($form) {
                                var unindexed_array = $form.serializeArray();
                                var indexed_array = {};

                                $.map(unindexed_array, function (n, i) {
                                    indexed_array[n['name']] = n['value'];
                                });

                                return indexed_array;
                            }
                            function cek_penilaian() {
                                $.post('dashboard/cek_jumlah_penilaian', {}, function (hasil) {
                                    $('#ttl_penilaian').html(hasil);
                                });
                            }
                            cek_penilaian();
        </script>
    </body>
</html>

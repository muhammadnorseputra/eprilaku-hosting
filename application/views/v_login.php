<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SPPP 360 | Log in</title>
        <link rel="shortcut icon" href="images/favicon.png" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
       
        <!-- Theme style 
          <link rel="stylesheet" href="dist/css/AdminLTE.min.css">-->
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
        <style>
            .vr
            {
                border-left: 1px dotted grey;
                height: 255px;
            }
            body{
                /*background-color: #29363F;*/
                background-color: #BDB76B;
            }
            @font-face {
                font-family: worksans;
                src: url(fonts/WorkSans-Regular.ttf);
            }
            @font-face {
                font-family: poppins;
                src: url(fonts/Poppins-Regular.ttf);
            }
            body{
                font-family: poppins;
            }
        </style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="row">
                <div class="col-xs-5"><img src="images/360derajatlogo.png" width="200" style="margin-top:30px;"></div>
                <div class="col-xs-1">
                    <div class="vr"></div>
                </div>
                <div class="col-xs-6">
                    <div class="login-box-body">
                        <p class="login-box-msg" style="text-align: left; margin-top:15px;"><img src="images/logobkppd.png" width="130" /></p>
                        <form action="main/validasi" method="post">
                            <div class="form-group has-feedback">
                                <input type="text" name="username" class="form-control" placeholder="Username" required="">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control" name="password" placeholder="Password" required="">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-success btn-block btn-flat">Login</button>
                                </div>
                            </div>

                            <div class="row" style="margin-top:10px;">
                                <div class="col-xs-12" style="color:white;font-size:10px;text-align: center;">
                                    Sistem Penilaian Perilaku PNS 360 Derajat<br/>
                                    <p class="mt-5 mb-3 text-muted">BKPPD Kab. Balangan © 2020</p>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- /.login-logo -->

            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <script>

            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });

            $.fn.center = function () {
                this.css("position", "absolute");
                this.css("top", ($(window).height() - this.height()) / 2 + "px");
                this.css("left", ($(window).width() - this.width()) / 2 + "px");
                return this;
            }

            $('.login-box').center();
            var pesan = "<?= $pesan ?>";
            if (pesan != "") {
                alert(pesan);
            }
        </script>
    </body>
</html>

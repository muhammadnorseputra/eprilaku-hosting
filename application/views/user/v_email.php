<?php
$hostname=!empty($email['hostname'])?$email['hostname']:'';
$username=!empty($email['username'])?$email['username']:'';
$password=!empty($email['password'])?$email['password']:'';
$port_email=!empty($email['port_email'])?$email['port_email']:'';
$sender_name=!empty($email['sender_name'])?$email['sender_name']:'';
$sender_email=!empty($email['sender_email'])?$email['sender_email']:'';
?>

<div class="panel panel-primary">
    <div class="panel-heading">EDIT KONFIGURASI EMAIL</div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">HOSTNAME</label>
                <div class="col-sm-8" style="vertical-align: middle;">
                    <input type="text" class="form-control" id="hostname" value="<?= $hostname ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">USERNAME</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="username" value="<?= $username ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">PASSWORD</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="password" value="<?= $password ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">PORT EMAIL</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="port_email" value="<?= $port_email ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">NAMA PENGIRIM</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="sender_name" value="<?= $sender_name ?>">

                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">EMAIL PENGIRIM</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="sender_email" value="<?= $sender_email ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
                    <button class="btn btn-primary" onclick="ubah_email()">SIMPAN</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function ubah_email() {
        var hostname = $('#hostname').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var port_email = $('#port_email').val();
        var sender_name = $('#sender_name').val();
        var sender_email = $('#sender_email').val();
        var r = confirm('Yakin ingin merubah konfigurasi email ini ?');
        if (r) {
            $.post('user/ubah_email', {hostname:hostname,username:username,password:password,port_email:port_email,sender_name:sender_name,sender_email:sender_email}, function (hasil) {
                alert(hasil);
            });
        }
    }
</script>

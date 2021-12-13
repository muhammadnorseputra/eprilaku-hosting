<section class="content-header" style="height: 30px;">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> User</a></li>
        <li class="active">Password Kandidaat</li>
    </ol>
</section>

<!-- Main content -->
<section class="content" style="padding:30px;">
    <div class="panel panel-primary">
        <div class="panel-heading">Password Detail Kandidat</div>
        <div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Password Kandidat</label>
                    <div class="col-sm-4">
                        <input type="text" readonly class="form-control" name="password" placeholder="Password" value="<?=$pwd['password']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Password Detail Kandidat</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="pwd_kandidat" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Konfirmasi Password</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="pwd_kandidat_konfirm" placeholder="Konfirmasi Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label"></label>
                    <div class="col-sm-4">
                        <button class="btn btn-primary" onclick="simpan_pwd_detail()">SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function simpan_pwd_detail() {
        var pwd = $('#pwd_kandidat').val();
        var pwd2 = $('#pwd_kandidat_konfirm').val();
        if (pwd != pwd2) {
            alert("Password konfirmasi tidak sama");
            $('#pwd_kandidat_konfirm').focus();
        } else {
            $.post('user/simpan_pwd_kandidat', {pwd: pwd}, function (hasil) {
                resp = JSON.parse(hasil);
                if (resp.status == 1) {
                    alert(resp.pesan);
                } else {
                    alert(resp.pesan);
                }
            });
        }
    }
</script>
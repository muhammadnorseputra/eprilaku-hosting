
<div class="panel panel-primary">
    <div class="panel-heading">EDIT PROFILE</div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">NIP</label>
                <div class="col-sm-8" style="vertical-align: middle;">
                    <label><?= $this->session->userdata('nip') ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">NAMA</label>
                <div class="col-sm-8">
                    <label><?= $this->session->userdata('nama') ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">USERNAME</label>
                <div class="col-sm-8">
                    <label><?= $this->session->userdata('username') ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">EMAIL ( Notifikasi )</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="email" value="<?=$user['email'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">PASSWORD (Jika ingin dirubah)</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password_ubah">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">KONFIRMASI PASSWORD</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password_ubah2">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">UNIT KERJA</label>
                <div class="col-sm-8">
                    <label><?= $this->session->userdata('unit_kerja') ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">JABATAN</label>
                <div class="col-sm-8">
                    <label><?= $this->session->userdata('jabatan') ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
                    <button class="btn btn-primary" onclick="ubah_profile()">SIMPAN</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function ubah_profile() {
        var pass = $('#password_ubah').val();
        var pass2 = $('#password_ubah2').val();
        var email = $('#email').val();
        if (pass !== "") {
            var r = confirm('Yakin ingin merubah password ini ?');
            if (r) {

                if (pass !== pass2) {
                    alert('Konfirmasi Password Tidak Sama');
                    $('#password_ubah2').focus();
                } else {
                    $.post('user/ubah_profile', {pass: pass, email: email}, function (hasil) {
                        alert(hasil);
                    });
                }
            }
        } else {
            $.post('user/ubah_profile', {pass: pass, email: email}, function (hasil) {
                alert(hasil);
            });
            $('.close').click();
        }
    }
</script>

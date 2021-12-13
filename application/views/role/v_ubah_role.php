<section class="content" style="padding:0px;">
    <form method="post" enctype="multipart/form-data" id="frmTambahRole">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">Role 
            </div>
            <div class="panel-body" style="min-height: 220px;">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Nama Role</label>
                        <div class="col-sm-8">
                            <input type="hidden" class="form-control" name="id_role" value="<?= $dt['id_role'] ?>">
                            <input type="text" class="form-control" name="role_name" value="<?= $dt['role_name'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-5 control-label"></label>
                        <div class="col-sm-6">
                            <button class="btn btn-primary">SIMPAN</button>
                            <button class="btn btn-danger" type="button" onclick="$('.close').click()" >BATAL</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<script>
    $("#frmTambahRole").on('submit', (function (e) {
        e.preventDefault();
        var r = confirm('Yakin ingin memproses data ini ?');
        if (r) {
            //alert("masuk2");
            $.ajax({
                //alert("masuk3");
                url: "pengaturan/proses_role/",
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data) {
                    alert(data);
                    $('.close').click();
                   $('#tbl-role').DataTable().ajax.reload();

                },
                error: function (hasil) {
                    alert(hasil.toString());
                }
            }
            );
        }

    }));
</script>
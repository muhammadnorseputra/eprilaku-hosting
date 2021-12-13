<section class="content-header" style="height: 30px;">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Role</li>
    </ol>
</section>

<section class="content" style="padding-top:15px;">

    <div class="panel panel-danger">
        <div class="panel-heading">Data Role
            <button class="btn btn-primary pull-right" style="margin-top:-6px;" onclick="tambah_role()">Tambah Role</button>
        </div>
        <div class="panel-body responsive" id="collapse1">
            <table class="display" class="display" style="width:100%" id="tbl-role" >
                <thead>
                    <tr style="text-align: center;" class="info text-bold">
                        <td>No</td>
                        <td>Nama Role</td>
                        <td>Ubah</td>
                        <td>Hapus</td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
<script>
    var oTableRole = $('#tbl-role').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "pagingType": "full_numbers",
        "processing": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true,
        "bJQueryUI": true,
        "serverSide": true,
        "responsive": true, "bDestroy": true,
        "ajax": {
            "url": "<?php echo site_url('pengaturan/dt_role') ?>",
            "type": "POST",
            "data": function (d) {
                d.status = 'User';
            }
        },
        "columnDefs": [
            {
                "targets": [-1, 0, 1, 2], //last column
                "orderable": false,
                "className": "text-center"
            }
        ]
    });

    function tambah_role() {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('pengaturan/tambah_role/');
                var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                $button.on('click', {dialogRef: dialogRef}, function (event) {
                    event.data.dialogRef.close();
                });
                $message.append($button);

                return $message;
            },
            closable: false,
            size: 'size-normal'
        });

        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalFooter().hide();
        dialog.open();
    }

    function ubah_role(id) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('pengaturan/ubah_role/' + id);
                var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                $button.on('click', {dialogRef: dialogRef}, function (event) {
                    event.data.dialogRef.close();
                });
                $message.append($button);

                return $message;
            },
            closable: false
        });

        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalFooter().hide();
        dialog.open();
    }

    function hapus_role(id) {
        var r = confirm('Yakin ingin menghapus role ini ?');
        if (r) {
            $.post('pengaturan/hapus_role', {id: id}, function (hasil) {
                if (hasil) {
                    $('#tbl-role').DataTable().ajax.reload();
                }
            });
        }
    }

</script>
